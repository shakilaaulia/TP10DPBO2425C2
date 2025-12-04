<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Tiket.php';

class TiketViewModel
{
    private $tiketModel;

    public function __construct()
    {
        $database = new Database();
        $this->tiketModel = new Tiket($database->getConnection());
    }

    public function fetchAll()
    {
        $stmt = $this->tiketModel->read();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchById($id)
    {
        $this->tiketModel->id = $id;
        $this->tiketModel->readOne();
        return $this->tiketModel;
    }

    public function addTiket($data)
    {
        $this->tiketModel->id_jadwal = $data['id_jadwal'];
        $this->tiketModel->nama_penonton = $data['nama_penonton'];
        $this->tiketModel->jumlah_kursi = $data['jumlah_kursi'];
        $this->tiketModel->total_bayar = $data['total_bayar'];
        return $this->tiketModel->create();
    }

    public function updateTiket($data)
    {
        $this->tiketModel->id = $data['id'];
        $this->tiketModel->id_jadwal = $data['id_jadwal'];
        $this->tiketModel->nama_penonton = $data['nama_penonton'];
        $this->tiketModel->jumlah_kursi = $data['jumlah_kursi'];
        $this->tiketModel->total_bayar = $data['total_bayar'];
        return $this->tiketModel->update();
    }

    public function deleteTiket($id)
    {
        $this->tiketModel->id = $id;
        return $this->tiketModel->delete();
    }
}
?>