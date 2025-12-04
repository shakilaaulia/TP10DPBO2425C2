<?php
require_once '../../viewmodels/JadwalViewModel.php';
$viewModel = new JadwalViewModel();

// LOGIKA DELETE
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $viewModel->deleteJadwal($_GET['id']);
    header("Location: index.php"); // Refresh halaman setelah hapus
    exit;
}

$dataJadwal = $viewModel->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Jadwal Tayang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../views-style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="../../index.php">
                <i class="fas fa-film"></i> ABSOLUTE CINEMA
            </a>
            <div class="ms-auto">
                <a href="../../index.php" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </nav>

    <div class="container main-container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold"><i class="fas fa-calendar-alt text-danger"></i> Kelola Jadwal Tayang</h2>
            <a href="add.php" class="btn btn-add px-4 py-2 rounded-pill">
                <i class="fas fa-plus"></i> Tambah Jadwal
            </a>
        </div>

        <div class="card card-custom overflow-hidden">
            <div class="table-responsive">
                <table class="table table-dark-custom table-hover">
                    <thead>
                        <tr>
                            <th class="p-3 text-center" width="5%">No</th>
                            <th class="p-3">Judul Film</th>
                            <th class="p-3">Studio</th>
                            <th class="p-3">Waktu Tayang</th>
                            <th class="p-3 text-center" width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($dataJadwal)): ?>
                            <tr>
                                <td colspan="5" class="text-center p-5 text-muted">
                                    <i class="fas fa-calendar-times fa-3x mb-3"></i><br>
                                    Belum ada jadwal tayang yang diatur.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($dataJadwal as $index => $row): ?>
                                <tr>
                                    <td class="text-center"><?= $index + 1 ?></td>
                                    <td class="fw-bold text-warning"><?= $row['judul'] ?></td>
                                    <td>
                                        <span class="badge bg-secondary"><?= $row['nama_studio'] ?></span>
                                    </td>
                                    <td>
                                        <i class="far fa-calendar text-danger"></i>
                                        <?= date('d M Y', strtotime($row['tgl_tayang'])) ?> <br>
                                        <small class="text-muted"><i class="far fa-clock"></i> <?= $row['jam_tayang'] ?>
                                            WIB</small>
                                    </td>
                                    <td class="text-center">
                                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm btn-action"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="index.php?action=delete&id=<?= $row['id'] ?>"
                                            class="btn btn-danger btn-sm btn-action"
                                            onclick="return confirm('Yakin ingin menghapus jadwal film <?= $row['judul'] ?>?')"
                                            title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>