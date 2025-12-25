# 🇰🇷 Hangul Learn

Platforma edukacyjna do nauki alfabetu koreańskiego po polsku.

## Funkcje
- Nauka Hangula (spółgłoski / samogłoski / sylaby)
- Rejestracja / logowanie
- XP, poziomy, achievementy
- Ranking
- Premium (7 / 14 / 30 / 365 dni)
- PayPal + Revolut + kody zniżkowe
- Mikroblog + komentarze
- Profile publiczne /u/{username}
- Panel administratora
- Reklamy AdSense (ukrywane dla premium)
- Cookie notice

## Instalacja (VPS)
1. PHP >= 8.0
2. MySQL >= 8.0
3. Import `database.sql`
4. Skonfiguruj `api/db.php`
5. Nadaj prawa zapisu:
   - uploads/
   - assets/images/avatars/

## URL
- `/u/{username}` – profil publiczny
- `/mikroblog` – mikroblog
