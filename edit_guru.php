<?php
include 'config.php';

$id = $_GET['id'];
$guru = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM guru WHERE id = $id"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $nbm = mysqli_real_escape_string($koneksi, $_POST['nbm']);

    mysqli_query($koneksi, "UPDATE guru SET nama='$nama', nbm='$nbm' WHERE id=$id");
    echo "<script>alert('Data guru berhasil diperbarui!'); window.location='list_guru.php';</script>";
}
?>

<h3>Edit Data Guru</h3>

<form method="POST" action="">
    <label>Nama Guru:</label><br>
    <input type="text" name="nama" value="<?= htmlspecialchars($guru['nama']) ?>" required><br><br>

    <label>NBM:</label><br>
    <input type="text" name="nbm" value="<?= htmlspecialchars($guru['nbm']) ?>" required><br><br>

    <button type="submit">Update Guru</button>
</form>
