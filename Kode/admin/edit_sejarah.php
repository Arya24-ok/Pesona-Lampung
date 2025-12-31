<?php
session_start();
include '../config/config.php';

// 1. Proteksi Halaman
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$pesan = "";

// 2. Logika Simpan
if (isset($_POST['simpan'])) {
    $isi_sejarah = $_POST['content'];
    
    $cek = $pdo->query("SELECT id FROM history LIMIT 1")->fetch();
    
    if ($cek) {
        $stmt = $pdo->prepare("UPDATE history SET content = ?, last_updated = NOW() WHERE id = ?");
        $stmt->execute([$isi_sejarah, $cek['id']]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO history (content) VALUES (?)");
        $stmt->execute([$isi_sejarah]);
    }
    
    $pesan = "Data sejarah berhasil diperbarui!";
}

// 3. Ambil Data
$stmt = $pdo->query("SELECT * FROM history LIMIT 1");
$data = $stmt->fetch();
$konten_lama = $data ? $data['content'] : "";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../includes/Logos.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sejarah - Admin Panel</title>
    
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
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .sidebar-brand {
            font-family: 'Playfair Display', serif;
            color: var(--gold);
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        /* --- STYLING MENU & FIX IKON --- */
        .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 5px 10px;
            border-radius: 8px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 12px; 
            position: relative;
        }

        /* Styling dasar Ikon */
        .nav-link i {
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.3s;
        }

        .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(5px);
        }

        /* --- STATE AKTIF (Tombol Kuning) --- */
        .nav-link.active {
            background-color: var(--gold);
            color: #800000 !important; 
            font-weight: 700;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        }
        
        .nav-link.active i {
            color: #800000 !important;
        }
        
        .nav-link.active span {
            color: #800000 !important;
        }

        /* --- Main Content Styling --- */
        .main-content { margin-left: 250px; padding: 30px; transition: all 0.3s ease; }

        .card-custom { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        .form-control { padding: 15px; border-radius: 8px; border: 1px solid #dee2e6; line-height: 1.6; }
        .form-control:focus { border-color: var(--gold); box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25); }

        .btn-custom {
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-maroon {
            background-color: var(--maroon);
            color: white;
            border: none;
        }
        .btn-maroon:hover {
            background-color: var(--maroon-dark);
            box-shadow: 0 4px 10px rgba(128, 0, 0, 0.2);
            color: white;
            transform: translateY(-2px);
        }

        .btn-reset {
            background-color: white;
            border: 1px solid #ced4da;
            color: #6c757d;
        }
        .btn-reset:hover { background-color: #f1f3f5; color: #212529; }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar { width: 70px; padding: 0; }
            
            /* --- PERBAIKAN DI SINI --- */
            .sidebar-brand {
                padding: 15px 5px; /* Kurangi padding biar muat */
            }
            
            /* Munculkan Tulisan 'Arya' saja */
            .sidebar-brand h4 { 
                display: block; 
                font-size: 1.1rem; /* Ukuran font disesuaikan */
                margin-bottom: 0;
            }
            
            /* Sembunyikan Tulisan 'Panel' agar muat di 70px */
            .sidebar-brand h4 span { 
                display: none; 
            }
            
            .nav-link span { display: none; }
            
            /* Center icon di mode mobile */
            .nav-link { 
                justify-content: center; 
                padding: 15px 0; 
                text-align: center;
                gap: 0; 
            }
            .nav-link i {
                margin: 0;
                font-size: 1.4rem; 
            }
            
            .main-content { margin-left: 70px; padding: 20px; }
            
            .btn-custom { width: 100%; margin-bottom: 10px; }
            .d-flex-mobile-stack { flex-direction: column-reverse; gap: 10px !important; }
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
            <a class="nav-link" href="dashboard.php">
                <i class="bi bi-grid"></i> <span>Kelola Budaya</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link active" href="edit_sejarah.php">
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
            <h2 class="fw-bold text-dark">Edit Sejarah</h2>
            <p class="text-muted">Perbarui artikel sejarah yang tampil di halaman depan.</p>
        </div>
        <a href="dashboard.php" class="btn btn-outline-secondary px-4 py-2 rounded-3 d-none d-md-inline-block">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
        <a href="dashboard.php" class="btn btn-sm btn-outline-secondary d-md-none">
            <i class="bi bi-arrow-left"></i>
        </a>
    </div>

    <?php if ($pesan): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> <?= $pesan ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card card-custom bg-white">
        <div class="card-body p-4 p-md-5">
            <form method="POST">
                <div class="mb-4">
                    <label class="form-label fw-bold">Isi Artikel Sejarah</label>
                    <div class="alert alert-info py-2 px-3 small border-0 bg-opacity-10 mb-3" role="alert">
                        <i class="bi bi-info-circle me-2"></i> 
                        Tips: Gunakan tombol <strong>Enter</strong> dua kali untuk membuat paragraf baru.
                    </div>
                    
                    <textarea name="content" 
                              class="form-control" 
                              rows="15" 
                              required 
                              style="resize: none;"
                              placeholder="Mulai menulis sejarah lengkap Lampung di sini..."><?= htmlspecialchars($konten_lama) ?></textarea>
                </div>
                
                <hr class="my-4 text-muted opacity-25">

                <div class="d-flex d-flex-mobile-stack justify-content-end gap-2 gap-md-3">
                    <button type="reset" class="btn btn-custom btn-reset">
                        Reset
                    </button>
                    <button type="submit" name="simpan" class="btn btn-custom btn-maroon">
                        <i class="bi bi-save"></i> Simpan Perubahan
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