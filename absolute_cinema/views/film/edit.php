<?php
require_once '../../viewmodels/FilmViewModel.php';
$viewModel = new FilmViewModel();

// Validasi ID
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$data = $viewModel->fetchById($id);

// Proses Update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($viewModel->updateFilm($_POST)) {
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
    <title>Edit Film - Cinema Tix</title>

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
                    <div class="card-header py-3"><i class="fas fa-edit me-2"></i> Edit Data Film</div>
                    <div class="card-body p-4">
                        <form method="POST" action="">
                            <input type="hidden" name="id" value="<?= $data->id ?>">

                            <div class="mb-3">
                                <label class="form-label">Judul Film</label>
                                <input type="text" name="judul" class="form-control" value="<?= $data->judul ?>"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Genre</label>
                                <input type="text" name="genre" class="form-control" value="<?= $data->genre ?>"
                                    required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Durasi (Menit)</label>
                                    <input type="number" name="durasi" class="form-control" value="<?= $data->durasi ?>"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Harga Dasar (Rp)</label>
                                    <input type="number" name="harga" class="form-control"
                                        value="<?= $data->harga_dasar ?>" required>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-2 mt-3">
                                <a href="index.php" class="btn btn-cancel px-4">Batal</a>
                                <button type="submit" class="btn btn-update px-4">Update Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>