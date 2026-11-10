<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $guru_id = intval($_POST['guru_id']);
    $jadwal = $_POST['jadwal'];

    foreach ($jadwal as $jam_ke => $harian) {
        foreach ($harian as $hari => $data) {
            $kelas_id = isset($data['kelas_id']) ? intval($data['kelas_id']) : 0;
            $mapel_id = isset($data['mapel_id']) ? intval($data['mapel_id']) : 0;

            // Jika dua-duanya kosong, skip saja
            if (empty($kelas_id) && empty($mapel_id)) continue;

            // Cek apakah sudah ada data untuk jam_ke dan hari ini
            $cek = mysqli_query($koneksi, "
                SELECT id FROM jadwal 
                WHERE guru_id = $guru_id 
                  AND jam_ke = '$jam_ke' 
                  AND hari = '$hari'
            ");

            if (mysqli_num_rows($cek) > 0) {
                // Jika ada, UPDATE
                $row = mysqli_fetch_assoc($cek);
                $id = $row['id'];
                mysqli_query($koneksi, "
                    UPDATE jadwal 
                    SET kelas_id = $kelas_id, mapel_id = $mapel_id 
                    WHERE id = $id
                ");
            } else {
                // Jika tidak ada, INSERT
                mysqli_query($koneksi, "
                    INSERT INTO jadwal (guru_id, kelas_id, mapel_id, jam_ke, hari)
                    VALUES ($guru_id, $kelas_id, $mapel_id, '$jam_ke', '$hari')
                ");
            }
        }
    }

    echo "<script>alert('Jadwal berhasil disimpan / diperbarui!'); window.location='input_jadwal_matrix.php?guru_id=$guru_id';</script>";
} else {
    echo "Akses tidak diizinkan.";
}
?>
