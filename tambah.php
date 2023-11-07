<!DOCTYPE html>
<html>

<head>
    <title>Tambah Barang</title>
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
        function showNotification(message) {
            alert(message);
        }
    </script>
</head>

<body>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <h1>Tambah Barang Baru</h1><br>

        <label for="nama_barang">Nama Barang:</label>
        <input type="text" name="nama_barang" id="nama_barang" required><br>

        <label for="kode_barang">Kode Barang:</label>
        <input type="text" name="kode_barang" id="kode_barang" required><br>

        <label for="harga_barang">Harga Barang:</label>
        <input type="text" name="harga_barang" id="harga_barang" required><br>

        <label for="stok_barang">Stok Barang:</label>
        <input type="text" name="stok_barang" id="stok_barang" required><br>

        <label for="gambar">Pilih Gambar (hanya .png, .jpg, .jpeg):</label>
        <input type="file" name="gambar" id="gambar" accept=".png, .jpg, .jpeg" required><br>

        <input type="submit" value="Tambah Barang">
    </form>

    <?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "tokokue";

    $koneksi = new mysqli($host, $username, $password, $database);

    if ($koneksi->connect_error) {
        die("Koneksi Gagal: " . $koneksi->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $nama_barang = $_POST['nama_barang'];
        $kode_barang = $_POST['kode_barang'];
        $harga_barang = $_POST['harga_barang'];
        $stok_barang = $_POST['stok_barang'];

        // Gather information about the uploaded file
        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $tmpName = $_FILES['gambar']['tmp_name'];
        $error = $_FILES['gambar']['error'];

        if ($error === 0) {
            // Generate a unique timestamp
            $timestamp = date('Y-m-d-H-i-s');

            // Retrieve file extension
            $fileExtension = pathinfo($namaFile, PATHINFO_EXTENSION);

            // Create a new file name with the timestamp
            $newFileName = 'image-' . $timestamp . '.' . $fileExtension;

            // Set the destination directory for the uploaded file
            $uploadDir = 'public/';
            $tujuan = $uploadDir . $newFileName;

            if (move_uploaded_file($tmpName, $tujuan)) {
                // Prepare SQL query to store data in the database
                $sql = "INSERT INTO barang (nama_barang, kode_barang, harga_barang, stok_barang, gambar) VALUES ('$nama_barang', '$kode_barang', '$harga_barang', '$stok_barang', '$tujuan')";

                // Execute the SQL query and check for success
                if ($koneksi->query($sql) === true) {
                    echo "<script>alert('Data berhasil ditambahkan'); window.location.href = 'index.php';</script>";
                } else {
                    echo "<script>showNotification('Error: " . $sql . '<br>' . $koneksi->error . "');</script>";
                }
            } else {
                echo "<script>showNotification('Gagal mengunggah gambar. Kode Kesalahan: " . $error . "');</script>";
            }
        }
    }

    $koneksi->close();
    ?>
</body>

</html>