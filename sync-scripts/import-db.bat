@echo off
chcp 65001 >nul
setlocal enabledelayedexpansion

echo 📥 Import bazy danych WordPress
echo =================================

:: Załaduj konfigurację
call load-config.bat
if %ERRORLEVEL% NEQ 0 (
    pause
    exit /b 1
)

:: Sprawdź czy plik bazy istnieje
if not exist "..\db\database.sql" (
    echo ❌ Plik ..\db\database.sql nie istnieje!
    echo    Uruchom export-db.bat na komputerze źródłowym
    pause
    exit /b 1
)

:: Sprawdź konfigurację
if "%DB_NAME%"=="" (
    echo ❌ Brak nazwy bazy danych w config.ini!
    pause
    exit /b 1
)

if "%XAMPP_PATH%"=="" (
    echo ❌ Nie znaleziono XAMPP!
    pause
    exit /b 1
)

echo.
echo 🔍 Parametry importu:
echo ├─ Baza: %DB_NAME%
echo ├─ Host: %DB_HOST%:%DB_PORT%
echo ├─ Użytkownik: %DB_USER%
echo ├─ Źródłowy URL: %SOURCE_URL%
echo └─ Docelowy URL: %TARGET_URL%

echo.
echo ⚠️  UWAGA: Ta operacja nadpisze wszystkie dane w bazie %DB_NAME%!
set /p answer="Czy chcesz kontynuować? (T/N): "
if /i not "%answer%"=="T" (
    echo Anulowano.
    pause
    exit /b 0
)

:: Sprawdź czy baza istnieje, jeśli nie to utwórz
echo.
echo 🔍 Sprawdzanie bazy danych...
"%XAMPP_PATH%\mysql\bin\mysql.exe" -u %DB_USER% --password=%DB_PASSWORD% -h %DB_HOST% -P %DB_PORT% -e "USE %DB_NAME%;" 2>nul
if %ERRORLEVEL% NEQ 0 (
    echo 🏗️  Baza %DB_NAME% nie istnieje. Tworzę...
    "%XAMPP_PATH%\mysql\bin\mysql.exe" -u %DB_USER% --password=%DB_PASSWORD% -h %DB_HOST% -P %DB_PORT% -e "CREATE DATABASE %DB_NAME% CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>nul
    if !ERRORLEVEL! NEQ 0 (
        echo ❌ Nie można utworzyć bazy danych!
        pause
        exit /b 1
    )
    echo ✅ Baza danych utworzona
)

:: Import bazy
echo.
echo 📥 Importowanie bazy danych...
"%XAMPP_PATH%\mysql\bin\mysql.exe" -u %DB_USER% --password=%DB_PASSWORD% -h %DB_HOST% -P %DB_PORT% %DB_NAME% < "..\db\database.sql"

if %ERRORLEVEL% EQU 0 (
    echo ✅ Import zakończony pomyślnie!
    
    :: Zamiana URL-i jeśli są różne
    if not "%SOURCE_URL%"=="%TARGET_URL%" (
        if not "%SOURCE_URL%"=="" (
            if not "%TARGET_URL%"=="" (
                echo.
                echo 🔄 Zamieniam URL-e w bazie danych...
                echo    %SOURCE_URL% → %TARGET_URL%
                
                :: Utwórz tymczasowy skrypt PHP do zamiany URL
                echo ^<?php > temp_url_replace.php
                echo $host = '%DB_HOST%'; >> temp_url_replace.php
                echo $port = %DB_PORT%; >> temp_url_replace.php
                echo $user = '%DB_USER%'; >> temp_url_replace.php
                echo $pass = '%DB_PASSWORD%'; >> temp_url_replace.php
                echo $dbname = '%DB_NAME%'; >> temp_url_replace.php
                echo $old_url = '%SOURCE_URL%'; >> temp_url_replace.php
                echo $new_url = '%TARGET_URL%'; >> temp_url_replace.php
                echo. >> temp_url_replace.php
                echo try { >> temp_url_replace.php
                echo     $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $user, $pass^); >> temp_url_replace.php
                echo     $pdo-^>setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION^); >> temp_url_replace.php
                echo. >> temp_url_replace.php
                echo     // Zamiana w opcjach >> temp_url_replace.php
                echo     $stmt = $pdo-^>prepare("UPDATE wp_options SET option_value = REPLACE(option_value, ?, ?^) WHERE option_name IN ('home', 'siteurl'^)"^); >> temp_url_replace.php
                echo     $stmt-^>execute([$old_url, $new_url]^); >> temp_url_replace.php
                echo. >> temp_url_replace.php
                echo     // Zamiana w treściach >> temp_url_replace.php
                echo     $stmt = $pdo-^>prepare("UPDATE wp_posts SET post_content = REPLACE(post_content, ?, ?^)"^); >> temp_url_replace.php
                echo     $stmt-^>execute([$old_url, $new_url]^); >> temp_url_replace.php
                echo. >> temp_url_replace.php
                echo     echo "✅ URL-e zostały zaktualizowane\n"; >> temp_url_replace.php
                echo } catch (Exception $e^) { >> temp_url_replace.php
                echo     echo "❌ Błąd podczas aktualizacji URL-ów: " . $e-^>getMessage(^) . "\n"; >> temp_url_replace.php
                echo } >> temp_url_replace.php
                echo ?^> >> temp_url_replace.php
                
                "%XAMPP_PATH%\php\php.exe" temp_url_replace.php
                del temp_url_replace.php
            )
        )
    )
    
) else (
    echo ❌ Błąd podczas importu!
    echo    Sprawdź czy plik database.sql nie jest uszkodzony
    pause
    exit /b 1
)

echo.
echo ✅ Synchronizacja zakończona!
echo 💡 Sprawdź stronę: %TARGET_URL%

pause
