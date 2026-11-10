<?php
// Nama file & lokasi penyimpanan
$filename = "uploads/template_jadwal_guru.csv";

// Data header + contoh baris
$data = [
    ['Hari', 'Jam_Ke', 'Kelas', 'Mapel'],     // Header
    ['Senin', '1-2', '5B', 'Komputer']        // Contoh isi
];

// Buka file untuk ditulis (jika belum ada otomatis dibuat)
$fp = fopen($filename, 'w');

// Tulis tiap baris ke file CSV
foreach ($data as $row) {
    fputcsv($fp, $row);
}

fclose($fp);

echo "Template berhasil dibuat di: <b>$filename</b>";
