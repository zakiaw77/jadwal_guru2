<?php
include 'config.php'; // Pastikan koneksi sudah ada di file config.php

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $nbm = mysqli_real_escape_string($koneksi, $_POST['nbm']);

    if (!empty($nama) && !empty($nbm)) {
        $query = "INSERT INTO guru (nama, nbm) VALUES ('$nama', '$nbm')";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            echo "<script>alert('Data guru berhasil disimpan!'); window.location='input_guru.php';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data guru.');</script>";
        }
    } else {
        echo "<script>alert('Nama dan NBM tidak boleh kosong!');</script>";
    }
}
?>

<head>
    <title>Input Data Guru</title>
    <link rel="stylesheet" href="style.css">
</head>

<h3>Input Data Guru</h3>

<form method="POST" action="" class ="form.form.minimalis">
    <label>Nama Guru:</label><br>
    <input type="text" name="nama" required><br><br>

    <label>NBM (Nomor Baku Muhammadiyah):</label><br>
    <input type="text" name="nbm" required><br><br>

    <button type="submit">Simpan Guru</button>
</form>
