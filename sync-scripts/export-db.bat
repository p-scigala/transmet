@echo off
chcp 65001 >nul
setlocal enabledelayedexpansion

echo 📦 Eksport bazy danych WordPress
echo ==================================

:: Załaduj konfigurację
call load-config.bat
if %ERRORLEVEL% NEQ 0 (
    pause
    exit /b 1
)

:: Sprawdź czy wszystko jest skonfigurowane
if "%DB_NAME%"=="" (
    echo ❌ Brak nazwy bazy danych w config.ini!
    pause
    exit /b 1
)

if "%XAMPP_PATH%"=="" (
    echo ❌ Nie znaleziono XAMPP!
    echo    Ustaw XAMPP_PATH w config.ini lub zainstaluj XAMPP
    pause
    exit /b 1
)

:: Sprawdź czy folder db/ istnieje
if not exist "..\db" (
    echo 📁 Tworzę folder db/
    mkdir "..\db"
)

:: Generuj timestamp dla backupu
for /f "tokens=2 delims==" %%a in ('wmic OS Get localdatetime /value') do set "dt=%%a"
set "TIMESTAMP=%dt:~0,4%-%dt:~4,2%-%dt:~6,2%_%dt:~8,2%-%dt:~10,2%-%dt:~12,2%"

echo.
echo 🔍 Parametry eksportu:
echo ├─ Baza: %DB_NAME%
echo ├─ Host: %DB_HOST%:%DB_PORT%
echo ├─ Użytkownik: %DB_USER%
echo └─ XAMPP: %XAMPP_PATH%

:: Eksportuj bazę
echo.
echo 📦 Eksportowanie bazy danych...
"%XAMPP_PATH%\mysql\bin\mysqldump.exe" -u %DB_USER% --password=%DB_PASSWORD% -h %DB_HOST% -P %DB_PORT% --single-transaction --routines --triggers %DB_NAME% > "..\db\database.sql" 2>nul

if %ERRORLEVEL% EQU 0 (
    echo ✅ Eksport zakończony pomyślnie!
    echo    Główny plik: ..\db\database.sql
    
    :: Utwórz backup z timestampem jeśli włączone
    if /i "%CREATE_BACKUPS%"=="true" (
        copy "..\db\database.sql" "..\db\database_%TIMESTAMP%.sql" >nul
        echo    Backup: ..\db\database_%TIMESTAMP%.sql
    )
    
    :: Auto-commit jeśli włączone
    if /i "%AUTO_COMMIT%"=="true" (
        echo.
        echo 🔄 Auto-commit...
        git add . >nul 2>&1
        git commit -m "%COMMIT_PREFIX% Database export %TIMESTAMP%" >nul 2>&1
        git push >nul 2>&1
        if !ERRORLEVEL! EQU 0 (
            echo ✅ Zmiany zostały automatycznie wysłane do repozytorium
        ) else (
            echo ⚠️  Auto-commit nie powiódł się
        )
    )
    
) else (
    echo ❌ Błąd podczas eksportu!
    echo    Sprawdź czy:
    echo    - MySQL jest uruchomiony w XAMPP
    echo    - Nazwa bazy danych jest poprawna
    echo    - Dane logowania są poprawne
    pause
    exit /b 1
)

echo.
echo 🔄 Następne kroki:
if /i "%AUTO_COMMIT%"=="false" (
    echo    1. git add . ^&^& git commit -m "%COMMIT_PREFIX% sync" ^&^& git push
)
echo    2. Skopiuj folder db/ na drugi komputer
echo    3. Uruchom import-db.bat na drugim komputerze

pause
