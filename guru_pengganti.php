<?php
include 'config.php';
$hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
$jam = ['1-2', '3-4', '5-6', '7-8','9-10','11-12'];
$data_guru = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY nama ASC");
?>

<h3>Cari Guru Pengganti</h3>
<form method="POST" action="simpan_pengganti2.php">
    <label>Hari:</label><br>
    <select name="hari" required>
        <option value="">- Pilih Hari -</option>
        <?php foreach ($hari as $h) echo "<option value='$h'>$h</option>"; ?>
    </select><br><br>

    <label>Jam Ke:</label><br>
    <select name="jam_ke" required>
        <option value="">- Pilih Jam -</option>
        <?php foreach ($jam as $j) echo "<option value='$j'>$j</option>"; ?>
    </select><br><br>

    <label>Guru yang Absen:</label><br>
    <select name="guru_absen_id" required>
        <option value="">- Pilih Guru -</option>
        <?php while ($g = mysqli_fetch_assoc($data_guru)) {
            echo "<option value='{$g['id']}'>{$g['nama']}</option>";
        } ?>
    </select><br><br>

    <label>Guru Pengganti:</label><br>
    <select name="guru_pengganti_id" required>
        <option value="">- Pilih Guru Pengganti -</option>
        <?php
        mysqli_data_seek($data_guru, 0);
        while ($g = mysqli_fetch_assoc($data_guru)) {
            echo "<option value='{$g['id']}'>{$g['nama']}</option>";
        } ?>
    </select><br><br>

    <label>Kelas yang Digantikan:</label><br>
    <select name="kelas_id" required>
        <option value="">- Pilih Kelas -</option>
        <?php
        $kelas = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY nama_kelas ASC");
        while ($k = mysqli_fetch_assoc($kelas)) {
            echo "<option value='{$k['id']}'>{$k['nama_kelas']}</option>";
        }
        ?>
    </select><br><br>

    <label>Materi yang Diajarkan:</label><br>
    <textarea name="materi" rows="3" required></textarea><br><br>

    <button type="submit">Simpan Pengganti</button>
</form>
