<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $guru_id = intval($_POST['guru_id']);

    if (!$guru_id) {
        die("Guru tidak valid");
    }

    // 1. Hapus semua jadwal lama untuk guru ini
    mysqli_query($koneksi, "DELETE FROM jadwal WHERE guru_id = $guru_id");

    // 2. Loop data baru
    if (!empty($_POST['jadwal'])) {
        foreach ($_POST['jadwal'] as $jam_ke => $hari_data) {
            foreach ($hari_data as $hari => $isi) {
                $kelas_id = isset($isi['kelas_id']) ? intval($isi['kelas_id']) : 0;
                $mapel_id = isset($isi['mapel_id']) ? intval($isi['mapel_id']) : 0;

                if ($kelas_id && $mapel_id) {
                    mysqli_query($koneksi, "
                        INSERT INTO jadwal (guru_id, kelas_id, mapel_id, hari, jam_ke) 
                        VALUES ($guru_id, $kelas_id, $mapel_id, '$hari', '$jam_ke')
                    ");
                }
            }
        }
    }

    echo "<script>
        alert('Jadwal guru berhasil disimpan!');
        window.location='input_jadwal_matrix.php?guru_id=$guru_id';
    </script>";
} else {
    header("Location: input_jadwal_matrix.php");
    exit;
}
