<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Guru Pengganti</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 30px;
        }
        th, td {
            border: 1px solid #999;
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #4285f4;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        a.cetak-link {
            background: #2196F3;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
        }
        a.cetak-link:hover {
            background: #0b7dda;
        }
    </style>
</head>
<body>

<h2>Daftar Guru Pengganti</h2>
<a href="index.php">+ Home</a>
<table>
    <tr>
        <th>Tanggal</th>
        <th>Hari</th>
        <th>Jam</th>
        <th>Guru Absen</th>
        <th>Guru Pengganti</th>
        <th>Kelas</th>
        <th>Materi</th>
        <th>Aksi</th>
    </tr>

    <?php
    $query = mysqli_query($koneksi, "
        SELECT p.*, 
               g1.nama AS guru_absen, g2.nama AS guru_pengganti, 
               k.nama_kelas 
        FROM pengganti p
        JOIN guru g1 ON p.guru_absen_id = g1.id
        JOIN guru g2 ON p.guru_pengganti_id = g2.id
        JOIN kelas k ON p.kelas_id = k.id
        ORDER BY p.tanggal DESC
    ");

    while ($row = mysqli_fetch_assoc($query)) {
        echo "<tr>
                <td>{$row['tanggal']}</td>
                <td>{$row['hari']}</td>
                <td>{$row['jam_ke']}</td>
                <td>{$row['guru_absen']}</td>
                <td>{$row['guru_pengganti']}</td>
                <td>{$row['nama_kelas']}</td>
                <td>{$row['materi']}</td>
                <td><a class='cetak-link' href='cetak_surat_pengganti.php?id_pengganti={$row['id']}' target='_blank'>Cetak</a></td>
              </tr>";
    }
    ?>
</table>

</body>
</html>
