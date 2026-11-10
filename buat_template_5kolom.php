<?php
// Pastikan folder uploads sudah ada
$filename = "uploads/template_jadwal_5kolom.csv";

// Data header + contoh baris
$data = [
    ['Hari', 'Jam_Ke', 'Guru', 'Kelas', 'Mapel'],    // Header
    ['Senin', '1-2', "Syafa'atul Ilmiah", '5B', 'Komputer']  // Contoh isi
];

// Buka/buat file
$fp = fopen($filename, 'w');

// Tulis ke CSV
foreach ($data as $row) {
    fputcsv($fp, $row);
}

fclose($fp);

// Feedback
echo "Template CSV berhasil dibuat di: <b>$filename</b>";
