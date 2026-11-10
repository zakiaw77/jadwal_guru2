<?php
include 'config.php';

if (isset($_POST['import'])) {

    $file = $_FILES['file']['tmp_name'];
    $ext  = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

    if ($ext == 'csv') {
        $handle = fopen($file, 'r');
        fgetcsv($handle); // skip header

        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            // CSV berisi: Hari,Jam_Ke,Guru,Kelas,Mapel
            $hari   = mysqli_real_escape_string($koneksi, $data[0]);
            $jam_ke = mysqli_real_escape_string($koneksi, $data[1]);
            $guru   = mysqli_real_escape_string($koneksi, $data[2]);
            $kelas  = mysqli_real_escape_string($koneksi, $data[3]);
            $mapel  = mysqli_real_escape_string($koneksi, $data[4]);

            // ambil id master
            $guru_id = 0;
            $kelas_id = 0;
            $mapel_id = 0;

            $g = mysqli_query($koneksi, "SELECT id FROM guru WHERE nama='$guru' LIMIT 1");
            if ($r = mysqli_fetch_assoc($g)) $guru_id = $r['id'];

            $k = mysqli_query($koneksi, "SELECT id FROM kelas WHERE nama_kelas='$kelas' LIMIT 1");
            if ($r = mysqli_fetch_assoc($k)) $kelas_id = $r['id'];

            $m = mysqli_query($koneksi, "SELECT id FROM mapel WHERE nama_mapel='$mapel' LIMIT 1");
            if ($r = mysqli_fetch_assoc($m)) $mapel_id = $r['id'];

            if ($guru_id && $kelas_id && $mapel_id) {
                mysqli_query($koneksi, "INSERT INTO jadwal (guru_id,kelas_id,mapel_id,hari,jam_ke)
                                        VALUES ('$guru_id','$kelas_id','$mapel_id','$hari','$jam_ke')");
            } else {
                echo "❌ Gagal: ($guru | $kelas | $mapel) : Data belum ada di master <br>";
            }
        }
        fclose($handle);
        echo "<script>alert('Import selesai'); window.location='list_jadwal.php';</script>";
    } else {
        echo "<script>alert('Format file harus CSV!'); window.history.back();</script>";
    }
} else {
    header('Location:list_jadwal.php');
}
?>
