<?php
require_once '../../viewmodels/FilmViewModel.php';
$viewModel = new FilmViewModel();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($viewModel->addFilm($_POST)) {
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Film - Cinema Tix</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../views-style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-5">
        <div class="container">
            <a class="navbar-brand" href="../../index.php"><i class="fas fa-film"></i> ABSOLUTE CINEMA</a>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-custom">
                    <div class="card-header py-3"><i class="fas fa-plus-circle me-2"></i> Tambah Film Baru</div>
                    <div class="card-body p-4">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label class="form-label">Judul Film</label>
                                <input type="text" name="judul" class="form-control"
                                    placeholder="Contoh: Avengers: Secret Wars" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Genre</label>
                                <input type="text" name="genre" class="form-control"
                                    placeholder="Contoh: Action, Horror, Drama" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Durasi (Menit)</label>
                                    <input type="number" name="durasi" class="form-control" placeholder="120" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Harga Dasar (Rp)</label>
                                    <input type="number" name="harga" class="form-control" placeholder="50000" required>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-2 mt-3">
                                <a href="index.php" class="btn btn-cancel px-4">Batal</a>
                                <button type="submit" class="btn btn-save px-4">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>