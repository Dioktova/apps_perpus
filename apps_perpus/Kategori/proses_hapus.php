<?php
if($_GET["ID"]) {
    include '../Config/Database.php';
    include '../Object/kategori.php';

    $database = new Database();
    $db = $database->getConnection();

    $kategori = new Kategori($db);
    $kategori->ID = $_GET['ID'];

    if($kategori->delete() == true){
        header("Location: http://localhost/apps_perpus/Kategori/index.php");
    }else {
        echo $exception->getMessage();
    }
}
?>