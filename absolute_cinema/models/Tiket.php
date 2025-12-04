<?php
class Tiket
{
    private $conn;
    private $table_name = "tiket";

    public $id;
    public $id_jadwal;
    public $nama_penonton;
    public $jumlah_kursi;
    public $total_bayar;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT tiket.id, tiket.nama_penonton, tiket.jumlah_kursi, tiket.total_bayar,
                         films.judul, studios.nama_studio, jadwal.tgl_tayang, jadwal.jam_tayang
                  FROM " . $this->table_name . "
                  JOIN jadwal ON tiket.id_jadwal = jadwal.id
                  JOIN films ON jadwal.id_film = films.id
                  JOIN studios ON jadwal.id_studio = studios.id
                  ORDER BY tiket.id DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Ambil data untuk Edit
    public function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->id_jadwal = $row['id_jadwal'];
            $this->nama_penonton = $row['nama_penonton'];
            $this->jumlah_kursi = $row['jumlah_kursi'];
            $this->total_bayar = $row['total_bayar'];
        }
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET id_jadwal=:idj, nama_penonton=:nama, jumlah_kursi=:jml, total_bayar=:total";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":idj", $this->id_jadwal);
        $stmt->bindParam(":nama", $this->nama_penonton);
        $stmt->bindParam(":jml", $this->jumlah_kursi);
        $stmt->bindParam(":total", $this->total_bayar);

        return $stmt->execute();
    }
    public function update()
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET id_jadwal=:idj, nama_penonton=:nama, jumlah_kursi=:jml, total_bayar=:total 
                  WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":idj", $this->id_jadwal);
        $stmt->bindParam(":nama", $this->nama_penonton);
        $stmt->bindParam(":jml", $this->jumlah_kursi);
        $stmt->bindParam(":total", $this->total_bayar);
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