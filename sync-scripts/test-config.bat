@echo off
chcp 65001 >nul
setlocal enabledelayedexpansion

echo 🔧 Test konfiguracji WordPress Sync
echo =====================================

:: Załaduj konfigurację
call load-config.bat
if %ERRORLEVEL% NEQ 0 (
    echo ❌ Błąd podczas ładowania konfiguracji!
    pause
    exit /b 1
)

echo.
echo 📊 AKTUALNA KONFIGURACJA:
echo ├─ Baza danych: %DB_NAME%
echo ├─ Użytkownik MySQL: %DB_USER%
echo ├─ Host: %DB_HOST%:%DB_PORT%
echo ├─ XAMPP: %XAMPP_PATH%
echo ├─ Ścieżka projektu: %PROJECT_PATH%
echo ├─ URL źródłowy: %SOURCE_URL%
echo ├─ URL docelowy: %TARGET_URL%
echo ├─ Repozytorium: %REPO_URL%
echo └─ Gałąź: %BRANCH%

echo.
echo 🔍 SPRAWDZANIE POŁĄCZEŃ:

:: Test XAMPP
if "%XAMPP_PATH%"=="" (
    echo ❌ XAMPP nie znaleziony!
) else (
    if exist "%XAMPP_PATH%\mysql\bin\mysql.exe" (
        echo ✅ XAMPP znaleziony: %XAMPP_PATH%
        
        :: Test MySQL
        "%XAMPP_PATH%\mysql\bin\mysql.exe" -u %DB_USER% --password=%DB_PASSWORD% -h %DB_HOST% -P %DB_PORT% -e "SHOW DATABASES;" 2>nul
        if !ERRORLEVEL! EQU 0 (
            echo ✅ Połączenie z MySQL działa
            
            :: Test bazy danych
            "%XAMPP_PATH%\mysql\bin\mysql.exe" -u %DB_USER% --password=%DB_PASSWORD% -h %DB_HOST% -P %DB_PORT% -e "USE %DB_NAME%;" 2>nul
            if !ERRORLEVEL! EQU 0 (
                echo ✅ Baza danych %DB_NAME% istnieje
            ) else (
                echo ⚠️  Baza danych %DB_NAME% nie istnieje
            )
        ) else (
            echo ❌ Nie można połączyć z MySQL
        )
    ) else (
        echo ❌ Nie znaleziono mysql.exe w %XAMPP_PATH%
    )
)

:: Test folderów
echo.
echo 📁 SPRAWDZANIE FOLDERÓW:
if exist "..\db" (
    echo ✅ Folder db/ istnieje
) else (
    echo ⚠️  Folder db/ nie istnieje - zostanie utworzony
)

if exist "..\..\..\..\wp-config.php" (
    echo ✅ wp-config.php znaleziony
) else (
    echo ⚠️  wp-config.php nie znaleziony
)

:: Test Git
echo.
echo 🌐 SPRAWDZANIE GIT:
git --version >nul 2>&1
if %ERRORLEVEL% EQU 0 (
    echo ✅ Git jest zainstalowany
    
    git remote -v >nul 2>&1
    if %ERRORLEVEL% EQU 0 (
        echo ✅ Repozytorium Git skonfigurowane
    ) else (
        echo ⚠️  Repozytorium Git nie skonfigurowane
    )
) else (
    echo ⚠️  Git nie jest zainstalowany
)

echo.
echo 💡 REKOMENDACJE:
if "%XAMPP_PATH%"=="" echo    - Zainstaluj XAMPP lub ustaw XAMPP_PATH w config.ini
if not exist "..\db" echo    - Folder db/ zostanie utworzony przy pierwszym eksporcie
if "%DB_NAME%"=="" echo    - Ustaw DB_NAME w config.ini

echo.
pause
