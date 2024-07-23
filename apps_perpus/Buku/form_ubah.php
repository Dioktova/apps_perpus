<?php
include '../Config/layout.php';
include '../Config/Database.php';
include '../Object/buku.php';
include '../Object/kategori.php';
include '../Object/penerbit.php';

$database = new Database();
$db = $database->getConnection();

// Membuat objek Buku dan menginisialisasinya dengan koneksi database
$buku = new Buku($db);

// Memeriksa apakah parameter ID ada dalam URL
if(isset($_GET["ID"])) {
    // Jika ID tersedia, set nilai ID buku
    $buku->ID = $_GET["ID"];
    
    // Membaca detail buku
    $buku->readOne();
} else {
    // Jika ID tidak tersedia, tampilkan pesan kesalahan dan hentikan eksekusi skrip
    die('ID Buku tidak ditemukan.');
}

?>

<div class="p-4 sm:ml-64">
    <div class="p-4 mt-14">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Ubah Data Buku</h2>
        <form action="proses_ubah.php" method="POST">
            <input type="hidden" name="ID" value="<?= $buku->ID ?>">
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="w-full">
                    <label for="ISBN" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ISBN</label>
                    <input type="text" name="ISBN" id="ISBN" value="<?= $buku->ISBN ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan ISBN" required>
                </div>
                <div class="w-full">
                    <label for="Judul" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                    <input type="text" name="Judul" id="Judul" value="<?= $buku->Judul ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Judul" required>
                </div>
                <div class="w-full">
                    <label for="Pengarang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pengarang</label>
                    <input type="text" name="Pengarang" id="Pengarang" value="<?= $buku->Pengarang ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Pengarang">
                </div>
                <div class="w-full">
                    <label for="Kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                    <select id="Kategori" name="Kategori" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                        <?php
                        $kategori = new Kategori($db);
                        $dataKategori = $kategori->readAll();
                        while ($row = $dataKategori->fetch(PDO::FETCH_ASSOC)) {
                            $selected = ($row['ID'] == $buku->Kategori_ID) ? 'selected' : '';
                            echo "<option value='{$row['ID']}' $selected>{$row['NamaKategori']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="w-full">
                    <label for="Penerbit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penerbit</label>
                    <select id="Penerbit" name="Penerbit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                        <?php
                        $penerbit = new Penerbit($db);
                        $dataPenerbit = $penerbit->readAll();
                        while ($row = $dataPenerbit->fetch(PDO::FETCH_ASSOC)) {
                            $selected = ($row['ID'] == $buku->Penerbit_ID) ? 'selected' : '';
                            echo "<option value='{$row['ID']}' $selected>{$row['NamaPenerbit']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label for="Deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                    <textarea id="Deskripsi" name="Deskripsi" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Deskripsi"><?= $buku->Deskripsi ?></textarea>
                </div>
                <div class="sm:col-span-2">
                    <label for="Stok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
                    <input type="number" name="Stok" id="Stok" value="<?= $buku->Stok ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Stok" required>
                </div>
            </div>
            <div class="flex items-center mt-4 sm:mt-6">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                <button type="button" onclick="history.back()" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Batal</button>
            </div>
        </form>
    </div>
</div>
