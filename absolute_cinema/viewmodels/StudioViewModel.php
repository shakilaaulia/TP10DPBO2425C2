<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Studio.php';

class StudioViewModel
{
    private $studioModel;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->studioModel = new Studio($db);
    }

    public function fetchAll()
    {
        $stmt = $this->studioModel->read();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchById($id)
    {
        $this->studioModel->id = $id;
        $this->studioModel->readOne();
        return $this->studioModel;
    }

    public function addStudio($nama, $kapasitas)
    {
        $this->studioModel->nama_studio = $nama;
        $this->studioModel->kapasitas = $kapasitas;
        return $this->studioModel->create();
    }

    public function updateStudio($id, $nama, $kapasitas)
    {
        $this->studioModel->id = $id;
        $this->studioModel->nama_studio = $nama;
        $this->studioModel->kapasitas = $kapasitas;
        return $this->studioModel->update();
    }

    public function deleteStudio($id)
    {
        $this->studioModel->id = $id;
        return $this->studioModel->delete();
    }
}
?>