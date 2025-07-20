@echo off
chcp 65001 >nul
echo ========================================
echo      SPRAWDZANIE BAZ DANYCH
echo ========================================

:: Automatyczne wykrywanie ścieżki XAMPP
set XAMPP_PATH=
if exist "C:\xampp\mysql\bin\mysql.exe" set XAMPP_PATH=C:\xampp
if exist "D:\Programy\XAMPP\mysql\bin\mysql.exe" set XAMPP_PATH=D:\Programy\XAMPP
if exist "E:\Programy\XAMPP\mysql\bin\mysql.exe" set XAMPP_PATH=E:\Programy\XAMPP
if exist "C:\Program Files\XAMPP\mysql\bin\mysql.exe" set XAMPP_PATH=C:\Program Files\XAMPP

echo 📁 XAMPP: %XAMPP_PATH%
echo.
echo 📋 Dostępne bazy danych:
echo ----------------------------------------
"%XAMPP_PATH%\mysql\bin\mysql.exe" -u root -e "SHOW DATABASES;" 2>nul

echo.
echo 🔍 Bazy zawierające tabele WordPress (wp_options):
echo ----------------------------------------
for /f "skip=1 tokens=1" %%i in ('"%XAMPP_PATH%\mysql\bin\mysql.exe" -u root -e "SHOW DATABASES;" 2^>nul') do (
    if not "%%i"=="information_schema" if not "%%i"=="mysql" if not "%%i"=="performance_schema" if not "%%i"=="phpmyadmin" (
        "%XAMPP_PATH%\mysql\bin\mysql.exe" -u root -e "USE %%i; SHOW TABLES LIKE 'wp_options';" 2>nul | findstr wp_options >nul
        if not errorlevel 1 (
            echo ✅ %%i - zawiera tabele WordPress
        )
    )
)

echo.
echo 💡 Sprawdź nazwę swojej bazy powyżej i zaktualizuj skrypty
echo.
pause
