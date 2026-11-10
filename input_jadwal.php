<?php include 'config.php'; ?>
<form method='POST' action='simpan_jadwal.php'>
  <label>Nama Guru:</label>
  <select name="guru_id">
    <?php
    // ambil dari database
    $result = mysqli_query($koneksi, "SELECT * FROM guru");
    while($row = mysqli_fetch_assoc($result)) {
        echo "<option value='{$row['id']}'>{$row['nama']}</option>";
    }
    ?>
  </select>

  <label>Kelas:</label>
  <select name="kelas_id">
    <?php
      // ambil dari database mata pelajaran
      $result_kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
      while($row_kelas = mysqli_fetch_assoc($result_kelas)) {
          echo "<option value='{$row_kelas['id']}'>{$row_kelas['nama_kelas']}</option>";
      }
      ?>
  </select>

  <label>Mata Pelajaran:</label>
  <select name="mapel_id">
    <?php
    // ambil dari database mata pelajaran
    $result_mapel = mysqli_query($koneksi, "SELECT * FROM mapel");
    while($row_mapel = mysqli_fetch_assoc($result_mapel)) {
        echo "<option value='{$row_mapel['id']}'>{$row_mapel['nama_mapel']}</option>";
    }
    ?>
  </select>

  <label>Hari:</label>
  <select name="hari">
    <option>Senin</option>
    <option>Selasa</option>
    <option>Rabu</option>
    <option>Kamis</option>
    <option>Jumat</option>
  </select>

  <label>Jam Ke:</label>
  <select name="jam_ke">
    <option>1-2</option>
    <option>3-4</option>
    <option>5-6</option>
    <option>7-8</option>
    <option>9-10</option>
    <option>11-12</option>
  </select>

  <button type="submit">Simpan Jadwal</button>
</form>
