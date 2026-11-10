<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $guru_id = $_POST['guru_id'];
    $jadwal = $_POST['jadwal'];

    // Bersihkan dulu jadwal lama guru tersebut
    mysqli_query($koneksi, "DELETE FROM jadwal WHERE guru_id = '$guru_id'");

    $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
    $jam = ['1-2', '3-4', '5-6', '7-8', '9-10','11-12'];

    foreach ($jadwal as $jam_index => $hari_data) {
        foreach ($hari_data as $hari_index => $data) {
            $kelas_id = isset($data['kelas_id']) ? $data['kelas_id'] : '';
            $mapel_id = isset($data['mapel_id']) ? $data['mapel_id'] : '';

            // Simpan hanya jika keduanya diisi
            if (!empty($kelas_id) && !empty($mapel_id)) {
                $hari_label = $hari[$hari_index];
                $jam_label = $jam[$jam_index];

                $query = "INSERT INTO jadwal (guru_id, hari, jam_ke, kelas_id, mapel_id) 
                          VALUES ('$guru_id', '$hari_label', '$jam_label', '$kelas_id', '$mapel_id')";
                mysqli_query($koneksi, $query);
            }
        }
    }

    echo "✅ Jadwal berhasil disimpan. <a href='input_jadwal_matrix.php'>Kembali ke Input</a>";
} else {
    echo "⛔ Akses ditolak.";
}

