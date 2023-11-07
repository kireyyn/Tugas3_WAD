<!DOCTYPE html>
<html>

<head>
    <title>Toko Kue</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            2
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 100px;
            height: auto;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>

    <script>
        function showNotification(message) {
            alert(message);
        }
    </script>
</head>

<body>
    <h1>Toko Kue</h1>

    <!-- Tambahkan tombol untuk tambah barang -->
    <a href="tambah.php"><button>Tambah Barang</button></a>

    <br><br>

    <!-- Latian 1: Tabel barang terkoneksi dengan database -->
    <?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "tokokue";

    $koneksi = new mysqli($host, $username, $password, $database);

    if ($koneksi->connect_error) {
        die("Koneksi Gagal: " . $koneksi->connect_error);
    }

    // Tampilkan tabel data
    echo '<table>';
    echo '<tr>
            <th>ID</th>
            <th>Gambar</th>
            <th>Nama Barang</th>
            <th>Kode Barang</th>
            <th>Harga Barang</th>
            <th>Stok Barang</th>
            <th>Aksi</th>
          </tr>';

    $result = $koneksi->query('SELECT * FROM barang');
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo "<td><img src='" . $row['gambar'] . "'></td>";
            echo '<td>' . $row['nama_barang'] . '</td>';
            echo '<td>' . $row['kode_barang'] . '</td>';
            echo '<td>' . $row['harga_barang'] . '</td>';
            echo '<td>' . $row['stok_barang'] . '</td>';
            echo "<td><a href='ubah.php?id=" . $row['id'] . "'>Ubah</a> | <a href='hapus.php?id=" . $row['id'] . "'>Hapus</a></td>";
            echo '</tr>';
        }
    } else {
        echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
    }

    // Tutup koneksi setelah selesai menggunakan
    $koneksi->close();
    echo '</table>';
    ?>

</body>

</html>