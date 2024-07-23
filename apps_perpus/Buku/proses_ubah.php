<?php
// Periksa apakah ada pengiriman data melalui POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include file koneksi database dan class Anggota
    include '../Config/Database.php';
    include '../Object/buku.php';

    // Buat koneksi database
    $database = new Database();
    $db = $database->getConnection();

    // Buat objek buku
    $buku = new Buku($db);

    // Ambil data dari form
    $buku->ID = $_POST['ID'];
    $buku->ISBN = $_POST['ISBN'];
    $buku->Judul = $_POST['Judul'];
    $buku->Pengarang = $_POST['Pengarang'];
    $buku->Kategori_ID = $_POST['Kategori'];
    $buku->Penerbit_ID = $_POST['Penerbit'];
    $buku->Deskripsi = $_POST['Deskripsi'];
    $buku->Stok = $_POST['Stok'];

    // Panggil method update untuk memperbarui data buku
    if ($buku->update()) {
        // Jika berhasil, redirect ke halaman daftar buku
        header("Location: http://localhost/apps_perpus/buku/index.php");
        exit(); // Pastikan script berhenti di sini setelah mengirimkan header
    } else {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan
        echo "Gagal memperbarui buku.";
    }
} else {
    // Jika tidak ada data POST, mungkin ada kesalahan dalam pengiriman data form
    echo "Tidak ada data yang dikirimkan.";
}
?>
