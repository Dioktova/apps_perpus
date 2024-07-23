<?php
if ($_POST) {
    // Include file koneksi dan class Anggota
    include '../Config/Database.php';
    include '../Object/anggota.php';

    // Buat koneksi database
    $database = new Database();
    $db = $database->getConnection();

    // Buat objek anggota
    $anggota = new anggota($db);

    // Ambil data dari form
    $anggota->NIK = $_POST['NIK'];
    $anggota->NamaLengkap = $_POST['NamaLengkap'];
    $anggota->Alamat = $_POST['Alamat'];
    $anggota->NoTelp = $_POST['NoTelp'];
    $anggota->TglRegistrasi = $_POST['TglRegistrasi'];

    // Tambahkan data anggota ke database
    if ($anggota->create()) {
        // Jika berhasil menambahkan, redirect ke halaman daftar anggota
        header("Location: http://localhost/apps_perpus/anggota/index.php");
        exit(); // Pastikan script berhenti di sini setelah mengirimkan header
    } else {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan
        echo "Gagal menambahkan anggota.";
    }
} else {
    // Jika tidak ada data POST, mungkin ada kesalahan dalam mengirimkan data form
    echo "Tidak ada data yang dikirimkan.";
}
?>
