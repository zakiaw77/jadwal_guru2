<?php include 'config.php'; ?>
<h2>Form Absen Guru</h2>

<form method="POST">
  <label>Guru yang Absen:</label>
  <select name="guru_id">
    <?php
    $guru = mysqli_query($koneksi, "SELECT * FROM guru");
    while($g = mysqli_fetch_assoc($guru)) {
        echo "<option value='{$g['id']}'>{$g['nama']}</option>";
    }
    ?>
  </select>

  <label>Hari:</label>
  <select name="hari">
    <option>Senin</option><option>Selasa</option><option>Rabu</option>
    <option>Kamis</option><option>Jumat</option>
  </select>

  <label>Jam Ke:</label>
  <select name="jam_ke">
    <option>1-2</option><option>3-4</option><option>5-6</option>
    <option>7-8</option><option>9-10</option><option>11-12</option>
  </select>

  <button type="submit" name="cek">Cek Pengganti</button>
</form>

<?php
if (isset($_POST['cek'])) {
    $guru_id = $_POST['guru_id'];
    $hari = $_POST['hari'];
    $jam_ke = $_POST['jam_ke'];

    echo "<hr><h3>Guru Pengganti Tersedia:</h3>";

    $query = "
      SELECT * FROM guru 
      WHERE id != $guru_id AND id NOT IN (
        SELECT guru_id FROM jadwal 
        WHERE hari = '$hari' AND jam_ke = '$jam_ke'
      )
    ";

    $hasil = mysqli_query($koneksi, $query);
    if (mysqli_num_rows($hasil) > 0) {
        echo "<form method='POST' action='simpan_absen.php'>";
        echo "<input type='hidden' name='guru_id' value='$guru_id'>";
        echo "<input type='hidden' name='hari' value='$hari'>";
        echo "<input type='hidden' name='jam_ke' value='$jam_ke'>";

        echo "<label>Pilih Guru Pengganti:</label>";
        echo "<select name='pengganti_id'>";
        while($pg = mysqli_fetch_assoc($hasil)) {
            echo "<option value='{$pg['id']}'>{$pg['nama']}</option>";
        }
        echo "</select><br><br>";
        echo "<button type='submit'>Simpan Absen</button></form>";
    } else {
        echo "<p style='color:red;'>Tidak ada guru pengganti yang tersedia pada waktu ini.</p>";
    }
}
?>
