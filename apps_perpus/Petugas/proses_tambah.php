<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../Config/Database.php';
    include '../Object/Petugas.php';

    $database = new Database();
    $db = $database->getConnection();

    $petugas = new Petugas($db);

    // Validasi input POST
    $errors = [];
    if (!isset($_POST['username']) || empty(trim($_POST['username']))) {
        $errors[] = 'Username is required.';
    } else {
        $petugas->username = trim($_POST['username']);
    }

    if (!isset($_POST['email']) || empty(trim($_POST['email']))) {
        $errors[] = 'Email is required.';
    } else {
        $petugas->Email = trim($_POST['email']);
    }

    if (!isset($_POST['password']) || empty(trim($_POST['password']))) {
        $errors[] = 'Password is required.';
    } else {
        $petugas->Password = trim($_POST['password']);
    }

    if (!isset($_POST['role']) || empty(trim($_POST['role']))) {
        $errors[] = 'Role is required.';
    } else {
        $petugas->Role = trim($_POST['role']);
    }

    if (empty($errors)) {
        try {
            if ($petugas->create()) {
                header("Location: http://localhost/apps_perpus/Petugas/index.php");
                exit();
            } else {
                echo "Unable to create Petugas.";
            }
        } catch (Exception $exception) {
            echo "Error: " . $exception->getMessage();
        }
    } else {
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
    }
}
?>
