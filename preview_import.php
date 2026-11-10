<?php
include 'config.php';

if (isset($_POST['preview'])) {
    $nama_file = $_FILES['file']['name'];
    $tmp       = $_FILES['file']['tmp_name'];
    $ext       = pathinfo($nama_file, PATHINFO_EXTENSION);

    if ($ext != 'csv') {
        die('Format file harus CSV.');
    }

    // simpan ke folder uploads/
    $target = 'uploads/' . $nama_file;
    move_uploaded_file($tmp, $target);

    // baca isi csv
    $rows = [];
    if (($open = fopen($target, "r")) !== FALSE) {
        $header = fgetcsv($open); // header
        while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
            $rows[] = $data;
        }
        fclose($open);
    }
} else {
    header('Location: list_jadwal.php');
    exit;
}
?>

<h2>Preview Import Jadwal dari CSV</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Hari</th>
        <th>Jam Ke</th>
        <th>Guru</th>
        <th>Kelas</th>
        <th>Mapel</th>
    </tr>
    <?php foreach ($rows as $r): ?>
    <tr>
        <td><?= htmlspecialchars($r[0]) ?></td>
        <td><?= htmlspecialchars($r[1]) ?></td>
        <td><?= htmlspecialchars($r[2]) ?></td>
        <td><?= htmlspecialchars($r[3]) ?></td>
        <td><?= htmlspecialchars($r[4]) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<br>
<form action="proses_import.php" method="POST">
    <input type="hidden" name="file" value="<?= $target ?>">
    <button type="submit" name="simpan">✅ Simpan ke Database</button>
    <a href="list_jadwal.php">❌ Batalkan</a>
</form>
