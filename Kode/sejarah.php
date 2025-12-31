<?php
include 'config/config.php';
include 'includes/header.php';

// Ambil data sejarah dari database
$stmt = $pdo->query("SELECT * FROM history LIMIT 1");
$data = $stmt->fetch();

// Default jika belum ada data
$konten = $data ? $data['content'] : "Belum ada data sejarah yang diinput oleh Admin.";
$update = $data ? date('d F Y', strtotime($data['last_updated'])) : "-";
?>

<div class="bg-maroon py-5 text-center text-white mb-5" style="background-color: #800000;">
    <h1 class="display-4 fw-bold" style="font-family: 'Playfair Display', serif; color: #D4AF37;">Sejarah Lampung</h1>
    <p class="lead opacity-75">Asal usul dan perjalanan panjang Sang Bumi Ruwa Jurai</p>
</div>

<div class="container pb-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 mb-4">
                <div class="d-flex align-items-center mb-4 text-muted small">
                    <i class="bi bi-clock-history me-2"></i> Terakhir diperbarui: <?= $update ?>
                </div>
                
                <article class="content-text" style="line-height: 1.8; text-align: justify; font-size: 1.1rem;">
                    <?= nl2br($konten) ?> 
                </article>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4 bg-light">
                <div class="card-body">
                    <h5 class="fw-bold text-maroon mb-3">Fakta Singkat</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">🏛️ <strong>Ibu Kota:</strong> Bandar Lampung</li>
                        <li class="mb-2">📜 <strong>Semboyan:</strong> Sang Bumi Ruwa Jurai</li>
                        <li class="mb-2">🌏 <strong>Posisi:</strong> Gerbang Pulau Sumatera</li>
                        <li class="mb-2">📅 <strong>Hari Jadi:</strong> 18 Maret 1964</li>
                    </ul>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold">Galeri Terbaru</div>
                <div class="card-body">
                    <div class="row g-2">
                        <?php
                        $stmt_img = $pdo->query("SELECT image_url FROM culture_gallery ORDER BY id DESC LIMIT 4");
                        while($img = $stmt_img->fetch()):
                        ?>
                        <div class="col-6">
                            <img src="assets/img/<?= $img['image_url'] ?>" class="img-fluid rounded" style="height: 80px; object-fit: cover; width: 100%;">
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <a href="semua_budaya.php" class="btn btn-sm btn-outline-maroon w-100 mt-3">Lihat Galeri</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .text-maroon { color: #800000; }
    .btn-outline-maroon { color: #800000; border-color: #800000; }
    .btn-outline-maroon:hover { background: #800000; color: #D4AF37; }
</style>

<?php include 'includes/footer.php'; ?>