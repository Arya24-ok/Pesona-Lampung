<?php
include 'config/config.php';
include 'includes/header.php';

// Ambil semua data tanpa limit
$stmt = $pdo->query("SELECT * FROM culture_gallery ORDER BY title ASC");
$galleries = $stmt->fetchAll();
?>

<div class="bg-light py-5 text-center mb-5">
    <h1 class="fw-bold" style="font-family: 'Playfair Display', serif; color: #800000;">Galeri Lengkap</h1>
    <p class="text-muted">Menjelajahi seluruh kekayaan budaya Provinsi Lampung</p>
</div>

<div class="container pb-5">
    <div class="row g-4">
        <?php foreach ($galleries as $item): ?>
        <div class="col-md-3"> <div class="card h-100 border-0 shadow-sm custom-card">
                <div class="position-relative">
                    <span class="badge bg-maroon position-absolute top-0 start-0 m-2"><?= $item['category'] ?></span>
                    <img src="assets/img/<?= $item['image_url'] ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                </div>
                <div class="card-body">
                    <h5 class="card-title fw-bold" style="font-size: 1.1rem;"><?= $item['title'] ?></h5>
                    <a href="detail.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-outline-dark w-100 mt-2">Lihat Detail</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>