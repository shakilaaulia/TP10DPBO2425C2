<?php
class Jadwal
{
    private $conn;
    private $table_name = "jadwal";

    public $id;
    public $id_film;
    public $id_studio;
    public $tgl_tayang;
    public $jam_tayang;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        // Menggunakan JOIN untuk menampilkan nama film, studio, dan harga dasar
        $query = "SELECT j.id, j.tgl_tayang, j.jam_tayang, f.judul, f.harga_dasar, s.nama_studio 
                  FROM " . $this->table_name . " j
                  JOIN films f ON j.id_film = f.id
                  JOIN studios s ON j.id_studio = s.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id_film = $row['id_film'];
        $this->id_studio = $row['id_studio'];
        $this->tgl_tayang = $row['tgl_tayang'];
        $this->jam_tayang = $row['jam_tayang'];
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET id_film=:idf, id_studio=:ids, tgl_tayang=:tgl, jam_tayang=:jam";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idf", $this->id_film);
        $stmt->bindParam(":ids", $this->id_studio);
        $stmt->bindParam(":tgl", $this->tgl_tayang);
        $stmt->bindParam(":jam", $this->jam_tayang);
        return $stmt->execute();
    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET id_film=:idf, id_studio=:ids, tgl_tayang=:tgl, jam_tayang=:jam WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idf", $this->id_film);
        $stmt->bindParam(":ids", $this->id_studio);
        $stmt->bindParam(":tgl", $this->tgl_tayang);
        $stmt->bindParam(":jam", $this->jam_tayang);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }
}
?>