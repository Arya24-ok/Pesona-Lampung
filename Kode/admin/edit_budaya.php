<?php
session_start();
include '../config/config.php';

// 1. Cek Login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// 2. Cek ID di URL
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];

// 3. Ambil Data Lama
$stmt = $pdo->prepare("SELECT * FROM culture_gallery WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) {
    die("Data tidak ditemukan!");
}

// 4. Proses Update
if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $desc = $_POST['description'];
    $gambar_lama = $_POST['gambar_lama'];

    // Cek apakah user upload gambar baru?
    if ($_FILES['image']['error'] === 4) {
        $gambar_baru = $gambar_lama; 
    } else {
        $nama_file = $_FILES['image']['name'];
        $tmp_file = $_FILES['image']['tmp_name'];
        $ekstensi = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
        $gambar_baru = uniqid() . '.' . $ekstensi;
        
        move_uploaded_file($tmp_file, "../assets/img/" . $gambar_baru);
        if (file_exists("../assets/img/" . $gambar_lama)) {
            unlink("../assets/img/" . $gambar_lama);
        }
    }

    $sql = "UPDATE culture_gallery SET title=?, category=?, description=?, image_url=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $category, $desc, $gambar_baru, $id]);

    header("Location: dashboard.php?pesan=Data berhasil diupdate");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../includes/Logos.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Budaya - Admin Panel</title>
    
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

        /* Sidebar Styling Desktop */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, var(--maroon) 0%, var(--maroon-dark) 100%);
            color: white;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            position: fixed;
            width: 250px;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .sidebar-brand {
            font-family: 'Playfair Display', serif;
            color: var(--gold);
            padding: 20px; /* Padding besar di desktop */
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .nav-link {
            color: rgba(255,255,255,0.8);
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
            color: #800000 !important; 
            font-weight: 700;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        }
        .nav-link.active i {
            color: #800000 !important;
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
            transition: all 0.3s ease;
        }

        .card-form {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

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
            box-shadow: 0 4px 10px rgba(128, 0, 0, 0.2);
            color: white;
            transform: translateY(-2px);
        }

        /* --- MOBILE RESPONSIVE (PERBAIKAN DI SINI) --- */
        @media (max-width: 768px) {
            .sidebar { width: 70px; padding: 0; }
            
            /* 1. Atur wadah judul agar muat di lebar 70px */
            .sidebar-brand {
                padding: 15px 0 !important; /* Hapus padding samping kiri-kanan */
                text-align: center;
                width: 100%;
            }

            /* 2. Paksa teks 'Arya' tampil */
            .sidebar-brand h4 { 
                display: block !important; 
                font-size: 15px !important; /* Ukuran font pas */
                margin: 0;
                color: var(--gold);
            }
            
            /* 3. Sembunyikan kata 'Panel' */
            .sidebar-brand h4 span { 
                display: none !important; 
            }

            .nav-link span { display: none; }
            .nav-link { justify-content: center; padding: 15px 0; }
            
            .main-content { margin-left: 70px; padding: 20px; }
            
            .btn { width: 100%; margin-bottom: 10px; }
            .button-group { flex-direction: column-reverse; gap: 10px !important; }
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
                <i class="bi bi-grid"></i> <span>Kelola Budaya</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="edit_sejarah.php">
                <i class="bi bi-pencil-square"></i> <span>Edit Sejarah</span>
            </a>
        </li>
        <li class="nav-item mt-auto mb-4">
            <a class="nav-link text-danger" href="logout.php">
                <i class="bi bi-box-arrow-right"></i> <span>Logout</span>
            </a>
        </li>
    </ul>
</div>

<div class="main-content">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">Edit Budaya</h2>
            <p class="text-muted">Perbarui informasi konten budaya ini.</p>
        </div>
        <a href="dashboard.php" class="btn btn-outline-secondary px-4 py-2 rounded-3 d-none d-md-inline-block">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
        <a href="dashboard.php" class="btn btn-sm btn-outline-secondary d-md-none">
            <i class="bi bi-arrow-left"></i>
        </a>
    </div>

    <div class="card card-form bg-white">
        <div class="card-body p-4 p-md-5">
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="gambar_lama" value="<?= $data['image_url'] ?>">
                
                <div class="row g-4">
                    <div class="col-md-8">
                        <label class="form-label">Judul Budaya <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($data['title']) ?>" required>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="category" class="form-select" required>
                            <option value="Tari" <?= $data['category'] == 'Tari' ? 'selected' : '' ?>>Tari Daerah</option>
                            <option value="Rumah Adat" <?= $data['category'] == 'Rumah Adat' ? 'selected' : '' ?>>Rumah Adat</option>
                            <option value="Kain" <?= $data['category'] == 'Kain' ? 'selected' : '' ?>>Kain & Wastra</option>
                            <option value="Senjata" <?= $data['category'] == 'Senjata' ? 'selected' : '' ?>>Senjata Tradisional</option>
                            <option value="Kuliner" <?= $data['category'] == 'Kuliner' ? 'selected' : '' ?>>Kuliner Khas</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Deskripsi Lengkap <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control" rows="6" required><?= htmlspecialchars($data['description']) ?></textarea>
                    </div>

                    <div class="col-12">
                        <div class="row align-items-center bg-light p-3 rounded-3 border">
                            <div class="col-md-3 text-center mb-3 mb-md-0">
                                <label class="form-label small text-muted d-block mb-2">Gambar Saat Ini</label>
                                <img src="../assets/img/<?= $data['image_url'] ?>" class="img-thumbnail rounded shadow-sm" style="max-height: 100px; object-fit: cover;">
                            </div>
                            <div class="col-md-9">
                                <label class="form-label fw-bold">Ganti Gambar (Opsional)</label>
                                <input type="file" name="image" class="form-control mb-1">
                                <small class="text-muted fst-italic">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4 text-muted opacity-25">

                <div class="d-flex justify-content-end gap-3 button-group">
                    <a href="dashboard.php" class="btn btn-light px-4 py-2 border">Batal</a>
                    <button type="submit" name="update" class="btn btn-maroon">
                        <i class="bi bi-save me-2"></i> Simpan Perubahan
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