# 📰 Portal Berita Pro - CMS & Frontend

**Portal Berita Pro** adalah aplikasi web full-stack berbasis Laravel 12 yang dirancang untuk meniru fungsionalitas portal berita profesional Indonesia seperti **Kompas.com** atau **Detik.com**. Proyek ini mencakup **Panel Admin (CMS)** kaya fitur untuk manajemen konten dan **frontend** dinamis yang responsif untuk pembaca.

---

## ✨ Fitur Utama

### 🔧 Backend (Panel Admin / CMS)
- **Manajemen User & Peran:** Sistem berbasis peran (Admin, Editor, Penulis).
- **CRUD Berita Profesional:** Tersedia rich text editor (Trix), status artikel (Draft/Published), dan fitur headline.
- **Manajemen Kategori & Tag:** Struktur taksonomi fleksibel.
- **Galeri Foto:** Upload multi-foto per berita dengan caption.
- **Moderasi Komentar:** Panel terpusat untuk menyetujui/menolak/menghapus komentar.
- **Pencarian & Paginasi:** Tersedia pada semua modul admin.

### 🌐 Frontend (Halaman Publik)
- **Homepage Dinamis:** Berisi Headline, Berita Populer, dan blok berita terbaru per kategori.
- **Halaman Artikel Lengkap:**  
  - Layout dua kolom  
  - Sidebar: Berita Terkait & Berita Populer
- **Sistem Komentar:** Untuk pengguna terautentikasi.
- **Navigasi Arsip:** Berdasarkan kategori dan tag.
- **Desain Responsif:** Desktop, tablet, dan mobile-friendly.

---

## 🚀 Teknologi yang Digunakan

| Bagian         | Teknologi            |
|----------------|----------------------|
| Backend        | PHP 8.2, Laravel 12  |
| Frontend       | Tailwind CSS 4, Alpine.js |
| Full-stack     | Livewire 3           |
| Database       | MySQL / MariaDB      |
| Development    | Laragon (optional)   |

---

## 🛠️ Instalasi & Setup

### ✅ Prasyarat
- PHP >= 8.2
- Composer 2.x
- Node.js & NPM
- MySQL/MariaDB

### ⚙️ Langkah-langkah Instalasi

```bash
# 1. Clone repositori
git clone https://github.com/username/portal-berita.git
cd portal-berita

# 2. Install dependensi PHP
composer install

# 3. Install dependensi JavaScript
npm install

# 4. Copy file konfigurasi lingkungan
cp .env.example .env

# 5. Generate application key
php artisan key:generate
