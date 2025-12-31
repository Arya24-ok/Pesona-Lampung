<?php
session_start();
include '../config/config.php';

// Jika sudah login, langsung lempar ke dashboard
if (isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
    exit;
}

$error = "";

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Ambil data user dari database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$user]);
    $admin = $stmt->fetch();

    // Verifikasi password
    if ($admin && password_verify($pass, $admin['password'])) {
        $_SESSION['admin'] = $admin['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <link rel="icon" href="../includes/Logos.png" type="image/png">
    
    <title>Login Admin - Pesona Lampung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body { 
            background-color: #f4f4f4; 
            min-height: 100vh; /* Gunakan min-height agar aman di HP kecil */
            display: flex; 
            align-items: center; 
            justify-content: center; /* Pastikan selalu di tengah horizontal */
            padding: 20px; /* Jarak aman di layar HP supaya tidak mepet */
        }
        
        .login-card { 
            max-width: 400px; 
            width: 100%; 
            border: none; 
            border-radius: 15px; 
            overflow: hidden; 
            /* Shadow lebih lembut */
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); 
        }
        
        .bg-maroon { background-color: #800000 !important; }
        .text-gold { color: #D4AF37 !important; }
        
        .btn-maroon { 
            background-color: #800000; 
            color: white; 
            padding: 12px; /* Tombol lebih besar agar mudah ditekan di HP */
            font-weight: 500;
        }
        .btn-maroon:hover { background-color: #600000; color: #D4AF37; }
        
        /* Agar input form lebih enak dilihat di HP */
        .form-control { padding: 10px 15px; }
    </style>
</head>
<body>

<div class="card login-card">
    <div class="card-header bg-maroon text-center py-4">
        <h4 class="text-gold mb-0 fw-bold">Admin Login</h4>
        <small class="text-white-50">Pesona Budaya Lampung</small>
    </div>
    
    <div class="card-body p-4 p-md-5"> <?php if ($error): ?>
            <div class="alert alert-danger small py-2 text-center"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Username</label>
                <input type="text" name="username" class="form-control" required placeholder="Masukkan username">
            </div>
            <div class="mb-4">
                <label class="form-label small fw-bold text-secondary">Password</label>
                <input type="password" name="password" class="form-control" required placeholder="******">
            </div>
            <button type="submit" name="login" class="btn btn-maroon w-100 rounded-3">Masuk ke Dashboard</button>
        </form>
    </div>
    
    <div class="card-footer text-center py-3 bg-white border-0">
        <a href="../index.php" class="text-muted small text-decoration-none hover-gold">
            &larr; Kembali ke Website
        </a>
    </div>
</div>

</body>
</html>