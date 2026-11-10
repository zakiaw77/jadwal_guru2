<?php
include 'config.php';
session_start();

$success = 0;
$duplicate = 0;

// Proses upload
if (isset($_POST['upload'])) {
    $filename = $_FILES['file']['tmp_name'];

    if ($_FILES['file']['size'] > 0) {
        $file = fopen($filename, "r");

        // Lewati baris pertama jika ada header
        fgetcsv($file);

        while (($row = fgetcsv($file, 1000, ",")) !== FALSE) {
            $nama = mysqli_real_escape_string($koneksi, $row[0]);
            $nbm = mysqli_real_escape_string($koneksi, $row[1]);

            if (!empty($nama) && !empty($nbm)) {
                // Cek duplikat NBM
                $cek = mysqli_query($koneksi, "SELECT * FROM guru WHERE nbm = '$nbm'");
                if (mysqli_num_rows($cek) == 0) {
                    mysqli_query($koneksi, "INSERT INTO guru (nama, nbm) VALUES ('$nama', '$nbm')");
                    $success++;
                } else {
                    $duplicate++;
                }
            }
        }

        fclose($file);

        echo "<script>alert('Upload selesai: $success berhasil, $duplicate duplikat!'); window.location='list_guru.php';</script>";
    } else {
        echo "<script>alert('File kosong!');</script>";
    }
}
?>

<head>
    <title>Upload Data Guru</title>
    <link rel="stylesheet" href="style.css">
</head>

<h3>Upload Data Guru dari CSV</h3>

<form method="POST" enctype="multipart/form-data" action="">
    <label>Pilih file CSV:</label><br>
    <input type="file" name="file" accept=".csv" required><br><br>

    <button type="submit" name="upload">Upload CSV</button>
</form>
