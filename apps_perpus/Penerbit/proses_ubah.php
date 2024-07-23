<?php
if ($_POST) {
    include '../Config/Database.php';
    include '../Object/penerbit.php';

    $database = new Database();
    $db = $database->getConnection();

    $penerbit = new Penerbit($db);

    $penerbit->ID = $_POST['ID'];
    $penerbit->NamaPenerbit = $_POST['NamaPenerbit'];
    $penerbit->Alamat = $_POST['Alamat'];
    $penerbit->NoTelp = $_POST['NoTelp'];

    if ($penerbit->update()) {
        header("Location: http://localhost/apps_perpus/Penerbit/index.php");
        exit(); // Pastikan script berhenti di sini setelah mengirimkan header
    } else {
        echo "Gagal mengubah data penerbit.";
    }
} else {
    echo "Tidak ada data yang dikirimkan.";
}
?>
