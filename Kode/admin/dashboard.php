<?php
session_start();
include '../config/config.php';

// 1. Cek Session Admin
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// 2. Logika Hapus Data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    // Ambil nama gambar dulu untuk dihapus dari folder
    $stmt = $pdo->prepare("SELECT image_url FROM culture_gallery WHERE id = ?");
    $stmt->execute([$id]);
    $data = $stmt->fetch();

    if ($data) {
        $file_path = "../assets/img/" . $data['image_url'];
        if (file_exists($file_path)) {
            unlink($file_path); // Hapus file fisik
        }
    }

    // Hapus dari database
    $stmt = $pdo->prepare("DELETE FROM culture_gallery WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: dashboard.php?pesan=Data berhasil dihapus");
    exit;
}

// 3. Ambil Data Galeri
$stmt = $pdo->query("SELECT * FROM culture_gallery ORDER BY id DESC");
$galleries = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../includes/Logos.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Pesona Lampung</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        :root {
            --maroon: #800000;
            --maroon-dark: #600000;
            --gold: #D4AF37;
            --light-gray: #f4f6f9;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-gray);
        }

        /* Sidebar Styling */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, var(--maroon) 0%, var(--maroon-dark) 100%);
            color: white;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            position: fixed;
            width: 250px;
            z-index: 100;
        }

        .sidebar-brand {
            font-family: 'Playfair Display', serif;
            color: var(--gold);
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .nav-link {
            color: rgba(255,255,255,0.7);
            padding: 12px 20px;
            margin: 5px 10px;
            border-radius: 8px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(5px);
        }

        .nav-link.active {
            background-color: var(--gold);
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }

        /* Table Card */
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .table thead th {
            background-color: #2c3e50;
            color: white;
            font-weight: 500;
            border: none;
            padding: 15px;
            white-space: nowrap; /* Mencegah judul kolom terpotong */
        }

        .table tbody td {
            vertical-align: middle;
            padding: 15px;
        }

        .img-thumb {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* Styling Tombol Aksi yang Baru */
        .btn-action {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px; /* Sudut lebih membulat */
            transition: all 0.2s ease;
            border: 2px solid transparent;
        }
        
        .btn-outline-warning.btn-action {
            color: #f39c12;
            border-color: #f39c12;
            background-color: #fff8e1;
        }
        .btn-outline-warning.btn-action:hover {
            background-color: #f39c12;
            color: white;
            box-shadow: 0 4px 8px rgba(243, 156, 18, 0.3);
        }

        .btn-outline-danger.btn-action {
            color: #e74c3c;
            border-color: #e74c3c;
            background-color: #fdeded;
        }
        .btn-outline-danger.btn-action:hover {
            background-color: #e74c3c;
            color: white;
            box-shadow: 0 4px 8px rgba(231, 76, 60, 0.3);
        }

        .btn-maroon {
            background-color: var(--maroon);
            color: white;
            border: none;
        }
        .btn-maroon:hover {
            background-color: var(--maroon-dark);
            color: white;
        }

        /* Responsive Mobile */
        @media (max-width: 768px) {
            .sidebar { width: 70px; padding: 0; }
            .sidebar-brand span, .nav-link span { display: none; }
            .sidebar-brand, .nav-link { justify-content: center; padding: 15px 0; }
            .main-content { margin-left: 70px; padding: 15px; }
        }
    </style>
</head>
<body>

<div class="sidebar d-flex flex-column">
    <div class="sidebar-brand text-center">
        <h4 class="mb-0">Arya<span style="color:white">Panel</span></h4>
    </div>
    
    <ul class="nav flex-column mt-4">
        <li class="nav-item">
            <a class="nav-link active" href="dashboard.php">
                <i class="bi bi-grid-fill"></i> <span>Kelola Budaya</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="edit_sejarah.php">
                <i class="bi bi-pencil-square"></i> <span>Edit Sejarah</span>
            </a>
        </li>
        
        <li class="nav-item mt-auto mb-4">
            <a class="nav-link text-danger" href="logout.php" style="background: rgba(255,0,0,0.1);">
                <i class="bi bi-box-arrow-right"></i> <span>Logout</span>
            </a>
        </li>
    </ul>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">Manajemen Budaya</h2>
            <p class="text-muted">Kelola konten Pesona Lampung dengan mudah.</p>
        </div>
        <div class="d-flex gap-3 align-items-center">
            <div class="bg-white px-3 py-2 rounded shadow-sm d-none d-md-block">
                <small class="text-muted d-block">Admin Login</small>
                <span class="fw-bold text-maroon"><?= $_SESSION['admin'] ?></span>
            </div>
            <a href="tambah_budaya.php" class="btn btn-maroon px-4 py-2 rounded-3 shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Data
            </a>
        </div>
    </div>

    <?php if(isset($_GET['pesan'])): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> <?= $_GET['pesan'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card card-custom bg-white">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Thumbnail</th>
                            <th>Judul Budaya</th>
                            <th>Kategori</th>
                            <th class="text-center" style="min-width: 120px;">Aksi</th> </tr>
                    </thead>
                    <tbody>
                        <?php if(count($galleries) > 0): ?>
                            <?php foreach($galleries as $g): ?>
                            <tr>
                                <td class="ps-4">
                                    <img src="../assets/img/<?= $g['image_url'] ?>" class="img-thumb" alt="Thumb">
                                </td>
                                <td>
                                    <span class="fw-bold d-block text-dark"><?= $g['title'] ?></span>
                                    <small class="text-muted"><?= substr($g['description'], 0, 50) ?>...</small>
                                </td>
                                <td>
                                    <?php 
                                        $badgeColor = 'bg-secondary';
                                        
                                        // LOGIKA WARNA KATEGORI
                                        if($g['category'] == 'Tari') $badgeColor = 'bg-primary';
                                        elseif($g['category'] == 'Rumah Adat') $badgeColor = 'bg-success';
                                        elseif($g['category'] == 'Kain') $badgeColor = 'bg-warning text-dark';
                                        
                                        // --- TAMBAHAN BARU ---
                                        elseif($g['category'] == 'Senjata') $badgeColor = 'bg-danger'; // Warna Merah
                                        elseif($g['category'] == 'Makanan Khas') $badgeColor = 'bg-info text-dark'; // Warna Biru Muda/Cyan
                                        // ---------------------
                                    ?>
                                    <span class="badge <?= $badgeColor ?> px-3 py-2 rounded-pill"><?= $g['category'] ?></span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="edit_budaya.php?id=<?= $g['id'] ?>" class="btn btn-action btn-outline-warning" title="Edit Data">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <a href="dashboard.php?hapus=<?= $g['id'] ?>" 
                                           class="btn btn-action btn-outline-danger" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus data ini? Data yang dihapus tidak dapat dikembalikan.')" 
                                           title="Hapus Data">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted"> <img src="https://cdn-icons-png.flaticon.com/512/7486/7486754.png" width="80" class="mb-3 opacity-50"><br>
                                    Belum ada data budaya. Silakan tambah baru.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <footer class="mt-5 text-center text-muted small">
        &copy; 2025 Pesona Budaya Lampung Admin Panel.
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>