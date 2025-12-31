<?php
session_start();
include '../config/config.php';

// 1. Cek Login Admin
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$error = "";

// 2. Logika Simpan Data
if (isset($_POST['simpan'])) {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $desc = $_POST['description'];

    $nama_file = $_FILES['image']['name'];
    $tmp_file = $_FILES['image']['tmp_name'];
    
    $ekstensi_valid = ['jpg', 'jpeg', 'png', 'webp'];
    $ekstensi_file = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));

    if (!in_array($ekstensi_file, $ekstensi_valid)) {
        $error = "Format file tidak valid. Gunakan JPG, PNG, atau WEBP.";
    } else {
        $nama_baru = uniqid() . '.' . $ekstensi_file;
        $tujuan = "../assets/img/" . $nama_baru;

        if (!is_dir("../assets/img")) mkdir("../assets/img", 0777, true);

        if (move_uploaded_file($tmp_file, $tujuan)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO culture_gallery (title, category, description, image_url) VALUES (?, ?, ?, ?)");
                $stmt->execute([$title, $category, $desc, $nama_baru]);
                header("Location: dashboard.php?pesan=Data berhasil ditambahkan");
                exit;
            } catch (PDOException $e) {
                $error = "Database Error: " . $e->getMessage();
            }
        } else {
            $error = "Gagal mengupload gambar. Periksa izin folder.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../includes/Logos.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Budaya - Admin Panel</title>
    
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
        
        body { font-family: 'Inter', sans-serif; background-color: var(--light-gray); }

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

        .main-content { margin-left: 250px; padding: 30px; }

        .card-form { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        .form-label { font-weight: 600; color: #2c3e50; }
        .form-control, .form-select { padding: 12px; border-radius: 8px; border: 1px solid #dee2e6; }
        .form-control:focus, .form-select:focus { border-color: var(--gold); box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25); }

        .btn-maroon {
            background-color: var(--maroon);
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            border: none;
            font-weight: 500;
            transition: 0.3s;
        }
        .btn-maroon:hover {
            background-color: var(--maroon-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(128, 0, 0, 0.2);
            color: white;
        }

        /* --- PERBAIKAN RESPONSIF UNTUK HP --- */
        @media (max-width: 768px) {
            .sidebar { width: 70px; padding: 0; }
            .sidebar-brand span, .nav-link span { display: none; }
            .sidebar-brand, .nav-link { justify-content: center; padding: 15px 0; }
            .main-content { margin-left: 70px; padding: 20px; }
            
            /* Ini Kode Agar Tombol Rapi di HP */
            .button-group {
                flex-direction: column-reverse; /* Tombol Simpan diatas Reset */
                gap: 15px !important;
            }
            .button-group button {
                width: 100%; /* Tombol jadi lebar penuh */
                padding: 15px; /* Lebih mudah ditekan */
            }
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
            <a class="nav-link" href="dashboard.php"><i class="bi bi-grid"></i> <span>Kelola Budaya</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="edit_sejarah.php"><i class="bi bi-pencil-square"></i> <span>Edit Sejarah</span></a>
        </li>
        <li class="nav-item mt-auto mb-4">
            <a class="nav-link text-danger" href="logout.php"><i class="bi bi-box-arrow-right"></i> <span>Logout</span></a>
        </li>
    </ul>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">Tambah Budaya</h2>
            <p class="text-muted">Isi formulir di bawah untuk menambahkan konten baru.</p>
        </div>
        <a href="dashboard.php" class="btn btn-outline-secondary px-4 py-2 rounded-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <?php if ($error): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $error ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card card-form bg-white">
        <div class="card-body p-4 p-md-5">
            <form method="POST" enctype="multipart/form-data">
                
                <div class="row g-4">
                    <div class="col-md-8">
                        <label class="form-label">Judul Budaya <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" required placeholder="Contoh: Tari Sigeh Penguten">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="category" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            <option value="Tari">Tari Daerah</option>
                            <option value="Rumah Adat">Rumah Adat</option>
                            <option value="Kain">Kain & Wastra</option>
                            <option value="Senjata">Senjata Tradisional</option>
                            <option value="Kuliner">Kuliner Khas</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Deskripsi Lengkap <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control" rows="6" required placeholder="Tuliskan penjelasan detail..."></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Gambar Utama <span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control" required accept=".jpg,.jpeg,.png,.webp">
                        <div class="form-text">Format: JPG, PNG, WEBP. Maksimal 2MB.</div>
                    </div>
                </div>

                <hr class="my-4 text-muted opacity-25">

                <div class="d-flex justify-content-end gap-3 button-group">
                    <button type="reset" class="btn btn-light px-4 py-2 border">Reset</button>
                    <button type="submit" name="simpan" class="btn btn-maroon">
                        <i class="bi bi-cloud-arrow-up-fill me-2"></i> Publikasikan Konten
                    </button>
                </div>

            </form>
        </div>
    </div>
    
    <footer class="mt-5 text-center text-muted small">
        &copy; 2025 Pesona Budaya Lampung Admin Panel.
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>