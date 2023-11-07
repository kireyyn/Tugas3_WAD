<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "tokokue";

$koneksi = new mysqli($host, $username, $password, $database);

if ($koneksi->connect_error) {
    die("Koneksi Gagal: " . $koneksi->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama_barang = $_POST['nama_barang'];
    $kode_barang = $_POST['kode_barang'];
    $harga_barang = $_POST['harga_barang'];
    $stok_barang = $_POST['stok_barang'];

    // Existing image logic
    $sqlSelectImage = "SELECT gambar FROM barang WHERE id=$id";
    $resultImage = $koneksi->query($sqlSelectImage);
    $rowImage = $resultImage->fetch_assoc();
    $gambar = $rowImage['gambar'];

    if ($_FILES['gambar']['error'] === 0) {
        $timestamp = date('Y-m-d-H-i-s');
        $fileExtension = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $newFileName = 'image-' . $timestamp . '.' . $fileExtension;
        $uploadDir = 'public/';
        $tujuan = $uploadDir . $newFileName;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $tujuan)) {
            // Update the image field in the database
            $sqlUpdateImage = "UPDATE barang SET gambar='$tujuan' WHERE id=$id";
            if ($koneksi->query($sqlUpdateImage) !== true) {
                echo "<script>alert('Error updating image: " . $koneksi->error . "');</script>";
            }
        } else {
            echo "<script>alert('Failed to upload new image');</script>";
        }
    }

    // Update other fields
    $sql = "UPDATE barang SET nama_barang='$nama_barang', kode_barang='$kode_barang', harga_barang='$harga_barang', stok_barang='$stok_barang' WHERE id=$id";

    if ($koneksi->query($sql) === true) {
        echo "<script>alert('Data berhasil diubah'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $sql . '<br>' . $koneksi->error . "');</script>";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $koneksi->query("SELECT * FROM barang WHERE id=$id");
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Ubah Data Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background: #f9f9f9;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>

    <script>
        function confirmUpdate() {
            return confirm("Apakah Anda yakin ingin menyimpan perubahan?");
        }
    </script>
</head>

<body>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return confirmUpdate()"
        enctype="multipart/form-data">
        <h2>Ubah Data Barang</h2><br>
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        Nama Barang: <input type="text" name="nama_barang" value="<?php echo $row['nama_barang']; ?>"><br>
        Kode Barang: <input type="text" name="kode_barang" value="<?php echo $row['kode_barang']; ?>"><br>
        Harga Barang: <input type="text" name="harga_barang" value="<?php echo $row['harga_barang']; ?>"><br>
        Stok Barang: <input type="text" name="stok_barang" value="<?php echo $row['stok_barang']; ?>"><br>
        <label for="gambar">Ubah Gambar (hanya .png, .jpg, .jpeg):</label>
        <input type="file" name="gambar" accept=".png, .jpg, .jpeg"><br>
        <input type="submit" value="Simpan Perubahan">
    </form>

    <?php
    $koneksi->close();
    ?>
</body>

</html>