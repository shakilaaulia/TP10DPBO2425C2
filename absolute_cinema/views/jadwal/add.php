<?php
// Memanggil 3 ViewModel karena kita butuh data Film dan Studio untuk Dropdown
require_once '../../viewmodels/JadwalViewModel.php';
require_once '../../viewmodels/FilmViewModel.php';
require_once '../../viewmodels/StudioViewModel.php';

$jadwalVM = new JadwalViewModel();
$filmVM = new FilmViewModel();
$studioVM = new StudioViewModel();

// Ambil data untuk opsi dropdown
$films = $filmVM->fetchAll();
$studios = $studioVM->fetchAll();

// Proses Simpan Data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pastikan data dikirim ke ViewModel sesuai format
    $result = $jadwalVM->addJadwal($_POST);
    if ($result) {
        header("Location: index.php"); // Redirect sukses
        exit;
    } else {
        echo "<script>alert('Gagal menyimpan jadwal!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal - Cinema Tix</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../views-style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark mb-5">
        <div class="container">
            <a class="navbar-brand" href="../../index.php">
                <i class="fas fa-film"></i> ABSOLUTE CINEMA
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-custom">
                    <div class="card-header py-3">
                        <i class="fas fa-plus-circle me-2"></i> Tambah Jadwal Tayang Baru
                    </div>
                    <div class="card-body p-4">

                        <form method="POST" action="">

                            <div class="mb-4">
                                <label class="form-label">Pilih Film</label>
                                <select name="id_film" class="form-select" required>
                                    <option value="" selected disabled>-- Pilih Judul Film --</option>
                                    <?php foreach ($films as $f): ?>
                                        <option value="<?= $f['id'] ?>"><?= $f['judul'] ?> (<?= $f['genre'] ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Pilih Studio</label>
                                <select name="id_studio" class="form-select" required>
                                    <option value="" selected disabled>-- Pilih Studio --</option>
                                    <?php foreach ($studios as $s): ?>
                                        <option value="<?= $s['id'] ?>"><?= $s['nama_studio'] ?> (Kapasitas:
                                            <?= $s['kapasitas'] ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Tanggal Tayang</label>
                                    <input type="date" name="tgl_tayang" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Jam Tayang</label>
                                    <input type="time" name="jam_tayang" class="form-control" required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-3">
                                <a href="index.php" class="btn btn-cancel px-4">Batal</a>
                                <button type="submit" class="btn btn-save px-4">Simpan Jadwal</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>