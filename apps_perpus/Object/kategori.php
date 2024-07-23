<?php
class Kategori {
    // Properti
    private $conn;
    private $table_name = "kategori";

    public $ID;
    public $NamaKategori;

    // Konstruktor dengan $db sebagai database koneksi
    public function __construct($db){
        $this->conn = $db;
    }

    // Metode untuk membaca semua kategori
    function readAll(){
        // Query untuk membaca semua kategori
        $query = "SELECT ID, NamaKategori FROM " . $this->table_name;
        // Persiapan statement
        $stmt = $this->conn->prepare($query);
        // Eksekusi statement
        $stmt->execute();
        return $stmt;
    }

    // Metode untuk membuat kategori baru
    function create(){
        // Query untuk menyimpan kategori
        $query = "INSERT INTO " . $this->table_name . " SET NamaKategori=:NamaKategori";

        // Persiapan statement
        $stmt = $this->conn->prepare($query);

        // Sanitasi
        $this->NamaKategori = htmlspecialchars(strip_tags($this->NamaKategori));

        // Bind data
        $stmt->bindParam(":NamaKategori", $this->NamaKategori);

        // Eksekusi query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

        function update() {
        $query = "UPDATE " . $this->table_name . " SET
                                                    NamaKategori = :NamaKategori
                                                    WHERE ID = :ID";
        
        $result = $this->conn->prepare($query);

        $this->NamaKategori = htmlspecialchars(strip_tags($this->NamaKategori));
        $this->ID = htmlspecialchars(strip_tags($this->ID));
        // Bind parameters
        $result->bindParam(":NamaKategori", $this->NamaKategori);
        $result->bindParam(":ID", $this->ID);

        // Execute the query
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE ID = ?";

        $result = $this->conn->prepare($query);
        $result->bindParam(1, $this->ID);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
