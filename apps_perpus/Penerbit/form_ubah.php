<?php
include '../Config/layout.php';
include '../Config/Database.php';
include '../Object/penerbit.php';

// Debugging: Cek apakah ID ada di URL
if (!isset($_GET["ID"])) {
    die("Error: ID tidak ditemukan.");
}

$database = new Database();
$db = $database->getConnection();
$penerbit = new Penerbit($db);
$penerbit->ID = $_GET["ID"];

// Debugging: Tampilkan ID yang diterima
echo "ID yang diterima: " . $penerbit->ID . "<br>";

$penerbit->readOne();

// Debugging: Tampilkan data yang diambil
echo "Nama Penerbit: " . $penerbit->NamaPenerbit . "<br>";
echo "Alamat: " . $penerbit->Alamat . "<br>";
echo "Nomor Telepon: " . $penerbit->NoTelp . "<br>";
?>

<div class="p-4 sm:ml-64">
    <div class="p-4 mt-14">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Ubah Data Penerbit</h2>
        <form action="proses_ubah.php" method="POST">
            <input type="hidden" name="ID" value="<?= $penerbit->ID ?>">
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="w-full">
                    <label for="NamaPenerbit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Penerbit</label>
                    <input type="text" name="NamaPenerbit" id="NamaPenerbit" value="<?= $penerbit->NamaPenerbit ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Nama Penerbit" required="">
                </div>
                <div class="sm:col-span-2">
                    <label for="Alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                    <textarea id="Alamat" name="Alamat" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Alamat"><?= $penerbit->Alamat ?></textarea>
                </div>
                <div class="w-full">
                    <label for="NoTelp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Telepon</label>
                    <input type="text" name="NoTelp" id="NoTelp" value="<?= $penerbit->NoTelp ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Nomor Telepon" required="">
                </div>
            </div>
            <div class="flex items-center mt-4 sm:mt-6">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                <button type="button" onclick="history.back()" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Batal</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
