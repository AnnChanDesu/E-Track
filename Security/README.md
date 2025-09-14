## Document Tracking System - Auth Setup

1) Create database `dts_db` in phpMyAdmin and run `dts_db.sql` to create tables.

2) Install dependencies (PHPMailer) with Composer:
```
cd AuthDashboard
composer install
```

3) Serve `public/` via PHP built-in server or your web server:
```
php -S 127.0.0.1:8000 -t public
```

4) Configure DB credentials if your MySQL is not root/no password. Edit `config.php`.

5) Gmail SMTP is pre-configured to use `systemdtrack@gmail.com` with the provided app password. If you change it, update `config.php`.

6) Open `http://127.0.0.1:8000` to use the app. Click "Send Code" to receive OTP, verify, then Sign Up. Then Login.


