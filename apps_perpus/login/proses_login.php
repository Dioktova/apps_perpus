<?php
session_start();

if($_POST) {
    include '../Config/Database.php';
    include '../Object/Petugas.php';

    $database = new Database();
    $db = $database->getConnection();

    $petugas = new Petugas($db);

    $petugas->Email = $_POST["email"];
    $petugas->Password = $_POST["password"];

    if($petugas->authenticate()){
        header("Location: http://localhost/apps_perpus/Dashboard.php");
    } else {
        header("Location: http://localhost/apps_perpus/login/index.php");
    }
}

