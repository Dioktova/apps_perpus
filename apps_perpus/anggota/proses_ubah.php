<?php
// Periksa apakah ada pengiriman data melalui POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include file koneksi database dan class Anggota
    include '../Config/Database.php';
    include '../Object/anggota.php';

    // Buat koneksi database
    $database = new Database();
    $db = $database->getConnection();

    // Buat objek anggota
    $anggota = new Anggota($db);

    // Ambil data dari form
    $anggota->NIK = $_POST['NIK'];
    $anggota->NamaLengkap = $_POST['NamaLengkap'];
    $anggota->Alamat = $_POST['Alamat'];
    $anggota->NoTelp = $_POST['NoTelp'];
    $anggota->TglRegistrasi = $_POST['TglRegistrasi'];
    $anggota->ID = $_POST['ID'];

    // Panggil method update untuk memperbarui data anggota
    if ($anggota->update()) {
        // Jika berhasil, redirect ke halaman daftar anggota
        header("Location: http://localhost/apps_perpus/anggota/index.php");
        exit(); // Pastikan script berhenti di sini setelah mengirimkan header
    } else {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan
        echo "Gagal memperbarui anggota.";
    }
} else {
    // Jika tidak ada data POST, mungkin ada kesalahan dalam pengiriman data form
    echo "Tidak ada data yang dikirimkan.";
}
?>
