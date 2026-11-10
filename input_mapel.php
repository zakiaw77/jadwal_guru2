<?php
include 'config.php';

// Proses input mapel
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_mapel = mysqli_real_escape_string($koneksi, $_POST['nama_mapel']);

    if (!empty($nama_mapel)) {
        mysqli_query($koneksi, "INSERT INTO mapel (nama_mapel) VALUES ('$nama_mapel')");
        echo "<script>alert('Mapel berhasil ditambahkan!'); window.location='input_mapel.php';</script>";
    } else {
        echo "<script>alert('Nama Mapel tidak boleh kosong!');</script>";
    }
}
?>
<head>
    <title>Input Data Mapel</title>
    <link rel="stylesheet" href="style.css">
</head>

<h3>Input Data Mapel</h3>

<form method="POST" action="">
    <label>Nama Mapel:</label><br>
    <input type="text" name="nama_mapel" required><br><br>

    <button type="submit">Simpan Mapel</button>
    <a href="list_mapel.php">Kembali Ke List Mapel</a>
</form>
