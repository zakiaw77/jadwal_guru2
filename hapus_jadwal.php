<?php
include 'config.php';

$id = intval($_GET['id']);

mysqli_query($koneksi, "DELETE FROM jadwal WHERE id = $id");

echo "<script>alert('Jadwal berhasil dihapus'); window.location='list_jadwal.php';</script>";
