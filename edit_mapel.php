<?php
include 'config.php';

$id = $_GET['id'];
$mapel = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM mapel WHERE id = $id"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_mapel = mysqli_real_escape_string($koneksi, $_POST['nama_mapel']);

    mysqli_query($koneksi, "UPDATE mapel SET nama_mapel='$nama_mapel' WHERE id=$id");
    echo "<script>alert('Data mapel berhasil diperbarui!'); window.location='list_mapel.php';</script>";
}
?>

<h3>Edit Data Mapel</h3>

<form method="POST" action="">
    <label>Nama Mapel:</label><br>
    <input type="text" name="nama_mapel" value="<?= htmlspecialchars($mapel['nama_mapel']) ?>" required><br><br>

    <button type="submit">Update Mapel</button>
</form>
