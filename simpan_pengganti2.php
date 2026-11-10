<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hari = $_POST['hari'];
    $jam_ke = $_POST['jam_ke'];
    $guru_absen_id = $_POST['guru_absen_id'];
    $guru_pengganti_id = $_POST['guru_pengganti_id'];
    $kelas_id = $_POST['kelas_id'];
    $materi = mysqli_real_escape_string($koneksi, $_POST['materi']);
    $tanggal = date('Y-m-d');

    $query = "INSERT INTO pengganti (guru_absen_id, guru_pengganti_id, hari, jam_ke, tanggal, kelas_id, materi, created_at)
              VALUES ('$guru_absen_id', '$guru_pengganti_id', '$hari', '$jam_ke', '$tanggal', '$kelas_id', '$materi', NOW())";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data pengganti berhasil disimpan!'); window.location='cari_pengganti.php';</script>";
    } else {
        echo "Gagal menyimpan: " . mysqli_error($koneksi);
    }
} else {
    echo "Akses tidak sah.";
}
?>
