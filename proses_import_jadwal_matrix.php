<?php
include 'config.php';

if(isset($_POST['simpan'])){
    $guru_id = intval($_POST['guru_id']);
    $file    = $_POST['file'];

    if(($handle = fopen($file, "r")) !== FALSE){
        fgetcsv($handle); // skip header
        while(($data = fgetcsv($handle, 1000, ",")) !== FALSE){
            $hari   = mysqli_real_escape_string($koneksi, $data[0]);
            $jam    = mysqli_real_escape_string($koneksi, $data[1]);
            $kelas  = mysqli_real_escape_string($koneksi, $data[2]);
            $mapel  = mysqli_real_escape_string($koneksi, $data[3]);

            // Tambah master: kelas
            $q = mysqli_query($koneksi,"SELECT id FROM kelas WHERE nama_kelas='$kelas' LIMIT 1");
            if($r = mysqli_fetch_assoc($q)) $kelas_id = $r['id'];
            else{
                mysqli_query($koneksi,"INSERT INTO kelas(nama_kelas) VALUES('$kelas')");
                $kelas_id = mysqli_insert_id($koneksi);
            }

            // Tambah master: mapel
            $q = mysqli_query($koneksi,"SELECT id FROM mapel WHERE nama_mapel='$mapel' LIMIT 1");
            if($r = mysqli_fetch_assoc($q)) $mapel_id = $r['id'];
            else{
                mysqli_query($koneksi,"INSERT INTO mapel(nama_mapel) VALUES('$mapel')");
                $mapel_id = mysqli_insert_id($koneksi);
            }

            // Hapus jadwal lama pada slot yg sama
            mysqli_query($koneksi,"DELETE FROM jadwal WHERE guru_id=$guru_id AND hari='$hari' AND jam_ke='$jam'");

            // Simpan baru
            mysqli_query($koneksi,"INSERT INTO jadwal(guru_id,kelas_id,mapel_id,hari,jam_ke)
                                   VALUES('$guru_id','$kelas_id','$mapel_id','$hari','$jam')");
        }
        fclose($handle);
    }

    echo "<script>alert('Import CSV berhasil disimpan!'); window.location='input_jadwal_matrix.php?guru_id=$guru_id';</script>";
} else {
    header("Location: input_jadwal_matrix.php");
}
