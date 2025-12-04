<?php
class Studio
{
    private $conn;
    private $table_name = "studios";

    public $id;
    public $nama_studio;
    public $kapasitas;

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

    public function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->nama_studio = $row['nama_studio'];
            $this->kapasitas = $row['kapasitas'];
        }
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET nama_studio=:nama, kapasitas=:kap";
        $stmt = $this->conn->prepare($query);

        $this->nama_studio = htmlspecialchars(strip_tags($this->nama_studio));
        $this->kapasitas = htmlspecialchars(strip_tags($this->kapasitas));

        $stmt->bindParam(":nama", $this->nama_studio);
        $stmt->bindParam(":kap", $this->kapasitas);
        return $stmt->execute();
    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET nama_studio=:nama, kapasitas=:kap WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $this->nama_studio = htmlspecialchars(strip_tags($this->nama_studio));
        $this->kapasitas = htmlspecialchars(strip_tags($this->kapasitas));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":nama", $this->nama_studio);
        $stmt->bindParam(":kap", $this->kapasitas);
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