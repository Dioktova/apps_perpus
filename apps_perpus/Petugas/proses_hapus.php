<?php
if($_GET["ID"]) {
    include '../Config/Database.php';
    include '../Object/Petugas.php';

    $database = new Database();
    $db = $database->getConnection();

    $petugas = new Petugas($db);
    $petugas->ID = $_GET['ID'];

    if($petugas->delete() == true){
        header("Location: http://localhost/apps_perpus/Petugas/index.php");
    }else {
        echo $exception->getMessage();
    }
}
?>