# 🔄 Uniwersalny System Synchronizacji WordPress

System do synchronizacji kodu i bazy danych między komputerami z WordPressem na XAMPP.

## 📋 Spis treści
- [Instalacja](#-instalacja)
- [Konfiguracja](#-konfiguracja)
- [Użytkowanie](#-użytkowanie)
- [Pliki systemu](#-pliki-systemu)
- [Rozwiązywanie problemów](#-rozwiązywanie-problemów)

## 🚀 Instalacja

### 1. Skopiuj pliki
Skopiuj cały folder `sync-scripts/` do folderu swojego motywu WordPress.

### 2. Utwórz konfigurację
```bash
cd sync-scripts
copy config.ini.example config.ini
```

### 3. Edytuj konfigurację
Otwórz `config.ini` w edytorze tekstu i dostosuj do swojego projektu.

## ⚙️ Konfiguracja

### Plik `config.ini`

```ini
[DATABASE]
# Nazwa bazy danych MySQL
DB_NAME=nazwa_twojej_bazy

# Dane logowania do MySQL
DB_USER=root
DB_PASSWORD=

# Host bazy danych
DB_HOST=localhost
DB_PORT=3306

[PATHS]
# Ścieżka do XAMPP (auto-wykrywanie jeśli puste)
XAMPP_PATH=

# Ścieżka projektu na serwerze
PROJECT_PATH=/nazwa-projektu

[URLS]
# URL na komputerze źródłowym
SOURCE_URL=http://localhost/projekt

# URL na komputerze docelowym
TARGET_URL=http://localhost/projekt

[GIT]
# Repozytorium Git
REPO_URL=https://github.com/user/repo.git
BRANCH=master

[SETTINGS]
# Automatyczne backupy z datą
CREATE_BACKUPS=true

# Automatyczny commit i push
AUTO_COMMIT=false

# Prefix dla commitów
COMMIT_PREFIX=[SYNC]
```

### Przykładowe konfiguracje

#### Komputer 1 (biuro):
```ini
DB_NAME=moj_projekt
SOURCE_URL=http://localhost/moj-projekt
TARGET_URL=http://localhost/moj-projekt
```

#### Komputer 2 (dom):
```ini
DB_NAME=moj_projekt_home
SOURCE_URL=http://localhost/moj-projekt
TARGET_URL=http://localhost:8080/projekty/moj-projekt
```

## 🔧 Użytkowanie

### Test konfiguracji
```bash
test-config.bat
```
Sprawdza czy wszystko jest poprawnie skonfigurowane.

### Eksport bazy (komputer źródłowy)
```bash
export-db.bat
```
- Eksportuje bazę danych do `../db/database.sql`
- Tworzy backup z datą (jeśli włączone)
- Automatyczny commit (jeśli włączone)

### Import bazy (komputer docelowy)
```bash
import-db-config.bat
```
- Importuje bazę z `../db/database.sql`
- Zamienia URL-e automatycznie
- Tworzy bazę jeśli nie istnieje

### Pełny workflow synchronizacji

#### Na komputerze źródłowym:
1. `export-db-universal.bat` - eksport bazy
2. `git add . && git commit -m "[SYNC] update" && git push` - wysłanie kodu

#### Na komputerze docelowym:
1. `git pull` - pobranie najnowszego kodu
2. `import-db-config.bat` - import bazy

## 📁 Pliki systemu

```
sync-scripts/
├── config.ini              # Główna konfiguracja projektu
├── config.ini.example      # Przykład konfiguracji
├── load-config.bat         # Parser konfiguracji (nie uruchamiaj)
├── test-config.bat         # Test wszystkich ustawień
├── export-db-universal.bat # Eksport bazy danych
├── import-db-config.bat    # Import bazy danych
└── README-UNIVERSAL.md     # Ta instrukcja
```

### Pliki pomocnicze (opcjonalne)
Jeśli istnieją, można je zachować dla kompatybilności:
- `create-db.bat` - tworzenie nowej bazy
- `import-db.bat` - stary import (zastąpiony przez import-db-config.bat)
- `sync-pull.ps1` - PowerShell sync
- Inne stare pliki `.bat`

## 🎯 Funkcje automatyczne

- **Auto-wykrywanie XAMPP**: Sprawdza popularne lokalizacje
- **Auto-wykrywanie bazy**: Z wp-config.php lub nazwy folderu
- **Auto-generowanie timestampów**: Unikalne nazwy backupów
- **Auto-zamiana URL-i**: Aktualizuje adresy w bazie
- **Auto-commit**: Opcjonalne automatyczne wysyłanie do Git

## 🔍 Rozwiązywanie problemów

### "Nie znaleziono XAMPP"
```ini
[PATHS]
XAMPP_PATH=D:\Programy\XAMPP
```

### "Nie można połączyć z bazą"
1. Sprawdź czy MySQL w XAMPP jest uruchomiony
2. Sprawdź dane w sekcji `[DATABASE]`
3. Uruchom `test-config.bat` do diagnozy

### "Plik database.sql nie istnieje"
1. Uruchom `export-db-universal.bat` na komputerze źródłowym
2. Skopiuj folder `db/` na komputer docelowy

### "Błąd podczas zamiany URL"
Sprawdź sekcję `[URLS]` w config.ini:
```ini
[URLS]
SOURCE_URL=http://localhost/stary-adres
TARGET_URL=http://localhost/nowy-adres
```

### "Git nie działa"
```bash
# Zainstaluj Git lub ustaw AUTO_COMMIT=false
[SETTINGS]
AUTO_COMMIT=false
```

## 📦 Przenoszenie na nowy projekt

1. **Skopiuj folder**: `sync-scripts/` do nowego motywu
2. **Skopiuj konfigurację**: `copy config.ini.example config.ini`
3. **Edytuj config.ini**: Dostosuj do nowego projektu
4. **Test**: `test-config.bat`
5. **Gotowe!** 🎉

## 💡 Wskazówki

- Zawsze uruchom `test-config.bat` po zmianie konfiguracji
- Używaj `CREATE_BACKUPS=true` dla bezpieczeństwa
- Ustaw `AUTO_COMMIT=true` tylko jeśli ufasz automatyzacji
- Różne URL-e między komputerami są obsługiwane automatycznie
- Folder `db/` jest tworzony automatycznie przy pierwszym eksporcie

## 🛠️ Wymagania

- **XAMPP** z MySQL i PHP
- **Git** (opcjonalnie, dla synchronizacji kodu)
- **WordPress** z wp-config.php
- **Windows** z obsługą plików .bat

---

*Uniwersalny system synchronizacji WordPress - gotowy do użycia w dowolnym projekcie!* 🚀
