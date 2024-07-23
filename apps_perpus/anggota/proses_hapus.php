<?php
// Periksa apakah parameter ID ada dalam URL
if(isset($_GET["ID"])) {
    // Include file koneksi database dan class Anggota
    include '../config/Database.php';
    include '../object/Anggota.php';

    // Buat koneksi database
    $database = new Database();
    $db = $database->getConnection();

    // Buat objek anggota
    $anggota = new Anggota($db);

    // Set nilai ID dari parameter URL
    $anggota->ID = $_GET["ID"];

    // Panggil method delete untuk menghapus data anggota
    $anggota->delete();
}

// Redirect ke halaman daftar anggota setelah penghapusan
header("Location: http://localhost/apps_perpus/anggota/index.php");
?>
