@echo off
chcp 65001 >nul
echo ========================================
echo        TEST ŚCIEŻEK I FOLDERÓW
echo ========================================

echo 📂 Aktualny folder (sync-scripts): %CD%
echo 📂 Folder motywu: %CD%\..
echo 📂 Folder db (docelowy): %CD%\..\db
echo.

echo 🔍 Sprawdzanie struktury folderów:
echo ----------------------------------------

echo ✅ Jesteśmy w folderze: sync-scripts

if exist "db" (
    echo ✅ Folder db istnieje obok sync-scripts
    echo 📋 Zawartość folderu db:
    dir "db" /b 2>nul
) else (
    echo ⚠️  Folder db nie istnieje - zostanie utworzony przy eksporcie
)

if exist "db\database.sql" (
    echo ✅ Plik database.sql istnieje
    for %%A in ("db\database.sql") do echo 📏 Rozmiar: %%~zA bajtów
) else (
    echo ⚠️  Plik database.sql nie istnieje
)

echo.
echo 💡 Ścieżki docelowe:
echo    sync-scripts: %CD%
echo    db:           %CD%\db
echo    SQL:          %CD%\db\database.sql
echo.
pause
