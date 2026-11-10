<?php
include 'config.php';

// Ambil semua data mapel
$data_mapel = mysqli_query($koneksi, "SELECT * FROM mapel");
?>
<head>
    <title>Daftar Mapel</title>
    <link rel="stylesheet" href="style.css">
</head>

<h3>Daftar Mapel</h3>

<a href="index.php">+ Home</a>
<br>
<br>
<a href="input_mapel.php">+ Tambah Mapel Baru</a>
<br><br>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Mapel</th>
        <th>Aksi</th>
    </tr>

    <?php $no = 1; ?>
    <?php while ($mapel = mysqli_fetch_assoc($data_mapel)) : ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($mapel['nama_mapel']) ?></td>
        <td>
            <a href="edit_mapel.php?id=<?= $mapel['id'] ?>">Edit</a> |
            <a href="hapus_mapel.php?id=<?= $mapel['id'] ?>" onclick="return confirm('Yakin ingin menghapus mapel?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
