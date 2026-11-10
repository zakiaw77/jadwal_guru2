<?php
include 'config.php';

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM guru WHERE id = $id");

echo "<script>alert('Data guru berhasil dihapus!'); window.location='list_guru.php';</script>";
