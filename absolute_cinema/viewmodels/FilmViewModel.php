<?php
require_once '../../config/database.php';
require_once '../../models/Film.php';

class FilmViewModel
{
    private $db;
    private $film;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->film = new Film($this->db);
    }

    // Ambil data untuk tabel
    public function fetchAll()
    {
        $stmt = $this->film->read();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil data untuk form edit
    public function fetchById($id)
    {
        $this->film->id = $id;
        $this->film->readOne();
        return $this->film; // Mengembalikan object film yang sudah terisi
    }

    // Logic Tambah Data
    public function addFilm($data)
    {
        $this->film->judul = $data['judul'];
        $this->film->genre = $data['genre'];
        $this->film->durasi = $data['durasi'];
        $this->film->harga_dasar = $data['harga'];

        if ($this->film->create()) {
            header("Location: index.php"); // Redirect setelah sukses
        } else {
            return "Gagal menambah data.";
        }
    }

    // Logic Update Data
    public function updateFilm($data)
    {
        $this->film->id = $data['id'];
        $this->film->judul = $data['judul'];
        $this->film->genre = $data['genre'];
        $this->film->durasi = $data['durasi'];
        $this->film->harga_dasar = $data['harga'];

        if ($this->film->update()) {
            header("Location: index.php");
        } else {
            return "Gagal update data.";
        }
    }

    // Logic Delete Data
    public function deleteFilm($id)
    {
        $this->film->id = $id;
        if ($this->film->delete()) {
            header("Location: index.php");
        } else {
            return "Gagal hapus data.";
        }
    }
}
?>