<?php
class Film
{
    private $conn;
    private $table_name = "films";

    public $id;
    public $judul;
    public $genre;
    public $durasi;
    public $harga_dasar;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Untuk mengambil satu data saja
    public function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->judul = $row['judul'];
        $this->genre = $row['genre'];
        $this->durasi = $row['durasi'];
        $this->harga_dasar = $row['harga_dasar'];
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET judul=:judul, genre=:genre, durasi=:durasi, harga_dasar=:harga";
        $stmt = $this->conn->prepare($query);

        // Sanitasi
        $this->judul = htmlspecialchars(strip_tags($this->judul));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->durasi = htmlspecialchars(strip_tags($this->durasi));
        $this->harga_dasar = htmlspecialchars(strip_tags($this->harga_dasar));

        // Bind
        $stmt->bindParam(":judul", $this->judul);
        $stmt->bindParam(":genre", $this->genre);
        $stmt->bindParam(":durasi", $this->durasi);
        $stmt->bindParam(":harga", $this->harga_dasar);

        return $stmt->execute();
    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET judul=:judul, genre=:genre, durasi=:durasi, harga_dasar=:harga WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $this->judul = htmlspecialchars(strip_tags($this->judul));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->durasi = htmlspecialchars(strip_tags($this->durasi));
        $this->harga_dasar = htmlspecialchars(strip_tags($this->harga_dasar));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":judul", $this->judul);
        $stmt->bindParam(":genre", $this->genre);
        $stmt->bindParam(":durasi", $this->durasi);
        $stmt->bindParam(":harga", $this->harga_dasar);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }
}
?>