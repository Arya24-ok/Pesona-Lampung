<?php
include 'config/config.php';
include 'includes/header.php';

// Tangkap kata kunci pencarian
$keyword = isset($_GET['q']) ? $_GET['q'] : '';

// Cari di database (Judul ATAU Deskripsi yang mengandung kata kunci)
$stmt = $pdo->prepare("SELECT * FROM culture_gallery WHERE title LIKE ? OR description LIKE ?");
$params = ["%$keyword%", "%$keyword%"];
$stmt->execute($params);
$results = $stmt->fetchAll();
?>

<div class="container py-5" style="min-height: 60vh;">
    <h3 class="mb-4">
        Hasil Pencarian: " <span class="text-maroon fw-bold"><?= htmlspecialchars($keyword) ?></span> "
    </h3>

    <?php if (count($results) > 0): ?>
        <p class="text-muted mb-4">Ditemukan <?= count($results) ?> data budaya.</p>
        
        <div class="row g-4">
            <?php foreach ($results as $item): ?>
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm custom-card">
                    <div class="position-relative">
                        <span class="badge bg-maroon position-absolute top-0 start-0 m-2"><?= $item['category'] ?></span>
                        <img src="assets/img/<?= $item['image_url'] ?>" class="card-img-top" style="height: 180px; object-fit: cover;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold" style="font-size: 1rem;"><?= $item['title'] ?></h5>
                        <p class="small text-muted"><?= substr($item['description'], 0, 60) ?>...</p>
                        <a href="detail.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-outline-dark w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center py-5">
            <h4><i class="bi bi-search"></i> Ops!</h4>
            <p>Tidak ditemukan budaya dengan kata kunci "<strong><?= htmlspecialchars($keyword) ?></strong>".</p>
            <a href="index.php" class="btn btn-maroon mt-2">Kembali ke Beranda</a>
        </div>
    <?php endif; ?>
</div>

<style>
    .text-maroon { color: #800000; }
    .bg-maroon { background-color: #800000; }
    .btn-maroon { background-color: #800000; color: white; }
    .custom-card:hover { transform: translateY(-5px); transition: 0.3s; }
</style>

<?php include 'includes/footer.php'; ?>