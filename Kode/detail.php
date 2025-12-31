<?php
include 'config/config.php';
include 'includes/header.php';

// 1. Cek apakah ada ID di URL
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// 2. Ambil data spesifik berdasarkan ID
$stmt = $pdo->prepare("SELECT * FROM culture_gallery WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

// 3. Logika untuk URL Share Medsos
$current_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$share_text = "Lihat keindahan " . ($data ? $data['title'] : 'Budaya Lampung') . " di website Pesona Lampung!";

// Jika data tidak ditemukan
if (!$data) {
    echo "<div class='container py-5 text-center' style='min-height: 70vh;'>
            <h3>Data tidak ditemukan!</h3>
            <a href='index.php' class='btn btn-primary mt-3'>Kembali ke Beranda</a>
          </div>";
    include 'includes/footer.php';
    exit;
}
?>

<div class="container py-5" style="min-height: 80vh;">
    
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-muted">Home</a></li>
            <li class="breadcrumb-item"><a href="semua_budaya.php" class="text-decoration-none text-muted">Galeri</a></li>
            <li class="breadcrumb-item active text-maroon fw-bold" aria-current="page"><?= htmlspecialchars($data['title']) ?></li>
        </ol>
    </nav>

    <div class="row g-5">
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg overflow-hidden rounded-3">
                <img src="assets/img/<?= htmlspecialchars($data['image_url']) ?>" 
                     class="img-fluid w-100" 
                     style="object-fit: cover; height: 400px;" 
                     alt="<?= htmlspecialchars($data['title']) ?>">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="d-flex align-items-center mb-3">
                <span class="badge bg-maroon px-3 py-2 me-2"><?= htmlspecialchars($data['category']) ?></span>
                <small class="text-muted"><i class="bi bi-calendar3"></i> Diposting: <?= date('d M Y', strtotime($data['created_at'])) ?></small>
            </div>

            <h1 class="fw-bold mb-4" style="color: #800000; font-family: 'Playfair Display', serif;">
                <?= htmlspecialchars($data['title']) ?>
            </h1>

            <div class="content-text text-muted" style="line-height: 1.8; font-size: 1.1rem;">
                <?= nl2br(htmlspecialchars($data['description'])) ?>
            </div>

            <hr class="my-4">

            <div class="mt-4">
                <h5 class="fw-bold mb-3">Bagikan Budaya Ini:</h5>
                
                <a href="https://wa.me/?text=<?= urlencode($share_text . " " . $current_url) ?>" 
                   target="_blank" 
                   class="btn btn-success btn-sm me-2">
                   <i class="bi bi-whatsapp"></i> WhatsApp
                </a>
                
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($current_url) ?>" 
                   target="_blank" 
                   class="btn btn-primary btn-sm me-2">
                   <i class="bi bi-facebook"></i> Facebook
                </a>
                
                <a href="https://twitter.com/intent/tweet?text=<?= urlencode($share_text) ?>&url=<?= urlencode($current_url) ?>" 
                   target="_blank" 
                   class="btn btn-dark btn-sm">
                   <i class="bi bi-twitter"></i> Twitter
                </a>
            </div>
            
            <div class="mt-4">
                <a href="semua_budaya.php" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Kembali ke Galeri
                </a>
            </div>
        </div>
    </div>
    
</div>

<style>
    .text-maroon { color: #800000; }
    .bg-maroon { background-color: #800000; color: white; }
</style>

<?php include 'includes/footer.php'; ?>