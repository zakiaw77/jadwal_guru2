<?php include 'config.php'; ?>
<h2>Input Jadwal Guru (Model Matriks)</h2>

<form method="GET">
  <label>Pilih Guru:</label>
  <select name="guru_id" onchange="this.form.submit()">
    <option value="">-- Pilih --</option>
    <?php
    $guru = mysqli_query($koneksi, "SELECT * FROM guru");
    while($g = mysqli_fetch_assoc($guru)) {
        $selected = (isset($_GET['guru_id']) && $_GET['guru_id'] == $g['id']) ? 'selected' : '';
        echo "<option value='{$g['id']}' $selected>{$g['nama']}</option>";
    }
    ?>
  </select>
</form>

<?php
if (isset($_GET['guru_id'])):
$guru_id = $_GET['guru_id'];
$hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
$jam = ['1-2', '3-4', '5-6', '7-8', '9-10', '11-12'];

// Ambil data lama
$data = [];
$res = mysqli_query($koneksi, "SELECT j.*, m.nama_mapel, k.nama_kelas 
  FROM jadwal j 
  LEFT JOIN mapel m ON j.mapel_id = m.id 
  JOIN kelas k ON j.kelas_id = k.id
  WHERE j.guru_id = $guru_id");
while ($d = mysqli_fetch_assoc($res)) {
    $data[$d['jam_ke']][$d['hari']] = "{$d['nama_kelas']} - {$d['nama_mapel']}";
}
?>

<form method="POST" action="simpan_matrix.php">
  <input type="hidden" name="guru_id" value="<?= $guru_id ?>">

  <table border="1" cellpadding="4" style="width:80%">
    <tr>
      <th>Jam / Hari</th>
      <?php foreach($hari as $h) echo "<th>$h</th>"; ?>
    </tr>
    <?php foreach($jam as $j): ?>
    <tr>
      <th><?= $j ?></th>
      <?php foreach($hari as $h): 
        $value = isset($data[$j][$h]) ? $data[$j][$h] : '';
      ?>
        <td>
          <input type="text" name="jadwal[<?= $j ?>][<?= $h ?>]" value="<?= $value ?>" style="width:50%;">
        </td>
      <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>
  </table>
  <br>
  <button type="submit">Simpan Jadwal</button>
</form>

<?php endif; ?>
