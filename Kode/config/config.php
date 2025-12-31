<?php
// --- KONFIGURASI DATABASE ONLINE (INFINITYFREE) ---
$host = 'sql308.infinityfree.com';      // MySQL Host Name dari gambar
$db   = 'if0_40716856_web_lapmung';     // MySQL DB Name dari gambar
$user = 'if0_40716856';                 // MySQL User Name dari gambar
$pass = 'aryagta456uioOK';              // Password vPanel yang Anda berikan
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     // Tampilkan pesan error jika gagal koneksi
     die("Koneksi Database Gagal: " . $e->getMessage());
}

// Data Kamus Manual (Opsional, sebagai cadangan jika AI lambat)
$dictionary = [
    "halo" => "tabik pun",
    "makan" => "mangan",
    "apa kabar" => "api kabar",
    "saya" => "nyak",
    "kamu" => "niku",
    "terima kasih" => "terima kasih / syukkur"
];
?>