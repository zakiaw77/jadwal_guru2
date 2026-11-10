<?php
include 'config.php';

if (isset($_POST['simpan'])) {
    $target = $_POST['file'];

    if (($open = fopen($target, "r")) !== FALSE) {
        fgetcsv($open); // header
        while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
            $hari   = mysqli_real_escape_string($koneksi, $data[0]);
            $jam_ke = mysqli_real_escape_string($koneksi, $data[1]);
            $guru   = mysqli_real_escape_string($koneksi, $data[2]);
            $kelas  = mysqli_real_escape_string($koneksi, $data[3]);
            $mapel  = mysqli_real_escape_string($koneksi, $data[4]);

            // guru
            $q = mysqli_query($koneksi, "SELECT id FROM guru WHERE nama='$guru' LIMIT 1");
            if ($r = mysqli_fetch_assoc($q)) {
                $guru_id = $r['id'];
            } else {
                mysqli_query($koneksi, "INSERT INTO guru (nama) VALUES ('$guru')");
                $guru_id = mysqli_insert_id($koneksi);
            }

            // kelas
            $q = mysqli_query($koneksi, "SELECT id FROM kelas WHERE nama_kelas='$kelas' LIMIT 1");
            if ($r = mysqli_fetch_assoc($q)) {
                $kelas_id = $r['id'];
            } else {
                mysqli_query($koneksi, "INSERT INTO kelas (nama_kelas) VALUES ('$kelas')");
                $kelas_id = mysqli_insert_id($koneksi);
            }

            // mapel
            $q = mysqli_query($koneksi, "SELECT id FROM mapel WHERE nama_mapel='$mapel' LIMIT 1");
            if ($r = mysqli_fetch_assoc($q)) {
                $mapel_id = $r['id'];
            } else {
                mysqli_query($koneksi, "INSERT INTO mapel (nama_mapel) VALUES ('$mapel')");
                $mapel_id = mysqli_insert_id($koneksi);
            }

            mysqli_query($koneksi,"INSERT INTO jadwal(guru_id,kelas_id,mapel_id,hari,jam_ke)
                                   VALUES('$guru_id','$kelas_id','$mapel_id','$hari','$jam_ke')");
        }
        fclose($open);
    }

    echo "<script>alert('Berhasil disimpan!'); window.location='list_jadwal.php';</script>";
} else {
    header('Location: list_jadwal.php');
}
?>
