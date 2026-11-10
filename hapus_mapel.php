<?php
include 'config.php';

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM mapel WHERE id = $id");

echo "<script>alert('Data mapel berhasil dihapus!'); window.location='list_mapel.php';</script>";
