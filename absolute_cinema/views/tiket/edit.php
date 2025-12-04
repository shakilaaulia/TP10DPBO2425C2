<?php
require_once '../../viewmodels/TiketViewModel.php';
require_once '../../viewmodels/JadwalViewModel.php';

$tiketVM = new TiketViewModel();
$jadwalVM = new JadwalViewModel();

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$dataTiket = $tiketVM->fetchById($id); // Data lama
$listJadwal = $jadwalVM->fetchAll();   // Data dropdown

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tiketVM->updateTiket($_POST);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tiket - Cinema Tix</title>

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
                    <div class="card-header py-3"><i class="fas fa-edit me-2"></i> Edit Pesanan Tiket</div>
                    <div class="card-body p-4">
                        <form method="POST" action="">
                            <input type="hidden" name="id" value="<?= $dataTiket->id ?>">

                            <div class="mb-3">
                                <label class="form-label">Pilih Jadwal Film</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary border-secondary text-white"><i
                                            class="fas fa-calendar-alt"></i></span>
                                    <select id="jadwal_select" name="id_jadwal" class="form-select" required>
                                        <?php foreach ($listJadwal as $j): ?>
                                            <option value="<?= $j['id'] ?>" data-harga="<?= $j['harga_dasar'] ?>"
                                                <?= ($j['id'] == $dataTiket->id_jadwal) ? 'selected' : '' ?>>
                                                <?= $j['judul'] ?> | <?= $j['nama_studio'] ?> | <?= $j['jam_tayang'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Penonton</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary border-secondary text-white"><i
                                            class="fas fa-user"></i></span>
                                    <input type="text" name="nama_penonton" class="form-control"
                                        value="<?= $dataTiket->nama_penonton ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jumlah Kursi</label>
                                    <input type="number" id="jumlah_kursi" name="jumlah_kursi" class="form-control"
                                        value="<?= $dataTiket->jumlah_kursi ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Total Bayar (Rp)</label>
                                    <input type="number" id="total_bayar" name="total_bayar" class="form-control"
                                        value="<?= $dataTiket->total_bayar ?>" readonly>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-3">
                                <a href="index.php" class="btn btn-cancel px-4">Batal</a>
                                <button type="submit" class="btn btn-update px-4">Update Pesanan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const jadwalSelect = document.getElementById('jadwal_select');
        const jumlahKursiInput = document.getElementById('jumlah_kursi');
        const totalBayarInput = document.getElementById('total_bayar');

        function hitungTotal() {
            const selectedOption = jadwalSelect.options[jadwalSelect.selectedIndex];
            const harga = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
            const jumlahKursi = parseInt(jumlahKursiInput.value) || 0;

            const total = harga * jumlahKursi;
            totalBayarInput.value = total > 0 ? total : 0;
        }

        // Hitung total saat halaman pertama kali dimuat
        hitungTotal();

        jadwalSelect.addEventListener('change', hitungTotal);
        jumlahKursiInput.addEventListener('input', hitungTotal);
    </script>
</body>

</html>