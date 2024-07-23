<?php
if ($_POST) {
    // Include file koneksi dan class Penerbit
    include '../Config/Database.php';
    include '../Object/penerbit.php'; // Pastikan file dan class bernama "penerbit.php"

    // Buat koneksi database
    $database = new Database();
    $db = $database->getConnection();

    // Buat objek penerbit
    $penerbit = new Penerbit($db);

    // Ambil data dari form
    $penerbit->NamaPenerbit = $_POST['NamaPenerbit'];
    $penerbit->Alamat = $_POST['Alamat'];
    $penerbit->NoTelp = $_POST['NoTelp'];

    // Tambahkan data penerbit ke database
    if ($penerbit->create()) {
        // Jika berhasil menambahkan, redirect ke halaman daftar penerbit
        header("Location: http://localhost/apps_perpus/Penerbit/index.php");
        exit(); // Pastikan script berhenti di sini setelah mengirimkan header
    } else {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan
        echo "Gagal menambahkan penerbit.";
    }
} else {
    // Jika tidak ada data POST, mungkin ada kesalahan dalam mengirimkan data form
    echo "Tidak ada data yang dikirimkan.";
}
?>
