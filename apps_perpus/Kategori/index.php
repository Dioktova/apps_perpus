<?php
include '../Config/layout.php';
include '../Config/Database.php';
include '../Object/Kategori.php';

$database = new Database();
$db = $database->getConnection();

$kategori = new Kategori($db);

// ambil data kategori
$result = $kategori->readAll();
$num = $result->rowCount();
?>

<div class="p-4 sm:ml-64">
    <div class="p-4 mt-14">
        <h2 class="text-4xl font-extrabold dark:text-white">Data Kategori</h2>
        <a onclick="addKategori()"
            class="block mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 23" fill="currentColor" class="w-3.5 h-3.5 me-2">
                <path fill-rule="evenodd"
                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"
                    clip-rule="evenodd" />
            </svg>
            Tambah
        </a>
        <?php
        if ($num > 0) {
        ?>
            <div class="relative overflow-x-auto mt-3 shadow-md">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nama Kategori
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);
                        ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?= htmlspecialchars($NamaKategori) ?>
                                </th>
                                <td class="px-6 py-4">
                                    <div class="inline-flex rounded-md shadow-sm" role="group">
                                        <a onclick="ubahKategori(<?= $ID ?>, '<?= htmlspecialchars($NamaKategori) ?>')">
                                            <button type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-s-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                                                Ubah
                                            </button>
                                        </a>
                                        <a onclick="confirmDelete(<?= $ID ?>)" href="#">
                                            <button type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-e-lg hover:bg-red-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-red-700 dark:focus:bg-gray-700">
                                                Hapus   
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            $no += 1;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php
        } 
        ?>
    </div>
</div>

<form id="form_tambah" action="proses_tambah.php" method="POST">
    <input type="hidden" id="NamaKategori" name="NamaKategori" required="">
</form>

<script>
    function confirmDelete(id) {
        var confirmation = confirm("Anda yakin ingin menghapus data?");
        if (confirmation) {
            window.location.href = "proses_hapus.php?ID=" + id;
        }
    }

    function addKategori() {
        var namaKategori = prompt("Nama Kategori:");
        if (namaKategori !== null) {
            document.getElementById('NamaKategori').value = namaKategori;
            document.getElementById('form_tambah').submit();
        } else {
            alert("Tambah kategori dibatalkan");
        }
    }

    function ubahKategori(id, namaKategori) {
        var newNamaKategori = prompt("Nama Kategori:", NamaKategori);
        if (newNamaKategori !== null) {
            window.location.href = "proses_ubah.php?ID=" + id + "&NamaKategori=" + encodeURIComponent(newNamaKategori);
        }
    }
</script>

</body>
</html>
