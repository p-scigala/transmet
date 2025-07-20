@echo off
:: ===========================================
:: UNIWERSALNY PARSER KONFIGURACJI
:: ===========================================
:: Ten plik jest wywoływany przez inne skrypty
:: Nie uruchamiaj go bezpośrednio

if not exist "config.ini" (
    echo ❌ Plik config.ini nie istnieje!
    echo    Skopiuj config.ini.example i edytuj go
    exit /b 1
)

:: Czytaj sekcję DATABASE
for /f "tokens=1,2 delims==" %%a in ('findstr /v "^#" config.ini ^| findstr /v "^\[" ^| findstr "."') do (
    if "%%a"=="DB_NAME" set "DB_NAME=%%b"
    if "%%a"=="DB_USER" set "DB_USER=%%b"  
    if "%%a"=="DB_PASSWORD" set "DB_PASSWORD=%%b"
    if "%%a"=="DB_HOST" set "DB_HOST=%%b"
    if "%%a"=="DB_PORT" set "DB_PORT=%%b"
)

:: Czytaj sekcję PATHS
for /f "tokens=1,2 delims==" %%a in ('findstr /v "^#" config.ini ^| findstr /v "^\[" ^| findstr "."') do (
    if "%%a"=="XAMPP_PATH" set "XAMPP_PATH=%%b"
    if "%%a"=="PROJECT_PATH" set "PROJECT_PATH=%%b"
)

:: Czytaj sekcję URLS
for /f "tokens=1,2 delims==" %%a in ('findstr /v "^#" config.ini ^| findstr /v "^\[" ^| findstr "."') do (
    if "%%a"=="SOURCE_URL" set "SOURCE_URL=%%b"
    if "%%a"=="TARGET_URL" set "TARGET_URL=%%b"
)

:: Czytaj sekcję GIT
for /f "tokens=1,2 delims==" %%a in ('findstr /v "^#" config.ini ^| findstr /v "^\[" ^| findstr "."') do (
    if "%%a"=="REPO_URL" set "REPO_URL=%%b"
    if "%%a"=="BRANCH" set "BRANCH=%%b"
)

:: Czytaj sekcję SETTINGS
for /f "tokens=1,2 delims==" %%a in ('findstr /v "^#" config.ini ^| findstr /v "^\[" ^| findstr "."') do (
    if "%%a"=="CREATE_BACKUPS" set "CREATE_BACKUPS=%%b"
    if "%%a"=="AUTO_COMMIT" set "AUTO_COMMIT=%%b"
    if "%%a"=="COMMIT_PREFIX" set "COMMIT_PREFIX=%%b"
)

:: Domyślne wartości jeśli nie podano
if "%DB_USER%"=="" set "DB_USER=root"
if "%DB_PASSWORD%"=="" set "DB_PASSWORD="
if "%DB_HOST%"=="" set "DB_HOST=localhost"
if "%DB_PORT%"=="" set "DB_PORT=3306"
if "%BRANCH%"=="" set "BRANCH=master"
if "%CREATE_BACKUPS%"=="" set "CREATE_BACKUPS=true"
if "%AUTO_COMMIT%"=="" set "AUTO_COMMIT=false"
if "%COMMIT_PREFIX%"=="" set "COMMIT_PREFIX=[SYNC]"

:: Auto-wykrywanie XAMPP jeśli nie podano ścieżki
if "%XAMPP_PATH%"=="" (
    call :detect_xampp
)

goto :eof

:detect_xampp
if exist "C:\xampp\mysql\bin\mysql.exe" set "XAMPP_PATH=C:\xampp"
if exist "D:\xampp\mysql\bin\mysql.exe" set "XAMPP_PATH=D:\xampp"
if exist "E:\xampp\mysql\bin\mysql.exe" set "XAMPP_PATH=E:\xampp"
if exist "C:\Program Files\XAMPP\mysql\bin\mysql.exe" set "XAMPP_PATH=C:\Program Files\XAMPP"
if exist "D:\Programy\XAMPP\mysql\bin\mysql.exe" set "XAMPP_PATH=D:\Programy\XAMPP"
if exist "E:\Programy\XAMPP\mysql\bin\mysql.exe" set "XAMPP_PATH=E:\Programy\XAMPP"
goto :eof
