<?php
require_once '../../viewmodels/TiketViewModel.php';
$viewModel = new TiketViewModel();

// --- LOGIKA DELETE ---
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $viewModel->deleteTiket($_GET['id']);
    header("Location: index.php");
    exit;
}

$tikets = $viewModel->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan Tiket - Absolute Cinema</title>

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
            <h2 class="fw-bold"><i class="fas fa-ticket-alt text-danger"></i> Data Penjualan Tiket</h2>
            <a href="create.php" class="btn btn-add px-4 py-2 rounded-pill">
                <i class="fas fa-cart-plus"></i> Beli Tiket Baru
            </a>
        </div>

        <div class="card card-custom overflow-hidden">
            <div class="table-responsive">
                <table class="table table-dark-custom table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th>Nama Penonton</th>
                            <th>Info Film & Studio</th>
                            <th>Waktu Tayang</th>
                            <th class="text-center">Kursi</th>
                            <th>Total Bayar</th>
                            <th class="text-center" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($tikets)): ?>
                            <tr>
                                <td colspan="7" class="text-center p-5 text-muted">
                                    <i class="fas fa-receipt fa-3x mb-3"></i><br>
                                    Belum ada transaksi tiket hari ini.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($tikets as $index => $row): ?>
                                <tr>
                                    <td class="text-center"><?= $index + 1 ?></td>
                                    <td>
                                        <i class="fas fa-user-circle text-secondary"></i>
                                        <strong><?= $row['nama_penonton'] ?></strong>
                                    </td>
                                    <td>
                                        <span class="text-gold fw-bold"><?= $row['judul'] ?></span><br>
                                        <small class="text-muted"><i class="fas fa-couch"></i>
                                            <?= $row['nama_studio'] ?></small>
                                    </td>
                                    <td>
                                        <i class="far fa-calendar-alt"></i> <?= date('d M Y', strtotime($row['tgl_tayang'])) ?>
                                        <br>
                                        <small class="text-muted"><i class="far fa-clock"></i> <?= $row['jam_tayang'] ?></small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary fs-6"><?= $row['jumlah_kursi'] ?></span>
                                    </td>
                                    <td class="text-green">
                                        Rp <?= number_format($row['total_bayar'], 0, ',', '.') ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm me-1"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="index.php?action=delete&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Batalkan transaksi tiket atas nama <?= $row['nama_penonton'] ?>?')"
                                            title="Batalkan">
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