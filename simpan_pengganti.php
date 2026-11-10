<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hari = $_POST['hari'];
    $jam_ke = $_POST['jam_ke'];
    $guru_absen = $_POST['guru_absen'];
    $guru_pengganti = $_POST['guru_pengganti'];
    $kelas_id = $_POST['kelas_id'];
    $materi = mysqli_real_escape_string($koneksi, $_POST['materi']);
    $tanggal = date('Y-m-d');

    // Simpan ke database
    $simpan = mysqli_query($koneksi, "
        INSERT INTO pengganti 
        (guru_absen_id, guru_pengganti_id, hari, jam_ke, tanggal, kelas_id, materi)
        VALUES 
        ('$guru_absen', '$guru_pengganti', '$hari', '$jam_ke', '$tanggal', '$kelas_id', '$materi')
    ");

    if ($simpan) {
        $last_id = mysqli_insert_id($koneksi);
        echo "<script>
            alert('Guru pengganti berhasil disimpan!');
            window.location='cetak_surat_pengganti.php?id_pengganti=$last_id';
        </script>";
    } else {
        echo "<script>alert('Gagal menyimpan data: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>

