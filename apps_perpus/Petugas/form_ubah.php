<?php
include '../Config/layout.php';
include '../Config/Database.php';
include '../Object/Petugas.php';

$database = new Database();
$db = $database->getConnection();

$petugas = new Petugas($db);

$petugas->ID = $_GET["ID"];

$petugas->readOne();
?>

<section class="bg-white dark:bg-gray-900">
    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Ubah Data Petugas </h2>
            <form class="space-y-4" action="proses_ubah.php" method="POST">
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="w-full">
                        <label for="username"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username
                            Petugas</label>
                        <input type="text" name="username" id="username" value="<?= $petugas->username ?>"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Masukkan Username Petugas" required="">
                    </div>
                    <div class="w-full">
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email" value="<?= $petugas->Email ?>"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Masukkan Email" required="">
                    </div>
                    <div class="w-full">
                        <label for="passwordbaru"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="passwordbaru" id="passwordbaru" value="<?= $petugas->Password ?>"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Masukkan Password Baru">
                    </div>
                    <div class="w-full">
                        <label for="role"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                        <select id="role" name="role"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <script>
                            if  ("<?= $petugas->Role ?>" == "admin") {
                                document.write("<option selected value=\"admin\">Admin</option>" + "<option value=\"staff\">Staff</option>");
                            }
                            if  ("<?= $petugas->Role ?>" == "staff") {
                                document.write("<option value=\"admin\">Admin</option>" + "<option selected value=\"staff\">Staff</option>");
                            }
                            </script>
                        </select>
                    </div>
                    <div>
                        <input type="text" name="id" id="id" style="display: none;" value="<?= $petugas->ID ?>">
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                    <button type="button" onclick="history.back()"
                        class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg- gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Batal</button>
                </div>
            </form>
        </div>
    </div>
</section>
</body>

</html>