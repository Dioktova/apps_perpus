<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../Config/Database.php';
    include '../Object/kategori.php';

    try {
        $database = new Database();
        $db = $database->getConnection();

        $kategori = new Kategori($db);

        if (!empty($_POST['NamaKategori'])) {
            // Validate and sanitize input
            $kategori->NamaKategori = htmlspecialchars(strip_tags($_POST['NamaKategori']));
            
            if ($kategori->create()) {
                header("Location: http://localhost/apps_perpus/Kategori/index.php");
                exit(); // Make sure to exit after redirecting
            } else {
                echo "Error: Could not create category.";
            }
        } else {
            echo "Error: Nama Kategori is required.";
        }
    } catch (Exception $exception) {
        echo "Exception: " . $exception->getMessage();
    }
} else {
    echo "Invalid request method.";
}
?>
