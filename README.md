# FoodLink - Starter MVP
This is a starter project for the FoodLink hackathon app (HTML/CSS/JS + PHP + MySQL).

## Quick setup (local)
1. Install XAMPP/WAMP and start Apache + MySQL.
2. Copy the `foodlink_starter` folder into your webserver root (e.g., `C:\xampp\htdocs\foodlink_starter`).
3. Import `sql/foodlink.sql` into MySQL (phpMyAdmin or mysql client).
4. Edit `php/db.php` if your DB credentials differ.
5. Open `http://localhost/foodlink_starter/index.html` in your browser.
6. Register a user, login, and test posting/claiming donations.

## Notes
- This is a simple starter intended for hackathon demos.
- Do NOT store production secrets in code. Use environment variables on your host.
- Payment integration (IntaSend) will require server-side SDK and sandbox keys. See IntaSend docs for examples.

Good luck at the hackathon! - Chatty