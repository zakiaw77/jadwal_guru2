<?php
include 'config.php';

// Ambil semua data guru
$data_guru = mysqli_query($koneksi, "SELECT * FROM guru");
?>

<head>
    <title>Daftar Guru</title>
    <link rel="stylesheet" href="style.css">
    <style>
        a:link, a:visited {
            background-color:rgb(72, 127, 245);
            color: white;
            padding: 14px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
         }

        a:hover, a:active {
            background-color:green;
        }
</style>
</head>

<h3>Daftar Guru</h3>

<a href="index.php">Home</a>
<br>
<br>
<a href="input_guru.php">Tambah Guru Baru</a>
<br>
<br>
<a href="upload_guru.php">Upload Data Guru</a>
<br>
<br>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Guru</th>
        <th>NBM</th>
        <th>Aksi</th>
    </tr>

    <?php $no = 1; ?>
    <?php while ($guru = mysqli_fetch_assoc($data_guru)) : ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($guru['nama']) ?></td>
        <td><?= htmlspecialchars($guru['nbm']) ?></td>
        <td>
            <a href="edit_guru.php?id=<?= $guru['id'] ?>">Edit</a> |
            <a href="hapus_guru.php?id=<?= $guru['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
