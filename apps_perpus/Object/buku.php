<?php
class Buku {
    // Koneksi database dan nama tabel
    private $conn;
    private $table_name = "buku";

    // Property object Buku
    public $ID;
    public $ISBN;
    public $Judul;
    public $Pengarang;
    public $Kategori_ID;
    public $Penerbit_ID;
    public $Deskripsi;
    public $Stok;

    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    // Method untuk membuat entri baru dalam tabel buku
    public function create() {
        // Query untuk menambahkan data
        $query = "INSERT INTO " . $this->table_name . " (ISBN, Judul, Pengarang, Kategori_ID, Penerbit_ID, Deskripsi, Stok) VALUES (:ISBN, :Judul, :Pengarang, :Kategori_ID, :Penerbit_ID, :Deskripsi, :Stok)";
        
        // Persiapan query
        $result = $this->conn->prepare($query);

        // Membersihkan dan menyiapkan data
        $this->ISBN = htmlspecialchars(strip_tags($this->ISBN));
        $this->Judul = htmlspecialchars(strip_tags($this->Judul));
        $this->Pengarang = htmlspecialchars(strip_tags($this->Pengarang));
        $this->Kategori_ID = intval($this->Kategori_ID);
        $this->Penerbit_ID = htmlspecialchars(strip_tags($this->Penerbit_ID)); // Sesuaikan dengan field penerbit
        $this->Deskripsi = htmlspecialchars(strip_tags($this->Deskripsi));
        $this->Stok = intval($this->Stok);

        // Binding parameter
        $result->bindParam(":ISBN", $this->ISBN);
        $result->bindParam(":Judul", $this->Judul);
        $result->bindParam(":Pengarang", $this->Pengarang);
        $result->bindParam(":Kategori_ID", $this->Kategori_ID);
        $result->bindParam(":Penerbit_ID", $this->Penerbit_ID);
        $result->bindParam(":Deskripsi", $this->Deskripsi);
        $result->bindParam(":Stok", $this->Stok);

        // Eksekusi query
        if ($result->execute()) {
            return true; // Berhasil menyimpan data
        } else {
            // Jika terjadi kesalahan, tampilkan pesan error
            printf("Error: %s.\n", $result->error);
            return false; // Gagal menyimpan data
        }
    }

    // Method untuk membaca semua data buku
    public function readAll() {
        $query = "SELECT Buku.ID, Buku.ISBN, Buku.Judul, Buku.Pengarang, Buku.Kategori_ID, Buku.Penerbit_ID, Buku.Deskripsi, Buku.Stok, Kategori.NamaKategori, Penerbit.NamaPenerbit FROM Buku JOIN Kategori ON Buku.Kategori_ID = Kategori.ID JOIN Penerbit ON Buku.Penerbit_ID = Penerbit.ID";
        $result = $this->conn->prepare($query);
        $result->execute();
        return $result;
    }

    // Method untuk membaca satu data buku berdasarkan ID
    public function readOne() {
        // Query untuk membaca satu data buku
        $query = "SELECT Buku.ID, Buku.ISBN, Buku.Judul, Buku.Pengarang, Buku.Kategori_ID, Buku.Penerbit_ID, Buku.Deskripsi, Buku.Stok, Kategori.NamaKategori, Penerbit.NamaPenerbit FROM Buku JOIN Kategori ON Buku.Kategori_ID = Kategori.ID JOIN Penerbit ON Buku.Penerbit_ID = Penerbit.ID WHERE Buku.ID = :ID";
        
        // Persiapan query
        $stmt = $this->conn->prepare($query);

        // Binding parameter
        $stmt->bindParam(":ID", $this->ID);

        // Eksekusi query
        $stmt->execute();

        // Ambil hasil query
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Mengisi properti objek dengan data yang ditemukan
        $this->ISBN = $row['ISBN'];
        $this->Judul = $row['Judul'];
        $this->Pengarang = $row['Pengarang'];
        $this->Kategori_ID = $row['Kategori_ID'];
        $this->Penerbit_ID = $row['Penerbit_ID'];
        $this->Deskripsi = $row['Deskripsi'];
        $this->Stok = $row['Stok'];
    }

    // Method untuk memperbarui data buku
    public function update() {
        // Query untuk memperbarui data buku
        $query = "UPDATE " . $this->table_name . " SET ISBN=:ISBN, Judul=:Judul, Pengarang=:Pengarang, Kategori_ID=:Kategori_ID, Penerbit_ID=:Penerbit_ID, Deskripsi=:Deskripsi, Stok=:Stok WHERE ID=:ID";
        
        // Persiapan query
        $result = $this->conn->prepare($query);

        // Membersihkan dan menyiapkan data
        $this->ISBN = htmlspecialchars(strip_tags($this->ISBN));
        $this->Judul = htmlspecialchars(strip_tags($this->Judul));
        $this->Pengarang = htmlspecialchars(strip_tags($this->Pengarang));
        $this->Kategori_ID = intval($this->Kategori_ID);
        $this->Penerbit_ID = htmlspecialchars(strip_tags($this->Penerbit_ID)); // Sesuaikan dengan field penerbit
        $this->Deskripsi = htmlspecialchars(strip_tags($this->Deskripsi));
        $this->Stok = intval($this->Stok);
        $this->ID = htmlspecialchars(strip_tags($this->ID));

        // Binding parameter
        $result->bindParam(":ISBN", $this->ISBN);
        $result->bindParam(":Judul", $this->Judul);
        $result->bindParam(":Pengarang", $this->Pengarang);
        $result->bindParam(":Kategori_ID", $this->Kategori_ID);
        $result->bindParam(":Penerbit_ID", $this->Penerbit_ID);
        $result->bindParam(":Deskripsi", $this->Deskripsi);
        $result->bindParam(":Stok", $this->Stok);
        $result->bindParam(":ID", $this->ID);

        // Eksekusi query
        if ($result->execute()) {
            return true; // Berhasil memperbarui data
        } else {
            // Jika terjadi kesalahan, tampilkan pesan error
            printf("Error: %s.\n", $result->error);
            return false; // Gagal memperbarui data
        }
    }

    // Method untuk menghapus data buku
    public function delete() {
        // Query untuk menghapus data buku
        $query = "DELETE FROM " . $this->table_name . " WHERE ID = :ID";
        
        // Persiapan query
        $result = $this->conn->prepare($query);

        // Binding parameter
        $result->bindParam(":ID", $this->ID);

        // Eksekusi query
        if ($result->execute()) {
            return true; // Berhasil menghapus data
        } else {
            // Jika terjadi kesalahan, tampilkan pesan error
            printf("Error: %s.\n", $result->error);
            return false; // Gagal menghapus data
        }
    }
}
?>
