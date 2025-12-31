

<div align="center">

  # 🏛️ Pesona Budaya Lampung
  **Platform Edukasi & Pelestarian Budaya Lampung Berbasis Web**

  <p>
    <a href="#">
      <img src="https://img.shields.io/badge/PHP-8.0+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
    </a>
    <a href="#">
      <img src="https://img.shields.io/badge/MySQL-Database-00000F?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
    </a>
    <a href="#">
      <img src="https://img.shields.io/badge/Bootstrap-5-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
    </a>
    <a href="#">
      <img src="https://img.shields.io/badge/Status-Active-success?style=for-the-badge" alt="Status">
    </a>
  </p>

  <p align="center">
    Aplikasi web interaktif untuk memperkenalkan kekayaan budaya Provinsi Lampung. Dilengkapi dengan fitur <b>AI Translator Bahasa Lampung</b> dan <b>Manajemen Konten (AryaPanel)</b> yang memudahkan pengelolaan data budaya.
  </p>

</div>

<br>

## 📸 Galeri Fitur (Screenshots)

Berikut adalah tampilan antarmuka dari aplikasi **Pesona Budaya Lampung**:

| **🏠 Dashboard Pengunjung** | **🔐 Dashboard Admin** |
|:-------------------------:|:-------------------:|
| <img src="https://drive.google.com/uc?export=view&id=1MUvb2ZxbMVCxRKB_iOf6TT3rdHiUmcbj" width="100%" alt="Dashboard Pengunjung"> | <img src="https://drive.google.com/uc?export=view&id=1Q3rybCOE0UwKRg-zRbCeA_hyI_KSp8e7" width="100%" alt="Dashboard Admin"> |
| *Tampilan Bersih & Modern* | *Manajemen Data Simpel* |

<br>

## ✨ Fitur Utama

- 🔐 **AryaPanel (Admin):** Halaman dashboard aman untuk mengelola konten.
- 📝 **Sistem CRUD:** Tambah, Edit, dan Hapus data budaya (Tari, Senjata, Kuliner, dll).
- 📂 **Kategori Dinamis:** Pengelompokan data budaya yang terstruktur.
- 🤖 **AI Translator:** Integrasi Google Gemini API untuk menerjemahkan Bahasa Indonesia ke Lampung.
- 📱 **Responsive Design:** Tampilan menyesuaikan layar HP dan Laptop (Bootstrap 5).

<br>

## 📂 Struktur Repositori

Struktur folder proyek ini adalah sebagai berikut:

```text
Pesona-Lampung/
├── 📁 Kode/                      # SOURCE CODE UTAMA WEBSITE
│   ├── 📁 admin/                 # Halaman Dashboard & Logika CRUD
│   ├── 📁 assets/                # Gambar (img) dan Style
│   ├── 📁 config/                # Konfigurasi Database (config.php)
│   ├── 📁 includes/              # Navbar & Footer
│   ├── 📄 index.php              # Halaman Utama (Homepage)
│   ├── 📄 translate.php          # Fitur AI Translator
│   └── ... (File PHP lainnya)
├── 📄 if0_40716856_web_lapmung.sql   # FILE DATABASE MySQL (Import ini!)
└── 📄 README.md                      # Dokumentasi Proyek
🚀 Cara Instalasi & Menjalankan
Ikuti langkah-langkah berikut untuk menjalankan proyek ini di Localhost (XAMPP):

1. Clone / Download Repositori Buka terminal (Git Bash/CMD) dan jalankan perintah:

Bash

git clone [https://github.com/Arya24-ok/Pesona-Lampung.git](https://github.com/Arya24-ok/Pesona-Lampung.git)
2. Pindahkan Source Code

Buka folder hasil download.

Salin isi folder Kode (bukan foldernya, tapi isinya).

Tempel ke dalam folder server lokal Anda, misalnya: C:\xampp\htdocs\pesona_lampung.

3. Import Database

Buka phpMyAdmin (http://localhost/phpmyadmin).

Buat database baru, misal: web_lapmung.

Import file if0_40716856_web_lapmung.sql yang ada di root repositori ini.

4. Konfigurasi Koneksi

Buka file config/config.php di text editor (VS Code/Sublime).

Sesuaikan kredensial database:

PHP

<?php
$host = 'localhost';
$user = 'root';
$pass = ''; 
$db   = 'web_lapmung'; // Sesuaikan nama DB Anda
?>
5. Akses Website Buka browser dan kunjungi: http://localhost/pesona_lampung


