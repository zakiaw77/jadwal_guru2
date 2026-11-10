<?php
include 'config.php';

// Ambil id dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id == 0) {
    echo "<script>alert('ID tidak valid.'); window.location='list_kelas.php';</script>";
    exit;
}

// Ambil data kelas berdasarkan id
$kelas = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM kelas WHERE id = $id"));

if (!$kelas) {
    echo "<script>alert('Data kelas tidak ditemukan.'); window.location='list_kelas.php';</script>";
    exit;
}

// Proses update jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kelas = mysqli_real_escape_string($koneksi, $_POST['nama_kelas']);

    mysqli_query($koneksi, "UPDATE kelas SET nama_kelas='$nama_kelas' WHERE id=$id");
    echo "<script>alert('Data kelas berhasil diperbarui!'); window.location='list_kelas.php';</script>";
}
?>

<h3>Edit Data Kelas</h3>

<form method="POST" action="">
    <label>Nama Kelas:</label><br>
    <input type="text" name="nama_kelas" value="<?= htmlspecialchars($kelas['nama_kelas']) ?>" required><br><br>

    <button type="submit">Update Kelas</button>
</form>
