<?php
if($_POST) {
    include '../Config/Database.php';
    include '../Object/Petugas.php';

    $database = new Database();
    $db = $database->getConnection();

    $petugas = new Petugas($db);

    $petugas->username = $_POST['username'];
    $petugas->Email = $_POST['Email'];
    $petugas->Password = $_POST['Passwordbaru']; // Menggunakan $_POST['Passwordbaru'] karena nama inputnya adalah Passwordbaru
    $petugas->Role = $_POST['Role'];
    $petugas->ID = $_POST['ID']; // Menggunakan $_POST['id'] karena nama inputnya adalah id

    // Panggil metode update() untuk melakukan perubahan data
    $petugas->update();
    
    // Setelah melakukan perubahan, arahkan kembali ke halaman daftar petugas
    header("Location: http://localhost/apps_perpus/Petugas/index.php");
    exit(); // Pastikan script berhenti di sini setelah mengirimkan header
}
?>
