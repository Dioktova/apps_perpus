<?php
if($_GET["ID"]) {
    include '../Config/Database.php';
    include '../Object/penerbit.php';

    $database = new Database();
    $db = $database->getConnection();

    $penerbit = new Penerbit($db);
    $penerbit->ID = $_GET['ID'];

    if($penerbit->delete() == true){
        header("Location: http://localhost/apps_perpus/Penerbit/index.php");
    }else {
        echo $exception->getMessage();
    }
}
?>