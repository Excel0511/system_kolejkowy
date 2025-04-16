# System kolejkowy
## Opis
Prosta aplikacja do obsługi większych kolejek w sposób uporządkowany. Umożliwia zarządzanie ticketami, zmiane hasła administratora, edycję powodów wizyt.
## Użytkowanie
### Uruchamianie i użytkowanie
1. Zainstaluj i skonfiguruj serwer php i mysql
2. Pobierz potrzebne pliki
3. Stwórz bazę danych z pliku table_create.sql
4. Zmodyfikuj pliki php tak aby odnosiły się do twojej bazy danych (domyślnie jest to localhost root bez hasła)
5. Zaloguj się do panelu administracyjnego (strona/login.php) i dodaj powody wizt każdy z nich kończąc enterem. Zaleca się też zmiane hasła.
6. Połącz ze stroną z przeglądarki wyświetlacz numerów (strona/number_display.html) oraz terminal interesantów (strona/index.html)
7. Przyjmuj osoby po kolei, w razie potrzeby zrób sobie przerwę
8. Zalecam najpierw samodzielnie wypróbować system aby przećwiczyć korzystanie z interfejsu przed rzeczywistym wdrożeniem
