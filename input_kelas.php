<?php
include 'config.php';

// Proses input kelas
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kelas = mysqli_real_escape_string($koneksi, $_POST['nama_kelas']);

    if (!empty($nama_kelas)) {
        mysqli_query($koneksi, "INSERT INTO kelas (nama_kelas) VALUES ('$nama_kelas')");
        echo "<script>alert('Kelas berhasil ditambahkan!'); window.location='input_kelas.php';</script>";
    } else {
        echo "<script>alert('Nama Kelas tidak boleh kosong!');</script>";
    }
}
?>
<head>
    <title>Input Data Kelas</title>
    <link rel="stylesheet" href="style.css">
</head>

<h3>Input Data Kelas</h3>

<form method="POST" action="">
    <label>Nama Kelas:</label><br>
    <input type="text" name="nama_kelas" required><br><br>

    <button type="submit">Simpan Kelas</button>
    <a href="index.php">+ Home</a>
    <a href="list_kelas.php">+ List Kelas</a>
</form>
