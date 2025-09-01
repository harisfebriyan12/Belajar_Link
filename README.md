# Panduan Instalasi 

## 1. Persyaratan Sistem
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL/MariaDB
- Ekstensi PHP: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath, Fileinfo

## 2. Clone/Download Proyek
Jika dari GitHub:
```bash
git clone https://github.com/username/belajar_link.git
cd  belajar_link
```

## 3. Instalasi Dependency
### Composer
```bash
composer install
```
### NPM
```bash
npm install
```

## 4. Konfigurasi Environment
Salin file `.env.example` menjadi `.env`:
```bash
copy .env.example .env
```
Edit `.env` sesuai konfigurasi database dan email Anda.

## 5. Generate Application Key
```bash
php artisan key:generate
```

## 6. Migrasi Database
- Import file SQL (misal: `belajar_link.sql`) ke database melalui phpMyAdmin
- Jalankan migrasi:
```bash
php artisan migrate
```

## 7. Storage Link
```bash
php artisan storage:link
```

## 8. Instalasi & Konfigurasi CAPTCHA
- Daftar di [Google reCAPTCHA](https://www.google.com/recaptcha/about/)
- Tambahkan `NOCAPTCHA_SITEKEY` dan `NOCAPTCHA_SECRET` ke file `.env`:
