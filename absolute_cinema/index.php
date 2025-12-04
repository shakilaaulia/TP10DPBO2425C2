<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Booking System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-film"></i> ABSOLUTE CINEMA
            </a>
        </div>
    </nav>

    <header class="hero">
        <div class="container">
            <h1>Selamat Datang Cinephile</h1>
            <p>Kelola Film, Studio, Jadwal, dan Tiket dengan Mudah & Cepat</p>
        </div>
    </header>

    <div class="container my-5">
        <div class="row g-4">

            <div class="col-md-6 col-lg-3">
                <div class="card card-menu">
                    <div class="card-body">
                        <div class="icon-box">
                            <i class="fas fa-video"></i>
                        </div>
                        <h5 class="card-title">Data Film</h5>
                        <p class="card-text">Input film baru, edit genre, durasi, dan poster film.</p>
                        <a href="views/film/index.php" class="btn-action">Kelola Film</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card card-menu">
                    <div class="card-body">
                        <div class="icon-box">
                            <i class="fas fa-couch"></i>
                        </div>
                        <h5 class="card-title">Data Studio</h5>
                        <p class="card-text">Atur nama studio dan kapasitas kursi penonton.</p>
                        <a href="views/studio/index.php" class="btn-action">Kelola Studio</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card card-menu">
                    <div class="card-body">
                        <div class="icon-box">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h5 class="card-title">Jadwal Tayang</h5>
                        <p class="card-text">Hubungkan Film dengan Studio dan atur jam tayang.</p>
                        <a href="views/jadwal/index.php" class="btn-action">Atur Jadwal</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card card-menu">
                    <div class="card-body">
                        <div class="icon-box">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <h5 class="card-title">Penjualan Tiket</h5>
                        <p class="card-text">Transaksi pembelian tiket untuk pelanggan (Kasir).</p>
                        <a href="views/tiket/index.php" class="btn-action">Beli Tiket</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2025 Absolute Cinema Tix System</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>