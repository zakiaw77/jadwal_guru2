<?php
include 'config.php';

// Ambil parameter filter
$guru_id = isset($_GET['guru_id']) ? intval($_GET['guru_id']) : 0;
$mapel_id = isset($_GET['mapel_id']) ? intval($_GET['mapel_id']) : 0;
$kelas_id = isset($_GET['kelas_id']) ? intval($_GET['kelas_id']) : 0;
$hari = isset($_GET['hari']) ? $_GET['hari'] : '';

// Data dropdown
$data_guru = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY nama");
$data_mapel = mysqli_query($koneksi, "SELECT * FROM mapel ORDER BY nama_mapel");
$data_kelas = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY nama_kelas");
$hari_list = ['Senin','Selasa','Rabu','Kamis','Jumat'];

// Filter WHERE
$where = [];
if ($guru_id) $where[] = "j.guru_id = $guru_id";
if ($mapel_id) $where[] = "j.mapel_id = $mapel_id";
if ($kelas_id) $where[] = "j.kelas_id = $kelas_id";
if ($hari != '') $where[] = "j.hari = '$hari'";
$where_sql = $where ? 'WHERE ' . implode(' AND ', $where) : '';

// Query jadwal
$q = mysqli_query($koneksi,"
    SELECT j.id, j.hari, j.jam_ke, g.nama AS nama_guru,
           k.nama_kelas, m.nama_mapel
    FROM jadwal j
    JOIN guru g ON j.guru_id = g.id
    JOIN kelas k ON j.kelas_id = k.id
    JOIN mapel m ON j.mapel_id = m.id
    $where_sql
    ORDER BY j.hari, j.jam_ke
");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>List Jadwal-2</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Daftar Jadwal Guru</h2>

<!-- Filter -->
<form method="GET">
    Guru:
    <select name="guru_id">
        <option value="0">-- Semua Guru --</option>
        <?php while($g=mysqli_fetch_assoc($data_guru)): ?>
            <option value="<?= $g['id'] ?>" <?= ($g['id']==$guru_id)?'selected':'' ?>>
                <?= $g['nama'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    Mapel:
    <select name="mapel_id">
        <option value="0">-- Semua Mapel --</option>
        <?php mysqli_data_seek($data_mapel,0); while($m=mysqli_fetch_assoc($data_mapel)): ?>
            <option value="<?= $m['id'] ?>" <?= ($m['id']==$mapel_id)?'selected':'' ?>>
                <?= $m['nama_mapel'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    Kelas:
    <select name="kelas_id">
        <option value="0">-- Semua Kelas --</option>
        <?php mysqli_data_seek($data_kelas,0); while($k=mysqli_fetch_assoc($data_kelas)): ?>
            <option value="<?= $k['id'] ?>" <?= ($k['id']==$kelas_id)?'selected':'' ?>>
                <?= $k['nama_kelas'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    Hari:
    <select name="hari">
        <option value="">-- Semua Hari --</option>
        <?php foreach($hari_list as $h): ?>
            <option value="<?= $h ?>" <?= ($h==$hari)?'selected':'' ?>><?= $h ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">🔍 Tampilkan</button>
    <a href="list_jadwal.php">🔄 Reset</a>
</form>

<!-- Import -->
<!--<form action="preview_import2.php" method="POST" enctype="multipart/form-data">
    <label>Import CSV Jadwal:</label>
    <input type="file" name="file" accept=".csv" required>
    <button type="submit" name="preview">📄 Preview</button>
    <a href="uploads/template_jadwal_5kolom.csv" download>📥 Download Template CSV</a>
</form>

<br>
<a href="input_jadwal_matrix2.php">➕ Input Jadwal Matrix</a>
<br><br>-->

<!-- Import Jadwal dari CSV/Excel -->
<h3>📥 Import Jadwal</h3>
<form action="preview_import2.php" method="POST" enctype="multipart/form-data">
    <label>File (.csv / .xlsx / .xls):</label>
    <input type="file" name="file" accept=".csv,.xlsx,.xls" required>
    <button type="submit" name="preview">📄 Preview Import</button>
</form>
<br>

<!-- Tabel -->
<table border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>No</th><th>Hari</th><th>Jam</th>
    <th>Guru</th><th>Kelas</th><th>Mapel</th><th>Aksi</th>
</tr>
<?php $no=1; while($row=mysqli_fetch_assoc($q)): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $row['hari'] ?></td>
    <td><?= $row['jam_ke'] ?></td>
    <td><?= $row['nama_guru'] ?></td>
    <td><?= $row['nama_kelas'] ?></td>
    <td><?= $row['nama_mapel'] ?></td>
    <td>
        <a href="edit_jadwal.php?id=<?= $row['id'] ?>">✏️ Edit</a> |
        <a href="hapus_jadwal.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')">🗑️ Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>
