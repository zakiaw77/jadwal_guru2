<?php
include 'config.php';

// ✅ Tambahkan autoload untuk PhpSpreadsheet
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['simpan'])) {
    $file = $_POST['file'];
    $ext  = $_POST['ext'];
    $guru_id_fixed = isset($_POST['guru_id']) ? intval($_POST['guru_id']) : 0;

    $rows = [];

    // ✅ Baca sesuai format
    if ($ext == "csv") {
        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $rows[] = $data;
            }
            fclose($handle);
        }
    } elseif (in_array($ext, ["xlsx", "xls"])) {
        $spreadsheet = IOFactory::load($file);
        $rows = $spreadsheet->getActiveSheet()->toArray();
    }

    foreach ($rows as $i => $row) {
        if ($i == 0) continue; // skip header

        $hari   = mysqli_real_escape_string($koneksi, $row[0]);
        $jam_ke = mysqli_real_escape_string($koneksi, $row[1]);
        $guru   = mysqli_real_escape_string($koneksi, $row[2]);
        $kelas  = mysqli_real_escape_string($koneksi, $row[3]);
        $mapel  = mysqli_real_escape_string($koneksi, $row[4]);

        // --- Guru
        if ($guru_id_fixed) {
            $guru_id = $guru_id_fixed;
        } else {
            $cek = mysqli_query($koneksi, "SELECT id FROM guru WHERE nama='$guru' LIMIT 1");
            if ($r = mysqli_fetch_assoc($cek)) {
                $guru_id = $r['id'];
            } else {
                mysqli_query($koneksi, "INSERT INTO guru(nama) VALUES('$guru')");
                $guru_id = mysqli_insert_id($koneksi);
            }
        }

        // --- Kelas
        $q = mysqli_query($koneksi, "SELECT id FROM kelas WHERE nama_kelas='$kelas' LIMIT 1");
        if ($r = mysqli_fetch_assoc($q)) {
            $kelas_id = $r['id'];
        } else {
            mysqli_query($koneksi, "INSERT INTO kelas(nama_kelas) VALUES('$kelas')");
            $kelas_id = mysqli_insert_id($koneksi);
        }

        // --- Mapel
        $q = mysqli_query($koneksi, "SELECT id FROM mapel WHERE nama_mapel='$mapel' LIMIT 1");
        if ($r = mysqli_fetch_assoc($q)) {
            $mapel_id = $r['id'];
        } else {
            mysqli_query($koneksi, "INSERT INTO mapel(nama_mapel) VALUES('$mapel')");
            $mapel_id = mysqli_insert_id($koneksi);
        }

        // --- Simpan jadwal
        mysqli_query($koneksi, "DELETE FROM jadwal WHERE guru_id=$guru_id AND hari='$hari' AND jam_ke='$jam_ke'");
        mysqli_query($koneksi, "INSERT INTO jadwal(guru_id,kelas_id,mapel_id,hari,jam_ke) 
            VALUES('$guru_id','$kelas_id','$mapel_id','$hari','$jam_ke')");
    }

    echo "<script>alert('✅ Import berhasil disimpan!'); window.location='list_jadwal2.php';</script>";
}
?>
