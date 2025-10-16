Portal Berita Pro - CMS & Frontend

Portal Berita Pro adalah sebuah aplikasi web full-stack yang dibangun menggunakan Laravel 12. Proyek ini bertujuan untuk mereplikasi fungsionalitas dan arsitektur portal berita profesional di Indonesia, seperti Kompas.com atau Detik.com. Aplikasi ini mencakup Panel Admin (CMS) yang kaya fitur untuk manajemen konten dan frontend yang dinamis serta responsif untuk pembaca.

✨ Fitur Utama

Backend (Panel Admin / CMS)

Manajemen User & Peran: Sistem role-based (Admin, Editor, Penulis).

CRUD Berita Profesional: Lengkap dengan rich text editor (Trix), manajemen status (Draft, Published), dan fitur headline.

Manajemen Kategori & Tag: Struktur taksonomi yang kuat untuk pengorganisasian konten.

Manajemen Galeri Foto: Upload multi-foto dengan caption untuk setiap berita.

Moderasi Komentar: Panel terpusat untuk menyetujui, menolak, atau menghapus komentar pembaca.

Pencarian & Paginasi: Semua modul di panel admin dilengkapi dengan fitur pencarian dan paginasi yang interaktif.

Frontend (Halaman Publik)

Homepage Dinamis: Menampilkan Berita Utama (Headline), Berita Terpopuler, dan blok berita terbaru per kategori.

Halaman Artikel Lengkap:

Layout dua kolom dengan sidebar.

Sidebar berisi "Berita Terkait" & "Berita Populer" untuk meningkatkan engagement.

Sistem Komentar: Pengguna yang terautentikasi dapat berpartisipasi dalam diskusi.

Navigasi Arsip: Halaman khusus untuk menampilkan semua berita berdasarkan Kategori atau Tag.

Desain Responsif: Tampilan yang optimal di perangkat desktop, tablet, dan mobile.

🚀 Teknologi yang Digunakan

Backend: PHP 8.2, Laravel 12

Frontend: Tailwind CSS 4, Alpine.js

Full-stack Framework: Livewire 3

Database: MySQL / MariaDB

Server: Laragon (Development)

🛠️ Panduan Instalasi & Setup

Berikut adalah langkah-langkah untuk menjalankan proyek ini di lingkungan pengembangan lokal Anda.

Prasyarat

PHP >= 8.2

Composer 2

Node.js & NPM

Database (MySQL/MariaDB)

Langkah-langkah Instalasi

Clone repositori ini:

git clone [https://github.com/username/portal-berita-pro.git](https://github.com/username/portal-berita-pro.git)
cd portal-berita-pro


Instal dependensi PHP:

composer install


Instal dependensi JavaScript:

npm install


Konfigurasi Lingkungan:

Salin file .env.example menjadi .env.

copy .env.example .env


Buat application key baru.

php artisan key:generate


Setup Database:

Buat sebuah database baru di MySQL/MariaDB.

Konfigurasikan koneksi database Anda di dalam file .env.

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portal_berita_pro
DB_USERNAME=root
DB_PASSWORD=


Jalankan Migrasi & Seeder:
Perintah ini akan membuat semua tabel dan mengisinya dengan data contoh (1 Admin, 50 berita, kategori, dll).

php artisan migrate:fresh --seed


Buat Storage Link:
Ini penting agar gambar yang di-upload bisa diakses publik.

php artisan storage:link


Jalankan Server:

Buka dua terminal.

Di terminal pertama, jalankan Vite (untuk aset frontend).

npm run dev


Di terminal kedua, jalankan server PHP.

php artisan serve


Selesai!

Akses aplikasi di: http://127.0.0.1:8000

Login ke panel admin di: http://127.0.0.1:8000/login

User Admin: admin@example.com

Password: password

🤝 Berkontribusi

Kontribusi, isu, dan permintaan fitur sangat kami hargai! Jangan ragu untuk membuka issue baru atau mengirimkan pull request.
