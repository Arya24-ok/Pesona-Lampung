<?php 
include 'config/config.php'; // Memastikan koneksi database aktif
include 'includes/header.php'; 

// Mengambil data galeri dari database
try {
    $stmt = $pdo->query("SELECT * FROM culture_gallery ORDER BY id DESC LIMIT 6");
    $galleries = $stmt->fetchAll();
} catch (PDOException $e) {
    $galleries = []; // Fallback jika query gagal
}
?>

<header class="py-5 border-bottom bg-light" style="background: linear-gradient(rgba(128,0,0,0.8), rgba(128,0,0,0.8)), url('https://images.unsplash.com/photo-1596721590204-740751999905?q=80&w=2070&auto=format&fit=crop'); background-size: cover; background-position: center;">
    <div class="container py-5 text-center text-white">
        <h1 class="display-3 fw-bold mb-3">The Treasure of Sumatra</h1>
        <p class="lead mb-4">Menelusuri kemegahan adat, aksara, dan kearifan lokal Sang Bumi Ruwa Jurai.</p>
        <a href="#galeri" class="btn btn-gold btn-lg px-5 rounded-pill shadow">Jelajahi Sekarang</a>
    </div>
</header>

<section id="galeri" class="container py-5">
    <div class="d-flex justify-content-between align-items-end mb-5">
        <div>
            <h2 class="fw-bold mb-0">Galeri Budaya</h2>
            <p class="text-muted">Koleksi tari, rumah adat, dan wastra Lampung.</p>
        </div>
        <a href="semua_budaya.php" class="text-maroon fw-bold text-decoration-none">Lihat Semua &rarr;</a>
    </div>

    <div class="row g-4">
        <?php if (!empty($galleries)): ?>
            <?php foreach ($galleries as $item): ?>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm custom-card overflow-hidden">
                    <div class="position-relative">
                        <span class="badge bg-maroon position-absolute top-0 start-0 m-3 shadow-sm">
                            <?= htmlspecialchars($item['category']) ?>
                        </span>
                             <img src="assets/img/<?= htmlspecialchars($item['image_url']) ?>" 
                            class="card-img-top" 
                            style="height: 200px; object-fit: cover;" 
                            alt="<?= htmlspecialchars($item['title']) ?>">
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold text-maroon"><?= htmlspecialchars($item['title']) ?></h5>
                        <p class="card-text text-muted small">
                            <?= substr(htmlspecialchars($item['description']), 0, 120) ?>...
                        </p>
                        <a href="detail.php?id=<?= $item['id'] ?>" class="btn btn-outline-maroon btn-sm">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <p class="text-muted">Belum ada konten budaya. Tambahkan melalui <a href="admin/dashboard.php">Dashboard Admin</a>.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
    .btn-outline-maroon { border-color: var(--maroon); color: var(--maroon); }
    .btn-outline-maroon:hover { background-color: var(--maroon); color: white; }
    .custom-card { transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    .custom-card:hover { transform: translateY(-12px); box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; }
</style>

<?php include 'includes/footer.php'; ?>