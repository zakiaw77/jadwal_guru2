<?php
include 'config.php';

$guru_id = $_POST['guru_id'];
$hari = $_POST['hari'];
$jam_ke = $_POST['jam_ke'];
$pengganti_id = $_POST['pengganti_id'];
$tanggal = date("Y-m-d");

mysqli_query($koneksi, "INSERT INTO absen (guru_id, tanggal, jam_ke, pengganti_id) 
VALUES ($guru_id, '$tanggal', '$jam_ke', $pengganti_id)");

echo "<p>Data absen tersimpan. Guru pengganti: ID $pengganti_id</p>";
echo "<a href='index.php'>Kembali</a>";
?>
