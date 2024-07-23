<?php
if ($_POST) {
    include '../Object/buku.php';
    include '../Config/Database.php';

    $database = new Database();
    $db = $database->getConnection();
    $buku = new Buku($db);

    $buku->ISBN = $_POST["ISBN"];
    $buku->Judul = $_POST["Judul"];
    $buku->Pengarang = $_POST["Pengarang"];
    $buku->Kategori_ID = $_POST["Kategori_ID"];
    $buku->Penerbit_ID = $_POST["Penerbit_ID"];
    $buku->Deskripsi = $_POST["Deskripsi"];
    $buku->Stok = $_POST["Stok"];   

    $buku->create();
}

header("Location: http://localhost/apps_perpus/Buku/index.php");
?>
