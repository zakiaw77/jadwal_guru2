<?php
include 'config.php';

$id = intval($_GET['id']);
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT * FROM jadwal WHERE id = $id
"));

$guru = mysqli_query($koneksi, "SELECT * FROM guru");
$kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
$mapel = mysqli_query($koneksi, "SELECT * FROM mapel");

$hari_list = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hari = $_POST['hari'];
    $jam_ke = $_POST['jam_ke'];
    $guru_id = $_POST['guru_id'];
    $kelas_id = $_POST['kelas_id'];
    $mapel_id = $_POST['mapel_id'];

    mysqli_query($koneksi, "UPDATE jadwal SET 
        guru_id='$guru_id', hari='$hari', jam_ke='$jam_ke', 
        kelas_id='$kelas_id', mapel_id='$mapel_id' 
        WHERE id=$id");

    echo "<script>alert('Jadwal berhasil diperbarui'); window.location='list_jadwal.php';</script>";
}
?>

<head>
    <title>Daftar Jadwal Guru</title>
    <link rel="stylesheet" href="style.css">
</head>

<h2>Edit Jadwal</h2>

<form method="POST">
    <label>Hari:</label><br>
    <select name="hari" required>
        <?php foreach ($hari_list as $h): ?>
            <option value="<?= $h ?>" <?= ($h == $data['hari']) ? 'selected' : '' ?>><?= $h ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Jam Ke:</label><br>
    <input type="text" name="jam_ke" value="<?= $data['jam_ke'] ?>" required><br><br>

    <label>Guru:</label><br>
    <select name="guru_id" required>
        <?php while ($g = mysqli_fetch_assoc($guru)) : ?>
            <option value="<?= $g['id'] ?>" <?= ($g['id'] == $data['guru_id']) ? 'selected' : '' ?>>
                <?= $g['nama'] ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Kelas:</label><br>
    <select name="kelas_id" required>
        <?php while ($k = mysqli_fetch_assoc($kelas)) : ?>
            <option value="<?= $k['id'] ?>" <?= ($k['id'] == $data['kelas_id']) ? 'selected' : '' ?>>
                <?= $k['nama_kelas'] ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Mapel:</label><br>
    <select name="mapel_id" required>
        <?php while ($m = mysqli_fetch_assoc($mapel)) : ?>
            <option value="<?= $m['id'] ?>" <?= ($m['id'] == $data['mapel_id']) ? 'selected' : '' ?>>
                <?= $m['nama_mapel'] ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <button type="submit">💾 Update Jadwal</button>
    <a href="list_jadwal.php">🔙 Kembali</a>
</form>
