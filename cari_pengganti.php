<?php
include 'config.php';
session_start();
/*
|--------------------------------------------------------------------------
| Variabel awal
|--------------------------------------------------------------------------
*/
$hari = isset($_POST['hari'])
    ? trim($_POST['hari'])
    : '';
$jam_ke = isset($_POST['jam_ke'])
    ? trim($_POST['jam_ke'])
    : '';
$guru_absen = isset($_POST['guru_id'])
    ? intval($_POST['guru_id'])
    : 0;
$kelas_id = isset($_POST['kelas_id'])
    ? intval($_POST['kelas_id'])
    : 0;
$materi = isset($_POST['materi'])
    ? trim($_POST['materi'])
    : '';
$result = null;
/*
|--------------------------------------------------------------------------
| Jika tombol Cari Guru Pengganti ditekan
|--------------------------------------------------------------------------
*/
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    &&
    isset($_POST['cari_pengganti'])
) {
    /*
    |--------------------------------------------------------------------------
    | Validasi data
    |--------------------------------------------------------------------------
    */
    if (
        $hari == ''
        ||
        $jam_ke == ''
        ||
        $guru_absen <= 0
        ||
        $kelas_id <= 0
    ) {
        echo "<script>
            alert(
                'Coba cek ada data yang kurang valid.'
            );
        </script>";
    } else {
        /*
        |--------------------------------------------------------------------------
        | Amankan hari
        |--------------------------------------------------------------------------
        */
        $hari_safe = mysqli_real_escape_string(
            $koneksi,
            $hari
        );
        /*
        |--------------------------------------------------------------------------
        | Amankan jam
        |--------------------------------------------------------------------------
        */
        $jam_safe = mysqli_real_escape_string(
            $koneksi,
            $jam_ke
        );
        /*
        |--------------------------------------------------------------------------
        | Cari guru yang kosong
        |--------------------------------------------------------------------------
        |
        | Guru dianggap tersedia jika:
        |
        | 1. Bukan guru yang absen
        | 2. Tidak mempunyai jadwal pada hari tersebut
        | 3. Tidak mempunyai jadwal pada jam tersebut
        |
        */
        $sql = "
            SELECT *
            FROM guru
            WHERE id != $guru_absen
            AND id NOT IN (
                SELECT guru_id
                FROM jadwal
                WHERE hari = '$hari_safe'
                AND jam_ke = '$jam_safe'
            )
            ORDER BY nama ASC
        ";
        /*
        |--------------------------------------------------------------------------
        | Jalankan query
        |--------------------------------------------------------------------------
        */
        $result = mysqli_query(
            $koneksi,
            $sql
        );
        /*
        |--------------------------------------------------------------------------
        | Jika query gagal
        |--------------------------------------------------------------------------
        */
        if (!$result) {
            echo "<script>
                alert(
                    'Terjadi kesalahan saat mencari guru pengganti.'
                );
            </script>";
            $result = null;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>
<title>Cari Guru Pengganti</title>
<link
    rel="stylesheet"
    href="style.css"
>
<style>
/*
|--------------------------------------------------------------------------
| Informasi jadwal guru absen
|--------------------------------------------------------------------------
*/
.info-jadwal-absen {
    margin-top: 20px;
    margin-bottom: 20px;
    padding: 15px;
    background: #fff8e1;
    border-left: 5px solid #ff9800;
    border-radius: 8px;
}
/*
|--------------------------------------------------------------------------
| Judul informasi
|--------------------------------------------------------------------------
*/
.judul-info {
    font-size: 18px;
    font-weight: bold;
    color: #e65100;
    margin-bottom: 10px;
}
/*
|--------------------------------------------------------------------------
| Tabel jadwal
|--------------------------------------------------------------------------
*/
.tabel-jadwal-absen {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}
.tabel-jadwal-absen th {
    background: #ff9800;
    color: white;
    padding: 10px;
}
.tabel-jadwal-absen td {
    padding: 10px;
    border: 1px solid #ddd;
    background: white;
    text-align: center;
}
/*
|--------------------------------------------------------------------------
| Efek hover
|--------------------------------------------------------------------------
*/
.tabel-jadwal-absen tr:hover td {
    background: #fff3e0;
}
/*
|--------------------------------------------------------------------------
| Baris yang dipilih
|--------------------------------------------------------------------------
*/
.tabel-jadwal-absen tr.jadwal-terpilih td {
    background: #ffe0b2;
    font-weight: bold;
}
/*
|--------------------------------------------------------------------------
| Informasi mapel
|--------------------------------------------------------------------------
*/
.info-mapel {
    margin-top: 10px;
    margin-bottom: 15px;
    padding: 10px;
    background: #e3f2fd;
    border-left: 4px solid #2196f3;
    border-radius: 5px;
    color: #1565c0;
}
/*
|--------------------------------------------------------------------------
| Informasi awal
|--------------------------------------------------------------------------
*/
.info-awal {
    padding: 12px;
    background: #f5f5f5;
    border-radius: 6px;
    color: #666;
}
/*
|--------------------------------------------------------------------------
| Tidak ada jadwal
|--------------------------------------------------------------------------
*/
.info-kosong {
    padding: 12px;
    background: #ffebee;
    border-left: 4px solid #f44336;
    border-radius: 5px;
    color: #c62828;
}
/*
|--------------------------------------------------------------------------
| Loading
|--------------------------------------------------------------------------
*/
.loading-jadwal {
    padding: 12px;
    background: #e3f2fd;
    border-left: 4px solid #2196f3;
}
/*
|--------------------------------------------------------------------------
| Error
|--------------------------------------------------------------------------
*/
.info-error {
    padding: 12px;
    background: #ffebee;
    border-left: 4px solid #f44336;
    border-radius: 5px;
    color: #c62828;
}
/*
|--------------------------------------------------------------------------
| Guru pengganti
|--------------------------------------------------------------------------
*/
.hasil-pengganti {
    margin-top: 20px;
    padding: 15px;
    background: #f1f8e9;
    border-left: 5px solid #4caf50;
    border-radius: 8px;
}
/*
|--------------------------------------------------------------------------
| Tidak ada guru kosong
|--------------------------------------------------------------------------
*/
.tidak-ada-guru {
    padding: 12px;
    background: #ffebee;
    color: #c62828;
    border-left: 4px solid #f44336;
    border-radius: 5px;
}
</style>
</head>
<body>
<h3>Cari Guru Pengganti</h3>
<a href="index.php">
    Home
</a>
<br><br>
<form
    method="POST"
    action=""
>
<!-- =========================================================
     PILIH HARI
========================================================= -->
<label>
    <strong>Hari:</strong>
</label>
<br>
<select
    name="hari"
    id="hari"
    required
    onchange="ambilJadwalGuru()"
>
    <option value="">
        - Pilih Hari -
    </option>
    <option
        value="Senin"
        <?= ($hari == 'Senin')
            ? 'selected'
            : '' ?>
    >
        Senin
    </option>
    <option
        value="Selasa"
        <?= ($hari == 'Selasa')
            ? 'selected'
            : '' ?>
    >
        Selasa
    </option>
    <option
        value="Rabu"
        <?= ($hari == 'Rabu')
            ? 'selected'
            : '' ?>
    >
        Rabu
    </option>
    <option
        value="Kamis"
        <?= ($hari == 'Kamis')
            ? 'selected'
            : '' ?>
    >
        Kamis
    </option>
    <option
        value="Jumat"
        <?= ($hari == 'Jumat')
            ? 'selected'
            : '' ?>
    >
        Jumat
    </option>
</select>
<br><br>
<!-- =========================================================
     GURU YANG ABSEN
========================================================= -->
<label>
    <strong>Guru yang Absen:</strong>
</label>
<br>
<select
    name="guru_id"
    id="guru_id"
    required
    onchange="ambilJadwalGuru()"
>
    <option value="">
        - Pilih Guru -
    </option>
    <?php
    $guru_query = mysqli_query(
        $koneksi,
        "SELECT * FROM guru ORDER BY nama ASC"
    );
    while (
        $g = mysqli_fetch_assoc($guru_query)
    ):
    ?>
        <option
            value="<?= $g['id'] ?>"
            <?= ($g['id'] == $guru_absen)
                ? 'selected'
                : '' ?>
        >
            <?= htmlspecialchars(
                $g['nama']
            ) ?>
            <?php if (
                isset($g['nbm'])
                &&
                $g['nbm'] != ''
            ): ?>
                (NBM:
                <?= htmlspecialchars(
                    $g['nbm']
                ) ?>)
            <?php endif; ?>
        </option>
    <?php endwhile; ?>
</select>
<!-- =========================================================
     INFORMASI JADWAL GURU ABSEN
========================================================= -->
<div id="informasi-jadwal">
    <p class="info-awal">
        Pilih hari dan guru yang absen
        untuk melihat jadwal mengajarnya.
    </p>
</div>
<!-- =========================================================
     JAM KE
========================================================= -->
<label>
    <strong>Jam Ke:</strong>
</label>
<br>
<!--
    Dropdown ini hanya untuk menampilkan jam.
    Nilai sebenarnya dikirim melalui hidden input.
-->
<select
    id="jam_ke_tampil"
    required
    disabled
>
    <option value="">
        - Jam otomatis -
    </option>
</select>
<!--
    Nilai jam yang benar dikirim ke PHP
-->
<input
    type="hidden"
    name="jam_ke"
    id="jam_ke"
    value="<?= htmlspecialchars($jam_ke) ?>"
>
<br><br>
<!-- =========================================================
     KELAS
========================================================= -->
<label>
    <strong>Kelas yang ditinggalkan:</strong>
</label>
<br>
<!--
    Dropdown ini TIDAK memakai name="kelas_id"
    karena value-nya sekarang merupakan:
    jam|kelas_id|mapel_id
    Contoh:
    7-8|12|5
    Data kelas sebenarnya dikirim melalui hidden input.
-->
<select
    id="kelas_id_pilihan"
    required
    disabled
    onchange="pilihKelas()"
>
    <option value="">
        - Pilih Hari dan Guru terlebih dahulu -
    </option>
</select>
<!--
    ID kelas yang sebenarnya dikirim ke PHP
-->
<input
    type="hidden"
    name="kelas_id"
    id="kelas_id"
    value="<?= $kelas_id ?>"
>
<br>
<!-- =========================================================
     MAPEL
========================================================= -->
<div
    id="info-mapel"
    class="info-mapel"
>
    Mata Pelajaran:
    <strong>-</strong>
</div>
<!-- =========================================================
     MATERI
========================================================= -->
<label>
    <strong>Materi yang harus diajarkan:</strong>
</label>
<br>
<textarea
    name="materi"
    required
><?= htmlspecialchars($materi) ?></textarea>
<br><br>
<!-- =========================================================
     TOMBOL CARI
========================================================= -->
<button
    type="submit"
    name="cari_pengganti"
>
    🔎 Cari Guru Pengganti
</button>
</form>
<?php if ($result !== null): ?>
<!-- =========================================================
     HASIL GURU PENGGANTI
========================================================= -->
<div class="hasil-pengganti">
<h3>
    👨‍🏫 Guru Pengganti Tersedia
</h3>
<?php if (
    mysqli_num_rows($result) > 0
): ?>
<form
    method="POST"
    action="simpan_pengganti.php"
>
<!-- DATA TERSEMBUNYI -->
<input
    type="hidden"
    name="hari"
    value="<?= htmlspecialchars($hari) ?>"
>
<input
    type="hidden"
    name="jam_ke"
    value="<?= htmlspecialchars($jam_ke) ?>"
>
<input
    type="hidden"
    name="guru_absen"
    value="<?= $guru_absen ?>"
>
<input
    type="hidden"
    name="kelas_id"
    value="<?= $kelas_id ?>"
>
<input
    type="hidden"
    name="materi"
    value="<?= htmlspecialchars($materi) ?>"
>
<!-- =========================================================
     PILIH GURU PENGGANTI
========================================================= -->
<select
    name="guru_pengganti"
    required
>
    <option value="">
        - Pilih Guru Pengganti -
    </option>
    <?php
    while (
        $row = mysqli_fetch_assoc($result)
    ):
    ?>
        <option
            value="<?= $row['id'] ?>"
        >
            <?= htmlspecialchars(
                $row['nama']
            ) ?>
            <?php if (
                isset($row['nbm'])
                &&
                $row['nbm'] != ''
            ): ?>
                (NBM:
                <?= htmlspecialchars(
                    $row['nbm']
                ) ?>)
            <?php endif; ?>
        </option>
    <?php endwhile; ?>
</select>
<br><br>
<button type="submit">
    💾 Simpan Guru Pengganti
</button>
</form>
<?php else: ?>
<div class="tidak-ada-guru">
    ❌ Tidak ada guru kosong pada
    <?= htmlspecialchars($hari) ?>
    jam
    <?= htmlspecialchars($jam_ke) ?>.
</div>
<?php endif; ?>
</div>
<?php endif; ?>
<!-- =========================================================
     JAVASCRIPT
========================================================= -->
<script>
/*
|--------------------------------------------------------------------------
| Menyimpan seluruh jadwal guru yang absen
|--------------------------------------------------------------------------
*/
let jadwalGuru = [];
/*
|--------------------------------------------------------------------------
| Data yang berasal dari PHP
|--------------------------------------------------------------------------
|
| Ini digunakan ketika halaman kembali dibuka setelah tombol
| "Cari Guru Pengganti" ditekan.
|
*/
const jamTerpilihAwal =
    <?= json_encode($jam_ke) ?>;
const kelasTerpilihAwal =
    <?= json_encode($kelas_id) ?>;
/*
|--------------------------------------------------------------------------
| Ambil jadwal guru berdasarkan Hari + Guru
|--------------------------------------------------------------------------
*/
function ambilJadwalGuru()
{
    const guruId =
        document.getElementById(
            'guru_id'
        ).value;
    const hari =
        document.getElementById(
            'hari'
        ).value;
    const informasi =
        document.getElementById(
            'informasi-jadwal'
        );
    const kelasSelect =
        document.getElementById(
            'kelas_id_pilihan'
        );
    const jamSelect =
        document.getElementById(
            'jam_ke_tampil'
        );
    /*
    |--------------------------------------------------------------------------
    | Reset data
    |--------------------------------------------------------------------------
    */
    jadwalGuru = [];
    kelasSelect.innerHTML = `
        <option value="">
            - Pilih Kelas -
        </option>
    `;
    kelasSelect.disabled = true;
    jamSelect.innerHTML = `
        <option value="">
            - Jam otomatis -
        </option>
    `;
    jamSelect.disabled = true;
    document.getElementById(
        'kelas_id'
    ).value = '';
    document.getElementById(
        'jam_ke'
    ).value = '';
    document.getElementById(
        'info-mapel'
    ).innerHTML = `
        Mata Pelajaran:
        <strong>-</strong>
    `;
    /*
    |--------------------------------------------------------------------------
    | Jika hari atau guru belum dipilih
    |--------------------------------------------------------------------------
    */
    if (
        guruId === ''
        ||
        hari === ''
    ) {
        informasi.innerHTML = `
            <p class="info-awal">
                Pilih hari dan guru yang absen
                untuk melihat jadwal mengajarnya.
            </p>
        `;
        return;
    }
    /*
    |--------------------------------------------------------------------------
    | Loading
    |--------------------------------------------------------------------------
    */
    informasi.innerHTML = `
        <div class="loading-jadwal">
            ⏳ Mengambil jadwal guru...
        </div>
    `;
    /*
    |--------------------------------------------------------------------------
    | Ambil data dari get_jadwal_guru.php
    |--------------------------------------------------------------------------
    */
    fetch(
        'get_jadwal_guru.php'
        + '?guru_id='
        + encodeURIComponent(guruId)
        + '&hari='
        + encodeURIComponent(hari)
    )
    .then(
        function(response)
        {
            return response.json();
        }
    )
    .then(
        function(result)
        {
            /*
            |--------------------------------------------------------------------------
            | Cek status
            |--------------------------------------------------------------------------
            */
            if (
                result.status !== 'success'
            ) {
                informasi.innerHTML = `
                    <div class="info-error">
                        ${result.message}
                    </div>
                `;
                return;
            }
            /*
            |--------------------------------------------------------------------------
            | Simpan data
            |--------------------------------------------------------------------------
            */
            jadwalGuru =
                result.data;
            /*
            |--------------------------------------------------------------------------
            | Tidak ada jadwal
            |--------------------------------------------------------------------------
            */
            if (
                jadwalGuru.length === 0
            ) {
                informasi.innerHTML = `
                    <div class="info-kosong">
                        Guru tersebut tidak memiliki
                        jadwal mengajar pada hari
                        <strong>
                            ${hari}
                        </strong>.
                    </div>
                `;
                return;
            }
            /*
            |--------------------------------------------------------------------------
            | Buat tabel informasi
            |--------------------------------------------------------------------------
            */
            let html = `
                <div class="info-jadwal-absen">
                    <div class="judul-info">
                        📚 Jadwal Guru yang Absen
                    </div>
                    <p>
                        Klik salah satu jadwal
                        untuk memilih kelas
                        yang akan dicari
                        guru penggantinya.
                    </p>
                    <table
                        class="tabel-jadwal-absen"
                    >
                        <thead>
                            <tr>
                                <th>
                                    Jam Ke
                                </th>
                                <th>
                                    Kelas
                                </th>
                                <th>
                                    Mata Pelajaran
                                </th>
                            </tr>
                        </thead>
                        <tbody>
            `;
            /*
            |--------------------------------------------------------------------------
            | Isi tabel
            |--------------------------------------------------------------------------
            */
            jadwalGuru.forEach(
                function(jadwal)
                {
                    html += `
                        <tr
                            data-jadwal-id="
                                ${jadwal.jam_ke}
                                |
                                ${jadwal.kelas_id}
                                |
                                ${jadwal.mapel_id}
                            "
                            onclick="pilihJadwal(
                                '${jadwal.jam_ke}',
                                ${jadwal.kelas_id},
                                ${jadwal.mapel_id}
                            )"
                            style="cursor:pointer"
                        >
                            <td>
                                ${jadwal.jam_ke}
                            </td>
                            <td>
                                ${jadwal.nama_kelas}
                            </td>
                            <td>
                                ${jadwal.nama_mapel}
                            </td>
                        </tr>
                    `;
                }
            );
            html += `
                        </tbody>
                    </table>
                </div>
            `;
            informasi.innerHTML =
                html;
            /*
            |--------------------------------------------------------------------------
            | Isi dropdown kelas
            |--------------------------------------------------------------------------
            */
            kelasSelect.innerHTML = `
                <option value="">
                    - Pilih Kelas -
                </option>
            `;
            jadwalGuru.forEach(
                function(jadwal)
                {
                    const option =
                        document.createElement(
                            'option'
                        );
                    /*
                    |--------------------------------------------------------------------------
                    | PENTING
                    |--------------------------------------------------------------------------
                    |
                    | Value sekarang bukan hanya kelas_id.
                    |
                    | Contoh:
                    |
                    | 7-8|12|5
                    |
                    | Artinya:
                    |
                    | Jam     = 7-8
                    | Kelas   = 12
                    | Mapel   = 5
                    |
                    */
                    option.value =
                        jadwal.jam_ke
                        + '|'
                        + jadwal.kelas_id
                        + '|'
                        + jadwal.mapel_id;
                    option.textContent =
                        jadwal.jam_ke
                        + ' - '
                        + jadwal.nama_kelas
                        + ' - '
                        + jadwal.nama_mapel;
                    kelasSelect.appendChild(
                        option
                    );
                }
            );
            kelasSelect.disabled =
                false;
            /*
            |--------------------------------------------------------------------------
            | Jika halaman baru saja selesai POST
            |--------------------------------------------------------------------------
            |
            | Kembalikan pilihan sebelumnya.
            |--------------------------------------------------------------------------
            */
            if (
                jamTerpilihAwal !== ''
                &&
                parseInt(kelasTerpilihAwal) > 0
            ) {
                const jadwalAwal =
                    jadwalGuru.find(
                        function(item)
                        {
                            return String(
                                item.jam_ke
                            )
                            ===
                            String(
                                jamTerpilihAwal
                            )
                            &&
                            String(
                                item.kelas_id
                            )
                            ===
                            String(
                                kelasTerpilihAwal
                            );
                        }
                    );
                if (jadwalAwal) {
                    const nilaiAwal =
                        jadwalAwal.jam_ke
                        + '|'
                        + jadwalAwal.kelas_id
                        + '|'
                        + jadwalAwal.mapel_id;
                    kelasSelect.value =
                        nilaiAwal;
                    pilihKelas();
                }
            }
        }
    )
    .catch(
        function(error)
        {
            console.error(error);
            informasi.innerHTML = `
                <div class="info-error">
                    ❌ Terjadi kesalahan
                    saat mengambil jadwal guru.
                </div>
            `;
        }
    );
}
/*
|--------------------------------------------------------------------------
| Jika user klik baris tabel
|--------------------------------------------------------------------------
*/
function pilihJadwal(
    jamKe,
    kelasId,
    mapelId
)
{
    const kelasSelect =
        document.getElementById(
            'kelas_id_pilihan'
        );
    /*
    |--------------------------------------------------------------------------
    | Buat identitas jadwal
    |--------------------------------------------------------------------------
    */
    const nilai =
        jamKe
        + '|'
        + kelasId
        + '|'
        + mapelId;
    /*
    |--------------------------------------------------------------------------
    | Pilih dropdown
    |--------------------------------------------------------------------------
    */
    kelasSelect.value =
        nilai;
    /*
    |--------------------------------------------------------------------------
    | Jalankan proses pilihan
    |--------------------------------------------------------------------------
    */
    pilihKelas();
    /*
    |--------------------------------------------------------------------------
    | Tandai baris tabel yang dipilih
    |--------------------------------------------------------------------------
    */
    document
        .querySelectorAll(
            '.tabel-jadwal-absen tbody tr'
        )
        .forEach(
            function(row)
            {
                row.classList.remove(
                    'jadwal-terpilih'
                );
            }
        );
    /*
    |--------------------------------------------------------------------------
    | Cari baris yang sesuai
    |--------------------------------------------------------------------------
    */
    const rows =
        document.querySelectorAll(
            '.tabel-jadwal-absen tbody tr'
        );
    rows.forEach(
        function(row)
        {
            const data =
                row.getAttribute(
                    'data-jadwal-id'
                );
            if (
                data
                &&
                data.includes(
                    jamKe
                )
                &&
                data.includes(
                    String(kelasId)
                )
                &&
                data.includes(
                    String(mapelId)
                )
            ) {
                row.classList.add(
                    'jadwal-terpilih'
                );
            }
        }
    );
}
/*
|--------------------------------------------------------------------------
| Ketika dropdown jadwal berubah
|--------------------------------------------------------------------------
*/
function pilihKelas()
{
    const nilai =
        document.getElementById(
            'kelas_id_pilihan'
        ).value;
    const jamSelect =
        document.getElementById(
            'jam_ke_tampil'
        );
    const infoMapel =
        document.getElementById(
            'info-mapel'
        );
    const hiddenJam =
        document.getElementById(
            'jam_ke'
        );
    const hiddenKelas =
        document.getElementById(
            'kelas_id'
        );
    /*
    |--------------------------------------------------------------------------
    | Jika belum memilih
    |--------------------------------------------------------------------------
    */
    if (
        nilai === ''
    ) {
        jamSelect.innerHTML = `
            <option value="">
                - Jam otomatis -
            </option>
        `;
        jamSelect.disabled =
            true;
        hiddenJam.value =
            '';
        hiddenKelas.value =
            '';
        infoMapel.innerHTML = `
            Mata Pelajaran:
            <strong>-</strong>
        `;
        return;
    }
    /*
    |--------------------------------------------------------------------------
    | Pecah value
    |--------------------------------------------------------------------------
    |
    | Contoh:
    |
    | 7-8|12|5
    |
    */
    const bagian =
        nilai.split('|');
    const jamKe =
        bagian[0];
    const kelasId =
        bagian[1];
    const mapelId =
        bagian[2];
    /*
    |--------------------------------------------------------------------------
    | Cari jadwal berdasarkan ketiga identitas
    |--------------------------------------------------------------------------
    */
    const jadwal =
        jadwalGuru.find(
            function(item)
            {
                return String(
                    item.jam_ke
                )
                ===
                String(
                    jamKe
                )
                &&
                String(
                    item.kelas_id
                )
                ===
                String(
                    kelasId
                )
                &&
                String(
                    item.mapel_id
                )
                ===
                String(
                    mapelId
                );
            }
        );
    /*
    |--------------------------------------------------------------------------
    | Jika jadwal tidak ditemukan
    |--------------------------------------------------------------------------
    */
    if (!jadwal) {
        jamSelect.innerHTML = `
            <option value="">
                - Jam otomatis -
            </option>
        `;
        jamSelect.disabled =
            true;
        hiddenJam.value =
            '';
        hiddenKelas.value =
            '';
        infoMapel.innerHTML = `
            Mata Pelajaran:
            <strong>-</strong>
        `;
        return;
    }
    /*
    |--------------------------------------------------------------------------
    | Isi Jam Ke
    |--------------------------------------------------------------------------
    */
    jamSelect.innerHTML = `
        <option
            value="${jadwal.jam_ke}"
        >
            ${jadwal.jam_ke}
        </option>
    `;
    jamSelect.disabled =
        false;
    /*
    |--------------------------------------------------------------------------
    | Simpan jam sebenarnya
    |--------------------------------------------------------------------------
    */
    hiddenJam.value =
        jadwal.jam_ke;
    /*
    |--------------------------------------------------------------------------
    | Simpan kelas sebenarnya
    |--------------------------------------------------------------------------
    */
    hiddenKelas.value =
        jadwal.kelas_id;
    /*
    |--------------------------------------------------------------------------
    | Tampilkan mata pelajaran
    |--------------------------------------------------------------------------
    */
    infoMapel.innerHTML = `
        Mata Pelajaran:
        <strong>
            ${jadwal.nama_mapel}
        </strong>
    `;
}
/*
|--------------------------------------------------------------------------
| Ketika halaman selesai dimuat
|--------------------------------------------------------------------------
*/
document.addEventListener(
    'DOMContentLoaded',
    function()
    {
        const guruId =
            document.getElementById(
                'guru_id'
            ).value;
        const hari =
            document.getElementById(
                'hari'
            ).value;
        /*
        |--------------------------------------------------------------------------
        | Jika guru dan hari sudah ada
        |--------------------------------------------------------------------------
        */
        if (
            guruId !== ''
            &&
            hari !== ''
        ) {
            ambilJadwalGuru();
        }
    }
);
</script>
</body>
</html>