<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesona Budaya Lampung</title>
    
    <link rel="icon" href="includes/Logos.png" type="image/png">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --maroon: #800000;
            --gold: #D4AF37;
            --white: #ffffff;
        }
        body { font-family: 'Inter', sans-serif; background-color: var(--white); }
        h1, h2, h3, .navbar-brand { font-family: 'Playfair Display', serif; }
        
        /* Warna Custom */
        .bg-maroon { background-color: var(--maroon) !important; }
        .text-gold { color: var(--gold) !important; }
        .text-maroon { color: var(--maroon) !important; }
        
        /* Navbar Styling */
        .sticky-nav { position: sticky; top: 0; z-index: 1000; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        
        .nav-link { 
            color: rgba(255,255,255,0.85) !important; 
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .nav-link:hover, .nav-link.active { 
            color: var(--gold) !important; 
            transform: translateY(-1px);
        }

        /* Tombol Login */
        .btn-custom-outline {
            border: 1px solid rgba(255,255,255,0.4);
            color: white;
            transition: 0.3s;
        }
        .btn-custom-outline:hover {
            background-color: var(--gold);
            border-color: var(--gold);
            color: white;
        }

        /* Search Input */
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25);
            border-color: var(--gold);
        }

        /* Mobile Responsiveness Tweaks */
        @media (max-width: 991px) {
            .navbar-collapse {
                background-color: #700000; /* Sedikit lebih gelap saat dropdown di HP */
                padding: 1rem;
                border-radius: 0 0 15px 15px;
                margin-top: 10px;
                box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            }
            .nav-link {
                padding: 10px 0;
                border-bottom: 1px solid rgba(255,255,255,0.1);
                text-align: center;
            }
            .nav-link:hover {
                background-color: rgba(255,255,255,0.05);
            }
            .action-group {
                margin-top: 15px;
                flex-direction: column;
            }
            .action-group form, .action-group .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-maroon sticky-nav py-3">
    <div class="container">
        <a class="navbar-brand fs-3 fw-bold d-flex align-items-center gap-2" href="index.php">
            <i class="bi bi-gem text-gold"></i>
            <span>Pesona <span class="text-gold">Lampung</span></span>
        </a>
        
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sejarah.php">Sejarah</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="semua_budaya.php">Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="translate.php">Translate</a>
                </li>
            </ul>
            
            <div class="d-flex align-items-center gap-3 action-group">
                
                <form class="d-flex" action="search.php" method="GET" role="search">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-0 rounded-start-pill ps-3 text-muted">
                            <i class="bi bi-search"></i>
                        </span>
                        <input class="form-control border-0 rounded-end-pill py-2" 
                               type="search" 
                               placeholder="Cari..." 
                               name="q" 
                               aria-label="Search">
                    </div>
                </form>
                
                <a href="admin/login.php" class="btn btn-custom-outline rounded-pill px-4 py-2 fw-semibold">
                    <i class="bi bi-person-fill me-1"></i> Login
                </a>
            </div>
        </div>
    </div>
</nav>