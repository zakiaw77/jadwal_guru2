<?php
include 'config.php';

// Data Hari dan Jam
$hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
$jam = ['1-2', '3-4', '5-6', '7-8', '9-10', '11-12'];

// Ambil Guru
$data_guru = mysqli_query($koneksi, "SELECT * FROM guru");

// Ambil id guru terpilih
$guru_id = isset($_GET['guru_id']) ? intval($_GET['guru_id']) : 0;

// Ambil data kelas dan mapel
$data_kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
$data_mapel = mysqli_query($koneksi, "SELECT * FROM mapel");

// Ambil jadwal lama (jika ada)
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

<!DOCTYPE html>
<html>
<head>
    <title>Input Jadwal Guru</title>
    <style>
        .filled-cell { background-color: #d1ffd1; }
    </style>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Input Jadwal Guru</h2>

<form method="GET">
    <label>Pilih Guru:</label>
    <select name="guru_id" onchange="this.form.submit()" required>
        <option value="">- Pilih Guru -</option>
        <?php while ($g = mysqli_fetch_assoc($data_guru)) : ?>
            <option value="<?= $g['id'] ?>" <?= ($g['id'] == $guru_id) ? 'selected' : '' ?>>
                <?= htmlspecialchars($g['nama']) ?>
            </option>
        <?php endwhile; ?>
    </select>
</form>

<br>

<?php if ($guru_id) : ?>

    <!-- FORM IMPORT CSV -->
    <form action="preview_import_jadwal.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="guru_id" value="<?= $guru_id ?>">
        <label>Import Jadwal (.csv):</label>
        <input type="file" name="file" accept=".csv" required>
        <button type="submit" name="preview">📄 Preview Import</button>
        <a href="uploads/template_jadwal_5kolom.csv" download>📥 Download Template CSV</a>
    </form>

    <br>

    <!-- FORM SIMPAN MANUAL -->
    <form method="POST" action="simpan_jadwal_matrix.php">
        <input type="hidden" name="guru_id" value="<?= $guru_id ?>">

        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>Jam / Hari</th>
                <?php foreach ($hari as $h) : ?>
                    <th><?= $h ?></th>
                <?php endforeach; ?>
            </tr>

            <?php foreach ($jam as $j_label) : ?>
                <tr>
                    <td><?= $j_label ?></td>

                    <?php foreach ($hari as $h_label) :
                        $selected_kelas = isset($data_jadwal[$j_label][$h_label]['kelas_id']) ? $data_jadwal[$j_label][$h_label]['kelas_id'] : '';
                        $selected_mapel = isset($data_jadwal[$j_label][$h_label]['mapel_id']) ? $data_jadwal[$j_label][$h_label]['mapel_id'] : '';
                    ?>
                    <td>

                        <!-- Kelas -->
                        <select name="jadwal[<?= $j_label ?>][<?= $h_label ?>][kelas_id]" style="width:200px;">
                            <option value="">-Kelas-</option>
                            <?php mysqli_data_seek($data_kelas, 0);
                            while ($kelas = mysqli_fetch_assoc($data_kelas)) : ?>
                                <option value="<?= $kelas['id'] ?>" <?= ($kelas['id'] == $selected_kelas) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($kelas['nama_kelas']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                        <br>

                        <!-- Mapel -->
                        <select name="jadwal[<?= $j_label ?>][<?= $h_label ?>][mapel_id]" style="width:200px;">
                            <option value="">-Mapel-</option>
                            <?php mysqli_data_seek($data_mapel, 0);
                            while ($mapel = mysqli_fetch_assoc($data_mapel)) : ?>
                                <option value="<?= $mapel['id'] ?>" <?= ($mapel['id'] == $selected_mapel) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($mapel['nama_mapel']) ?>
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
        <a href="index.php">Home</a> <a href="tampil_jadwal.php">Tampil Jadwal</a>
    </form>

<?php endif; ?>

<script>
function updateCellColor(selectElement) {
    const cell = selectElement.closest('td');
    const kelasSelect = cell.querySelector('select[name*="[kelas]"]');
    const mapelSelect = cell.querySelector('select[name*="[mapel]"]');

    if (kelasSelect.value && mapelSelect.value) {
        cell.classList.add('filled-cell');
    } else {
        cell.classList.remove('filled-cell');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const allSelects = document.querySelectorAll('select');
    allSelects.forEach(function (select) {
        select.addEventListener('change', function () {
            updateCellColor(select);
        });
        updateCellColor(select);
    });
});
</script>

</body>
</html>
