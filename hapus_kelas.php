<?php
include 'config.php';

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM kelas WHERE id = $id");

echo "<script>alert('Data kelas berhasil dihapus!'); window.location='list_kelas.php';</script>";
