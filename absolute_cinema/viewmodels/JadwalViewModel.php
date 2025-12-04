<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Jadwal.php';

class JadwalViewModel
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $this->model = new Jadwal($database->getConnection());
    }

    public function fetchAll()
    {
        $stmt = $this->model->read();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchById($id)
    {
        $this->model->id = $id;
        $this->model->readOne();
        return $this->model;
    }

    public function addJadwal($data)
    {
        $this->model->id_film = $data['id_film'];
        $this->model->id_studio = $data['id_studio'];
        $this->model->tgl_tayang = $data['tgl_tayang'];
        $this->model->jam_tayang = $data['jam_tayang'];
        return $this->model->create();
    }

    public function updateJadwal($data)
    {
        $this->model->id = $data['id'];
        $this->model->id_film = $data['id_film'];
        $this->model->id_studio = $data['id_studio'];
        $this->model->tgl_tayang = $data['tgl_tayang'];
        $this->model->jam_tayang = $data['jam_tayang'];
        return $this->model->update();
    }

    public function deleteJadwal($id)
    {
        $this->model->id = $id;
        return $this->model->delete();
    }
}
?>