<?php
include 'config.php';

// ✅ Tambahkan autoload untuk PhpSpreadsheet
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['preview'])) {
    $guru_id = isset($_POST['guru_id']) ? intval($_POST['guru_id']) : 0;

    // ✅ Simpan file upload sementara ke folder uploads
    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_name = "uploads/temp_import." . $ext;
    move_uploaded_file($file_tmp, $file_name);

    $rows = [];

    // ✅ Deteksi format file berdasarkan ekstensi
    if ($ext == "csv") {
        if (($handle = fopen($file_name, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $rows[] = $data;
            }
            fclose($handle);
        }
    } elseif (in_array($ext, ["xlsx", "xls"])) {
        $spreadsheet = IOFactory::load($file_name);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();
    } else {
        die("❌ Format file tidak didukung. Hanya CSV atau Excel (.xlsx/.xls)");
    }

    // ✅ Tampilkan preview
    echo "<h2>Preview Import Jadwal</h2>";
    echo "<form method='POST' action='proses_import.php'>";
    echo "<input type='hidden' name='file' value='$file_name'>";
    echo "<input type='hidden' name='ext' value='$ext'>";
    echo "<input type='hidden' name='guru_id' value='$guru_id'>";

    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Hari</th><th>Jam Ke</th><th>Guru</th><th>Kelas</th><th>Mapel</th></tr>";

    foreach ($rows as $i => $row) {
        if ($i == 0) continue; // skip header
        echo "<tr>
                <td>{$row[0]}</td>
                <td>{$row[1]}</td>
                <td>{$row[2]}</td>
                <td>{$row[3]}</td>
                <td>{$row[4]}</td>
              </tr>";
    }

    echo "</table>";
    echo "<br><button type='submit' name='simpan'>✅ Simpan ke Database</button>";
    echo "</form>";
}
?>
