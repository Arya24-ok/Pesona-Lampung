<?php
session_start();
include '../config/config.php';

// Cek Login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 1. Ambil nama file gambar dulu sebelum datanya dihapus
    $stmt = $pdo->prepare("SELECT image_url FROM culture_gallery WHERE id = ?");
    $stmt->execute([$id]);
    $data = $stmt->fetch();

    // 2. Hapus file fisik di folder assets/img
    if ($data) {
        $file_path = "../assets/img/" . $data['image_url'];
        if (file_exists($file_path)) {
            unlink($file_path); // Fungsi PHP untuk menghapus file
        }
    }

    // 3. Hapus data di database
    $stmt = $pdo->prepare("DELETE FROM culture_gallery WHERE id = ?");
    $stmt->execute([$id]);

    // Kembali ke dashboard
    header("Location: dashboard.php?pesan=Data berhasil dihapus");
    exit;
} else {
    header("Location: dashboard.php");
}
?>