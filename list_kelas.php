<?php
include 'config.php';

// Ambil semua data kelas
$data_kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
?>

<head>
    <title>Daftar Kelas</title>
    <link rel="stylesheet" href="style.css">
</head>

<h3>Daftar Kelas</h3>

<a href="index.php">+ Home</a>
<br>
<br>
<a href="input_kelas.php">+ Tambah Kelas Baru</a>
<br><br>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Kelas</th>
        <th>Aksi</th>
    </tr>

    <?php $no = 1; ?>
    <?php while ($kelas = mysqli_fetch_assoc($data_kelas)) : ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($kelas['nama_kelas']) ?></td>
        <td>
            <a href="edit_kelas.php?id=<?= $kelas['id'] ?>">Edit</a> |
            <a href="hapus_kelas.php?id=<?= $kelas['id'] ?>" onclick="return confirm('Yakin ingin menghapus kelas?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
