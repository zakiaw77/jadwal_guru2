<?php
include 'config.php';

$hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
$jam = range(1, 12); // Jam ke 1 sampai 12

// Ambil semua guru untuk dropdown
$data_guru = mysqli_query($koneksi, "SELECT * FROM guru");

// Cek guru_id yang dipilih
$guru_id = isset($_GET['guru_id']) ? intval($_GET['guru_id']) : 0;
?>

<h3>Lihat Jadwal Guru</h3>

<!-- Form Pilih Guru -->
<form method="GET" action="">
    <label for="guru_id">Pilih Guru:</label>
    <select name="guru_id" id="guru_id" onchange="this.form.submit()">
        <option value="">-Pilih Guru-</option>
        <?php while ($g = mysqli_fetch_assoc($data_guru)) : ?>
            <option value="<?= $g['id'] ?>" <?= ($g['id'] == $guru_id) ? 'selected' : '' ?>>
                <?= $g['nama'] ?>
            </option>
        <?php endwhile; ?>
    </select>
</form>

<br>

<?php if ($guru_id) : ?>

<?php
// Ambil data jadwal dari jadwal2
$q = mysqli_query($koneksi, "
    SELECT j.*, k.nama_kelas, m.nama_mapel 
    FROM jadwal2 j
    JOIN kelas k ON j.kelas_id = k.id
    JOIN mapel m ON j.mapel_id = m.id
    WHERE j.guru_id = $guru_id
");

$data_jadwal = [];
while ($d = mysqli_fetch_assoc($q)) {
    $data_jadwal[$d['jam_ke']][$d['hari']] = "{$d['nama_kelas']} - {$d['nama_mapel']}";
}
?>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Jam / Hari</th>
        <?php foreach ($hari as $h) : ?>
            <th><?= $h ?></th>
        <?php endforeach; ?>
    </tr>

    <?php foreach ($jam as $j_ke) : ?>
        <tr>
            <td><?= $j_ke ?></td>
            <?php foreach ($hari as $h) : ?>
                <td>
                    <?= isset($data_jadwal[$j_ke][$h]) ? $data_jadwal[$j_ke][$h] : '-' ?>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>

<?php endif; ?>
