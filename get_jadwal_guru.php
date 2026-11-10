<?php

include 'config.php';

/*
|--------------------------------------------------------------------------
| Ambil parameter dari JavaScript
|--------------------------------------------------------------------------
*/

$guru_id = isset($_GET['guru_id'])
    ? intval($_GET['guru_id'])
    : 0;

$hari = isset($_GET['hari'])
    ? trim($_GET['hari'])
    : '';


/*
|--------------------------------------------------------------------------
| Validasi
|--------------------------------------------------------------------------
*/

if ($guru_id <= 0 || $hari == '') {

    header('Content-Type: application/json');

    echo json_encode([
        'status' => 'error',
        'message' => 'Guru dan hari belum dipilih.'
    ]);

    exit;
}


/*
|--------------------------------------------------------------------------
| Amankan nama hari
|--------------------------------------------------------------------------
*/

$hari = mysqli_real_escape_string(
    $koneksi,
    $hari
);


/*
|--------------------------------------------------------------------------
| Ambil jadwal guru dari tabel JADWAL
|--------------------------------------------------------------------------
|
| Tidak menggunakan jadwal2.
|
*/

$query = "
    SELECT
        j.jam_ke,
        j.kelas_id,
        j.mapel_id,
        k.nama_kelas,
        m.nama_mapel

    FROM jadwal j

    LEFT JOIN kelas k
        ON j.kelas_id = k.id

    LEFT JOIN mapel m
        ON j.mapel_id = m.id

    WHERE j.guru_id = $guru_id
      AND j.hari = '$hari'

    ORDER BY
        CAST(j.jam_ke AS UNSIGNED) ASC
";


$result = mysqli_query(
    $koneksi,
    $query
);


/*
|--------------------------------------------------------------------------
| Cek apakah query berhasil
|--------------------------------------------------------------------------
*/

if (!$result) {

    header('Content-Type: application/json');

    echo json_encode([
        'status' => 'error',
        'message' => 'Gagal mengambil jadwal: '
                     . mysqli_error($koneksi)
    ]);

    exit;
}


/*
|--------------------------------------------------------------------------
| Masukkan data ke array
|--------------------------------------------------------------------------
*/

$data = [];


while ($row = mysqli_fetch_assoc($result)) {

    $data[] = [

        'jam_ke' => $row['jam_ke'],

        'kelas_id' => $row['kelas_id'],

        'nama_kelas' => $row['nama_kelas'],

        'mapel_id' => $row['mapel_id'],

        'nama_mapel' => $row['nama_mapel']

    ];
}


/*
|--------------------------------------------------------------------------
| Kirim hasil dalam format JSON
|--------------------------------------------------------------------------
*/

header('Content-Type: application/json');

echo json_encode([

    'status' => 'success',

    'data' => $data

]);

?>