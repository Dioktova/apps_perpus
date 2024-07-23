<?php

class Anggota {

    // koneksi database dan nama tabel
    private $conn;
    private $table_name = "anggota";

    // property object anggota
    public $ID;
    public $NIK;
    public $NamaLengkap;
    public $Alamat;
    public $NoTelp;
    public $TglRegistrasi;

    // constructor dengan koneksi database sebagai parameter
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // method untuk menambahkan anggota baru
    function create() {
        // query untuk menambahkan record anggota
        $query = "INSERT INTO " . $this->table_name . "(NIK, NamaLengkap, Alamat, NoTelp, TglRegistrasi) " .
                 "VALUES (:NIK, :NamaLengkap, :Alamat, :NoTelp, :TglRegistrasi)";
        // prepare query
        $result = $this->conn->prepare($query);

        // membersihkan data input dari karakter khusus
        $this->NIK = htmlspecialchars(strip_tags($this->NIK));
        $this->NamaLengkap = htmlspecialchars(strip_tags($this->NamaLengkap));
        $this->Alamat = htmlspecialchars(strip_tags($this->Alamat));
        $this->NoTelp = htmlspecialchars(strip_tags($this->NoTelp));
        $this->TglRegistrasi = date("Y-m-d");

        // bind parameter dari query dengan nilai properti anggota
        $result->bindParam(":NIK", $this->NIK);
        $result->bindParam(":NamaLengkap", $this->NamaLengkap);
        $result->bindParam(":Alamat", $this->Alamat);
        $result->bindParam(":NoTelp", $this->NoTelp);
        $result->bindParam(":TglRegistrasi", $this->TglRegistrasi);
        
        try {
            if ($result->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); // Tampilkan pesan error
            return false; // Atau lakukan tindakan yang sesuai dengan kesalahan
        }
    }
    
    // method untuk membaca semua data anggota
    function readAll() {
        // query untuk membaca semua data anggota
        $query = "SELECT * FROM " . $this->table_name;
        // prepare query
        $result = $this->conn->prepare($query);
        // eksekusi query
        $result->execute();
        // kembalikan hasil query
        return $result;
    }
    
    // method untuk membaca data anggota berdasarkan ID
    function readOne() {
        // Pilih berdasarkan ID
        $query = "SELECT * FROM $this->table_name WHERE ID = ?";
        $result = $this->conn->prepare($query);
        $result->bindParam(1, $this->ID);
        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $this->NIK = $row["NIK"];
        $this->NamaLengkap = $row["NamaLengkap"];
        $this->Alamat = $row["Alamat"];
        $this->NoTelp = $row["NoTelp"];
        $this->TglRegistrasi = $row["TglRegistrasi"];
    }
    
    // method untuk mengupdate data anggota
    function update() {
        // query untuk mengupdate data anggota
        $query = "UPDATE " . $this->table_name . " SET NIK = :NIK, NamaLengkap = :NamaLengkap, Alamat = :Alamat, NoTelp = :NoTelp WHERE ID = :ID";
        // prepare query
        $result = $this->conn->prepare($query);

        // membersihkan data input dari karakter khusus
        $this->NIK = htmlspecialchars(strip_tags($this->NIK));
        $this->NamaLengkap = htmlspecialchars(strip_tags($this->NamaLengkap));
        $this->Alamat = htmlspecialchars(strip_tags($this->Alamat));
        $this->NoTelp = htmlspecialchars(strip_tags($this->NoTelp));
        $this->ID = htmlspecialchars(strip_tags($this->ID));

        // bind parameter dari query dengan nilai properti anggota
        $result->bindParam(":NIK", $this->NIK);
        $result->bindParam(":NamaLengkap", $this->NamaLengkap);
        $result->bindParam(":Alamat", $this->Alamat);
        $result->bindParam(":NoTelp", $this->NoTelp);
        $result->bindParam(":ID", $this->ID);

        // execute query
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // method untuk menghapus data anggota
    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE ID = ?";
        $result = $this->conn->prepare($query);
        $result->bindParam(1, $this->ID);
        $result->execute();
    }
}
?>
