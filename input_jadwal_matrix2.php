<?php
include 'config.php';

// Hari dan Jam
$hari = ['Senin','Selasa','Rabu','Kamis','Jumat'];
$jam  = ['1-2','3-4','5-6','7-8','9-10','11-12'];

// Guru
$data_guru = mysqli_query($koneksi,"SELECT * FROM guru ORDER BY nama");
$guru_id = isset($_GET['guru_id'])?intval($_GET['guru_id']):0;

// Kelas dan Mapel
$data_kelas = mysqli_query($koneksi,"SELECT * FROM kelas");
$data_mapel = mysqli_query($koneksi,"SELECT * FROM mapel");

// Ambil jadwal lama
$data_jadwal=[];
if($guru_id){
    $res = mysqli_query($koneksi,"SELECT * FROM jadwal WHERE guru_id=$guru_id");
    while($d=mysqli_fetch_assoc($res)){
        $data_jadwal[$d['jam_ke']][$d['hari']] = [
            'kelas_id'=>$d['kelas_id'],'mapel_id'=>$d['mapel_id']
        ];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Input Jadwal Matrix-2</title>
    <link rel="stylesheet" href="style.css">
    <style>.filled-cell{background:#d1ffd1;}</style>
</head>
<body>
<h2>Input Jadwal Guru (Matrix)</h2>

<form method="GET">
    <label>Pilih Guru:</label>
    <select name="guru_id" onchange="this.form.submit()" required>
        <option value="">- Pilih Guru -</option>
        <?php while($g=mysqli_fetch_assoc($data_guru)): ?>
            <option value="<?= $g['id'] ?>" <?= ($g['id']==$guru_id)?'selected':'' ?>>
                <?= htmlspecialchars($g['nama']) ?>
            </option>
        <?php endwhile; ?>
    </select>
</form>

<br>

<?php if($guru_id): ?>

<!-- Import CSV -->
<!-- Import Jadwal khusus Guru ini -->
    <h3>📥 Import Jadwal Guru</h3>
    <form action="preview_import2.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="guru_id" value="<?= $guru_id ?>">
        <label>File (.csv / .xlsx / .xls):</label>
        <input type="file" name="file" accept=".csv,.xlsx,.xls" required>
        <button type="submit" name="preview">📄 Preview Import</button>
    </form>

<br>

<!-- Input Matrix -->
<form method="POST" action="simpan_jadwal_matrix.php">
<input type="hidden" name="guru_id" value="<?= $guru_id ?>">
<table border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>Jam / Hari</th>
    <?php foreach($hari as $h): ?><th><?= $h ?></th><?php endforeach; ?>
</tr>

<?php foreach($jam as $j): ?>
<tr>
    <td><?= $j ?></td>
    <?php foreach($hari as $h): 
        $sel_kelas = $data_jadwal[$j][$h]['kelas_id']??'';
        $sel_mapel = $data_jadwal[$j][$h]['mapel_id']??'';
    ?>
    <td>
        <!-- Kelas -->
        <select name="jadwal[<?= $j ?>][<?= $h ?>][kelas_id]" style="width:150px">
            <option value="">-Kelas-</option>
            <?php mysqli_data_seek($data_kelas,0);
            while($k=mysqli_fetch_assoc($data_kelas)): ?>
                <option value="<?= $k['id'] ?>" <?= ($k['id']==$sel_kelas)?'selected':'' ?>>
                    <?= $k['nama_kelas'] ?>
                </option>
            <?php endwhile; ?>
        </select><br>
        <!-- Mapel -->
        <select name="jadwal[<?= $j ?>][<?= $h ?>][mapel_id]" style="width:150px">
            <option value="">-Mapel-</option>
            <?php mysqli_data_seek($data_mapel,0);
            while($m=mysqli_fetch_assoc($data_mapel)): ?>
                <option value="<?= $m['id'] ?>" <?= ($m['id']==$sel_mapel)?'selected':'' ?>>
                    <?= $m['nama_mapel'] ?>
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
<a href="list_jadwal.php">📋 List Jadwal</a>
</form>

<?php endif; ?>

<script>
function updateCellColor(select){
    const cell = select.closest('td');
    const selects = cell.querySelectorAll('select');
    if(selects[0].value && selects[1].value){
        cell.classList.add('filled-cell');
    }else{
        cell.classList.remove('filled-cell');
    }
}
document.addEventListener('DOMContentLoaded',()=>{
    document.querySelectorAll('select').forEach(sel=>{
        sel.addEventListener('change',()=>updateCellColor(sel));
        updateCellColor(sel);
    });
});
</script>
</body>
</html>
