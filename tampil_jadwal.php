<?php
include 'config.php';

// Data Hari dan Jam
$hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
$jam = ['1-2', '3-4', '5-6', '7-8', '9-10', '11-12'];

// Ambil data semua guru
$data_guru = mysqli_query($koneksi, "SELECT * FROM guru");

// Cek guru yang dipilih
$guru_id = isset($_GET['guru_id']) ? intval($_GET['guru_id']) : 0;

// Ambil data jadwal guru ini
$jadwal = [];
if ($guru_id) {
    $res = mysqli_query($koneksi, "
        SELECT j.*, k.nama_kelas, m.nama_mapel
        FROM jadwal j
        LEFT JOIN kelas k ON j.kelas_id = k.id
        LEFT JOIN mapel m ON j.mapel_id = m.id
        WHERE j.guru_id = $guru_id
    ");
    while ($row = mysqli_fetch_assoc($res)) {
        $jadwal[$row['jam_ke']][$row['hari']] = [
            'kelas' => $row['nama_kelas'],
            'mapel' => $row['nama_mapel']
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <title>Lihat Jadwal Guru</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #aaa;
      padding: 8px;
      text-align: center;
      vertical-align: middle;
    }
    th {
      background-color: #007bff;
      color: white;
    }
    td.empty {
      background-color: #ffd6d6; /* pink lembut untuk kosong */
    }
    select, button {
      padding: 8px;
      margin-top: 10px;
    }
    .form-container {
      background: #f9f9f9;
      padding: 20px;
      border-radius: 8px;
    }
  </style>
</head>
<body>

<h2 style="text-align:center;">Lihat Jadwal Guru</h2>

<div class="form-container">
    <form method="GET" action="">
        <label for="guru_id">Pilih Guru:</label><br>
        <select name="guru_id" id="guru_id" onchange="this.form.submit()" style="width: 100%;">
            <option value="">- Pilih Guru -</option>
            <?php while ($guru = mysqli_fetch_assoc($data_guru)) : ?>
                <option value="<?= $guru['id'] ?>" <?= ($guru['id'] == $guru_id) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($guru['nama']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </form>
</div>

<?php if ($guru_id) : ?>

<table>
    <tr>
        <th>Jam / Hari</th>
        <?php foreach ($hari as $h) : ?>
            <th><?= $h ?></th>
        <?php endforeach; ?>
    </tr>

    <?php foreach ($jam as $j_label) : ?>
    <tr>
        <td><strong><?= $j_label ?></strong></td>
        <?php foreach ($hari as $h_label) : ?>
            <?php
            if (isset($jadwal[$j_label][$h_label])) {
                $row = $jadwal[$j_label][$h_label];
                ?>
                <td>
                    Kelas: <?= htmlspecialchars($row['kelas']) ?><br>
                    Mapel: <?= htmlspecialchars($row['mapel']) ?>
                </td>
                <?php
            } else {
                ?>
                <td class="empty">-</td>
                <?php
            }
            ?>
        <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>
</table>

<?php endif; ?>

<br>
<a href="index.php">+ Home</a>  <a href="input_jadwal_matrix.php">+ Input Matrix Jadwal</a>


</body>
</html>
