<?php
include 'config.php';

if(isset($_POST['simpan'])){
    $file    = $_POST['file'];
    $guru_id_fixed = isset($_POST['guru_id']) ? intval($_POST['guru_id']) : 0; // jika dari matrix

    if(($handle = fopen($file, "r")) !== FALSE){
        fgetcsv($handle); // skip header
        while(($data = fgetcsv($handle, 1000, ",")) !== FALSE){
            // CSV berisi 5 kolom
            $hari    = mysqli_real_escape_string($koneksi, $data[0]);
            $jam_ke  = mysqli_real_escape_string($koneksi, $data[1]);
            $guru    = mysqli_real_escape_string($koneksi, $data[2]);
            $kelas   = mysqli_real_escape_string($koneksi, $data[3]);
            $mapel   = mysqli_real_escape_string($koneksi, $data[4]);

            // --- Guru
            if($guru_id_fixed){ // dari matrix (guru sudah dipilih)
                $guru_id = $guru_id_fixed;
            } else {
                $cek = mysqli_query($koneksi,"SELECT id FROM guru WHERE nama='$guru' LIMIT 1");
                if($r = mysqli_fetch_assoc($cek)) $guru_id = $r['id'];
                else { mysqli_query($koneksi,"INSERT INTO guru(nama) VALUES('$guru')"); $guru_id = mysqli_insert_id($koneksi); }
            }

            // --- Kelas
            $q = mysqli_query($koneksi,"SELECT id FROM kelas WHERE nama_kelas='$kelas' LIMIT 1");
            if($r = mysqli_fetch_assoc($q)) $kelas_id = $r['id'];
            else{ mysqli_query($koneksi,"INSERT INTO kelas(nama_kelas) VALUES('$kelas')"); $kelas_id = mysqli_insert_id($koneksi); }

            // --- Mapel
            $q = mysqli_query($koneksi,"SELECT id FROM mapel WHERE nama_mapel='$mapel' LIMIT 1");
            if($r = mysqli_fetch_assoc($q)) $mapel_id = $r['id'];
            else{ mysqli_query($koneksi,"INSERT INTO mapel(nama_mapel) VALUES('$mapel')"); $mapel_id = mysqli_insert_id($koneksi); }

            // --- Simpan jadwal
            mysqli_query($koneksi,"DELETE FROM jadwal WHERE guru_id=$guru_id AND hari='$hari' AND jam_ke='$jam_ke'");
            mysqli_query($koneksi,"INSERT INTO jadwal(guru_id,kelas_id,mapel_id,hari,jam_ke) VALUES('$guru_id','$kelas_id','$mapel_id','$hari','$jam_ke')");
        }
        fclose($handle);
    }

    // Jika dari matrix, redirect kembali ke matrix:
    if($guru_id_fixed){
        echo "<script>alert('Import CSV berhasil untuk guru terpilih!'); window.location='input_jadwal_matrix.php?guru_id=$guru_id_fixed';</script>";
    } else {
        echo "<script>alert('Import CSV berhasil!'); window.location='list_jadwal.php';</script>";
    }
} else {
    header("Location: input_jadwal_matrix.php");
}
