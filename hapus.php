<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "tokokue";

$koneksi = new mysqli($host, $username, $password, $database);

if ($koneksi->connect_error) {
    die("Koneksi Gagal: " . $koneksi->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_GET['confirmed']) && $_GET['confirmed'] === 'true') {
        $sql = "DELETE FROM barang WHERE id=$id";

        if ($koneksi->query($sql) === true) {
            echo "<script>alert('Data berhasil dihapus'); window.location.href = 'index.php';</script>";
            exit;
        } else {
            echo "<script>alert('Error: " . $sql . '<br>' . $koneksi->error . "'); window.location.href = 'index.php';</script>";
            exit;
        }
    } else {
        echo "
            <script>
                if (confirm('Apakah Anda yakin ingin menghapus data?')) {
                    window.location.href = 'hapus.php?confirmed=true&id=$id';
                } else {
                    window.location.href = 'index.php';
                }
            </script>";
    }
}

$koneksi->close();
?>