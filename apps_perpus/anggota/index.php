<?php
// Include file layout, koneksi database, dan class Anggota
include '../Config/layout.php';
include '../Config/Database.php';
include '../Object/anggota.php';

// Buat koneksi database
$database = new Database();
$db = $database->getConnection();

// Buat objek anggota
$anggota = new Anggota($db);

// Ambil data anggota
$result = $anggota->readAll();
$num = $result->rowCount();
?>

<div class="p-4 sm:ml-64">
    <div class="p-4 mt-14">
        <h2 class="text-4xl font-extrabold dark:text-white">Data Anggota</h2>
        <a href="form_tambah.php" class="block mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-1g text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 23" fill="currentColor" class="w-3.5 h-3.5 me-2">
                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
            </svg>
            Tambah
        </a>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            NIK
                        </th>
                        <th scope="col" class="px-6 py-3">
                            NamaLengkap
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Alamat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            NoTelp
                        </th>
                        <th scope="col" class="px-6 py-3">
                            TglRegistrasi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                    ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?= $NIK ?>
                            </th>
                            <td class="px-6 py-4">
                                <?= $NamaLengkap ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $Alamat ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $NoTelp ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $TglRegistrasi ?>
                            </td>
                            <td class="px-6 py-4">
                                <a href="form_ubah.php?ID=<?= $ID ?>" class="text-blue-600 hover:text-blue-900">Ubah</a>
                                <a href="proses_hapus.php?ID=<?= $ID ?>" class="text-red-600 hover:text-red-900">Hapus</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <?php
        if ($num > 0) {
            // Lakukan sesuatu jika kondisi benar
        }
        ?>

    </div>
</div>
</body>
</html>
