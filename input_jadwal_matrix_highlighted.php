<?php
include 'config.php';

// Data Hari dan Jam
$hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
$jam = ['1-2', '3-4', '5-6', '7-8', '9-10', '11-12'];

// Ambil Guru
$data_guru = mysqli_query($koneksi, "SELECT * FROM guru");

// Cek guru yang dipilih
$guru_id = isset($_GET['guru_id']) ? intval($_GET['guru_id']) : 0;

// Ambil data kelas dan mapel
$data_kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
$data_mapel = mysqli_query($koneksi, "SELECT * FROM mapel");

// Ambil jadwal lama kalau ada
$data_jadwal = [];
if ($guru_id) {
    $res = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE guru_id = $guru_id");
    while ($d = mysqli_fetch_assoc($res)) {
        $data_jadwal[$d['jam_ke']][$d['hari']] = [
            'kelas_id' => $d['kelas_id'],
            'mapel_id' => $d['mapel_id'],
        ];
    }
}
?>

<head>
<style>
.filled-cell {
    background-color: #d1ffd1; /* Hijau muda saat cell terisi */
}
</style>
    <title>Input Jadwal Guru</title>
    <link rel="stylesheet" href="style.css">

</head>

<h2>Input Jadwal Guru</h2>

<form method="GET">
    <label>Pilih Guru:</label>
    <select name="guru_id" onchange="this.form.submit()" required>
        <option value="">- Pilih Guru -</option>
        <?php while ($guru = mysqli_fetch_assoc($data_guru)) : ?>
            <option value="<?= $guru['id'] ?>" <?= ($guru['id'] == $guru_id) ? 'selected' : '' ?>>
                <?= htmlspecialchars($guru['nama']) ?>
            </option>
        <?php endwhile; ?>
    </select>
</form>

<br>

<?php if ($guru_id) : ?>

<form method="POST" action="simpan_jadwal_matrix.php">
    <input type="hidden" name="guru_id" value="<?= $guru_id ?>">

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Jam / Hari</th>
            <?php foreach ($hari as $h) : ?>
                <th><?= $h ?></th>
            <?php endforeach; ?>
        </tr>

        <?php foreach ($jam as $j_index => $j_label) : ?>

<?php
$kelas_val = isset($data[$j_label][$h_label]['kelas_id']) ? $data[$j_label][$h_label]['kelas_id'] : '';
$mapel_val = isset($data[$j_label][$h_label]['mapel_id']) ? $data[$j_label][$h_label]['mapel_id'] : '';
$cell_class = (!empty($kelas_val) || !empty($mapel_val)) ? 'filled-cell' : '';
?>
<td class="<?= $cell_class ?>">
    <select name="jadwal[<?= $j_label ?>][<?= $h_label ?>][kelas_id]">
        <option value="">-Kelas-</option>
        <?php mysqli_data_seek($data_kelas, 0); while ($k = mysqli_fetch_assoc($data_kelas)) : ?>
            <option value="<?= $k['id'] ?>" <?= ($kelas_val == $k['id']) ? 'selected' : '' ?>>
                <?= $k['nama_kelas'] ?>
            </option>
        <?php endwhile; ?>
    </select><br>

    <select name="jadwal[<?= $j_label ?>][<?= $h_label ?>][mapel_id]">
        <option value="">-Mapel-</option>
        <?php mysqli_data_seek($data_mapel, 0); while ($m = mysqli_fetch_assoc($data_mapel)) : ?>
            <option value="<?= $m['id'] ?>" <?= ($mapel_val == $m['id']) ? 'selected' : '' ?>>
                <?= $m['nama_mapel'] ?>
            </option>
        <?php endwhile; ?>
    </select>
</td>

            <tr>
                <td><?= $j_label ?></td>
                <?php foreach ($hari as $h_index => $h_label) : 
                    $selected_kelas = isset($data_jadwal[$j_label][$h_label]['kelas_id']) ? $data_jadwal[$j_label][$h_label]['kelas_id'] : '';
                    $selected_mapel = isset($data_jadwal[$j_label][$h_label]['mapel_id']) ? $data_jadwal[$j_label][$h_label]['mapel_id'] : '';
                ?>
                <td>
                    <!-- Pilih Kelas -->
                    <select class = "jadwal-dropdown" name="jadwal[<?= $j_label ?>][<?= $h_label ?>][kelas_id]" style="width: 200px;">
                        <option value="">-Kelas-</option>
                        <?php
                        mysqli_data_seek($data_kelas, 0); // reset pointer
                        while ($kelas = mysqli_fetch_assoc($data_kelas)) :
                        ?>
                            <option value="<?= $kelas['id'] ?>" <?= ($kelas['id'] == $selected_kelas) ? 'selected' : '' ?>>
                                <?= $kelas['nama_kelas'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>

                    <br>

                    <!-- Pilih Mapel -->
                    <select class = "jadwal-dropdown" name="jadwal[<?= $j_label ?>][<?= $h_label ?>][mapel_id]" style="width: 200px;">
                        <option value="">-Mapel-</option>
                        <?php
                        mysqli_data_seek($data_mapel, 0); // reset pointer
                        while ($mapel = mysqli_fetch_assoc($data_mapel)) :
                        ?>
                            <option value="<?= $mapel['id'] ?>" <?= ($mapel['id'] == $selected_mapel) ? 'selected' : '' ?>>
                                <?= $mapel['nama_mapel'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <button type="submit">💾 Simpan Jadwal</button>
    <a href="index.php">Home</a>
</form>

<?php endif; ?>
