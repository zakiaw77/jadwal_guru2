<?php
include 'config.php';
/*
|--------------------------------------------------------------------------
| Ambil ID pengganti
|--------------------------------------------------------------------------
*/
$id = isset($_GET['id_pengganti'])
    ? intval($_GET['id_pengganti'])
    : 0;
if (!$id) {
    die("ID tidak valid.");
}
/*
|--------------------------------------------------------------------------
| Ambil data dari database
|--------------------------------------------------------------------------
*/
$query = mysqli_query(
    $koneksi,
    "SELECT
        p.*,
        g1.nama AS nama_absen,
        g1.nbm AS nbm_absen,
        g2.nama AS nama_pengganti,
        g2.nbm AS nbm_pengganti,
        k.nama_kelas
    FROM pengganti p
    JOIN guru g1
        ON p.guru_absen_id = g1.id
    JOIN guru g2
        ON p.guru_pengganti_id = g2.id
    JOIN kelas k
        ON p.kelas_id = k.id
    WHERE p.id = $id"
);
$data = mysqli_fetch_assoc($query);
if (!$data) {
    die("Data tidak ditemukan.");
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
<title>
    Surat Tugas Guru Pengganti
</title>
<!-- =========================================================
     HTML2CANVAS
     Digunakan untuk membuat kartu menjadi gambar PNG
========================================================= -->
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js">
</script>
<style>
/*
|--------------------------------------------------------------------------
| BODY
|--------------------------------------------------------------------------
*/
body {
    font-family: Arial, sans-serif;
    background: #f5f5f5;
    margin: 0;
    padding: 30px;
}
/*
|--------------------------------------------------------------------------
| KARTU SURAT
|--------------------------------------------------------------------------
*/
#kartuPengganti {
    width: 700px;
    max-width: 100%;
    box-sizing: border-box;
    background: white;
    padding: 40px;
    margin: 0 auto;
    border: 1px solid #aaa;
}
/*
|--------------------------------------------------------------------------
| JUDUL
|--------------------------------------------------------------------------
*/
#kartuPengganti h2 {
    text-align: center;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 5px;
}
/*
|--------------------------------------------------------------------------
| SUBJUDUL
|--------------------------------------------------------------------------
*/
#kartuPengganti h3 {
    text-align: center;
    margin-top: 10px;
    margin-bottom: 15px;
}
/*
|--------------------------------------------------------------------------
| GARIS
|--------------------------------------------------------------------------
*/
#kartuPengganti hr {
    border: none;
    border-top: 2px solid #000;
    margin: 10px 0 20px;
}
/*
|--------------------------------------------------------------------------
| PARAGRAF
|--------------------------------------------------------------------------
*/
#kartuPengganti p {
    font-size: 16px;
    line-height: 1.45;
}
/*
|--------------------------------------------------------------------------
| TOMBOL
|--------------------------------------------------------------------------
*/
.tombol-container {
    width: 700px;
    max-width: 100%;
    margin: 15px auto 0;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
/*
|--------------------------------------------------------------------------
| SEMUA TOMBOL
|--------------------------------------------------------------------------
*/
.tombol-container button {
    width: 100%;
    padding: 13px;
    border: none;
    border-radius: 5px;
    color: white;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
}
/*
|--------------------------------------------------------------------------
| TOMBOL SCREENSHOT
|--------------------------------------------------------------------------
*/
.btn-screenshot {
    background: #ff9800;
}
.btn-screenshot:hover {
    background: #e68900;
}
/*
|--------------------------------------------------------------------------
| TOMBOL COPY WHATSAPP
|--------------------------------------------------------------------------
*/
.btn-whatsapp {
    background: #25D366;
}
.btn-whatsapp:hover {
    background: #1da851;
}
/*
|--------------------------------------------------------------------------
| NAVIGASI
|--------------------------------------------------------------------------
*/
.navigasi {
    width: 700px;
    max-width: 100%;
    margin: 20px auto;
    text-align: center;
}
.navigasi a {
    margin: 0 8px;
}
/*
|--------------------------------------------------------------------------
| PESAN
|--------------------------------------------------------------------------
*/
#pesan {
    width: 700px;
    max-width: 100%;
    margin: 10px auto;
    text-align: center;
    font-weight: bold;
}
/*
|--------------------------------------------------------------------------
| RESPONSIVE HP
|--------------------------------------------------------------------------
*/
@media (max-width: 750px) {
    body {
        padding: 10px;
    }
    #kartuPengganti {
        padding: 20px;
    }
}
</style>
</head>
<body>
<!-- =========================================================
     KARTU / SURAT YANG AKAN DI SCREENSHOT
========================================================= -->
<div id="kartuPengganti">
    <h2>
        Sekolah Dasar Muhammadiyah Manyar
    </h2>
    <h3>
        Surat Tugas Guru Pengganti
    </h3>
    <hr>
    <p>
        Yang bertanda tangan di bawah ini:
    </p>
    <p>
        Nama : Kepala Sekolah
        <br>
        Jabatan : Kepala Sekolah
    </p>
    <p>
        Memberikan tugas kepada:
    </p>
    <p>
        Nama :
        <?= htmlspecialchars($data['nama_pengganti']) ?>
        <br>
        NBM :
        <?= htmlspecialchars($data['nbm_pengganti']) ?>
    </p>
    <p>
        Untuk menggantikan:
    </p>
    <p>
        Nama :
        <?= htmlspecialchars($data['nama_absen']) ?>
        <br>
        NBM :
        <?= htmlspecialchars($data['nbm_absen']) ?>
    </p>
    <p>
        Pada hari
        <strong>
            <?= htmlspecialchars($data['hari']) ?>
        </strong>
        , Jam ke-
        <strong>
            <?= htmlspecialchars($data['jam_ke']) ?>
        </strong>
        , tanggal
        <strong>
            <?= date(
                'd-m-Y',
                strtotime($data['tanggal'])
            ) ?>
        </strong>
    </p>
    <p>
        Dengan mengajar di kelas
        <strong>
            <?= htmlspecialchars($data['nama_kelas']) ?>
        </strong>
        dan menyampaikan materi:
        <strong>
            <?= htmlspecialchars($data['materi']) ?>
        </strong>
    </p>
    <br>
    <br>
    <p>
        Demikian surat tugas ini dibuat untuk
        digunakan sebagaimana mestinya.
    </p>
    <p style="text-align: right;">
        Gresik,
        <?= date(
            'd-m-Y',
            strtotime($data['tanggal'])
        ) ?>
    </p>
    <br>
    <br>
    <br>
    <p style="text-align: right;">
        ( ___________________ )
    </p>
</div>
<!-- =========================================================
     PESAN STATUS
========================================================= -->
<div id="pesan"></div>
<!-- =========================================================
     TOMBOL
========================================================= -->
<div class="tombol-container">
    <button
        type="button"
        class="btn-screenshot"
        onclick="ambilScreenshot()"
    >
        📸 Screen Shot Kartu
    </button>
    <button
        type="button"
        class="btn-whatsapp"
        onclick="salinKeWhatsApp()"
    >
        📋 Salin Kartu untuk WhatsApp
    </button>
</div>
<!-- =========================================================
     NAVIGASI
========================================================= -->
<div class="navigasi">
    <a href="index.php">
        Home
    </a>
    |
    <a href="list_pengganti.php">
        List Pengganti
    </a>
    |
    <a href="cari_pengganti.php">
        Cari Pengganti Lain
    </a>
</div>
<script>
/*
|--------------------------------------------------------------------------
| Fungsi membuat Canvas
|--------------------------------------------------------------------------
*/
function buatCanvas() {
    const kartu =
        document.getElementById(
            'kartuPengganti'
        );
    return html2canvas(
        kartu,
        {
            scale: 2,
            backgroundColor: '#ffffff',
            useCORS: true,
            logging: false
        }
    );
}
/*
|--------------------------------------------------------------------------
| SCREENSHOT / DOWNLOAD PNG
|--------------------------------------------------------------------------
*/
function ambilScreenshot() {
    const pesan =
        document.getElementById(
            'pesan'
        );
    pesan.innerHTML =
        '⏳ Sedang membuat gambar kartu...';
    buatCanvas()
        .then(
            function(canvas) {
                const link =
                    document.createElement('a');
                link.download =
                    'kartu_guru_pengganti.png';
                link.href =
                    canvas.toDataURL(
                        'image/png'
                    );
                link.click();
                pesan.innerHTML =
                    '✅ Kartu berhasil dibuat sebagai gambar PNG.';
            }
        )
        .catch(
            function(error) {
                console.error(error);
                pesan.innerHTML =
                    '❌ Gagal membuat screenshot.';
            }
        );
}
/*
|--------------------------------------------------------------------------
| SALIN GAMBAR KE CLIPBOARD
|--------------------------------------------------------------------------
*/
async function salinKeWhatsApp() {
    const pesan =
        document.getElementById(
            'pesan'
        );
    pesan.innerHTML =
        '⏳ Menyiapkan kartu untuk WhatsApp...';
    try {
        const canvas =
            await buatCanvas();
        canvas.toBlob(
            async function(blob) {
                try {
                    const item =
                        new ClipboardItem({
                            'image/png': blob
                        });
                    await navigator.clipboard.write([
                        item
                    ]);
                    pesan.innerHTML =
                        '✅ Kartu berhasil disalin. ' +
                        'Sekarang buka WhatsApp lalu tekan Ctrl + V.';
                }
                catch (error) {
                    console.error(error);
                    pesan.innerHTML =
                        '⚠️ Browser tidak mengizinkan ' +
                        'penyalinan gambar. ' +
                        'Silakan gunakan tombol Screen Shot.';
                }
            },
            'image/png'
        );
    }
    catch (error) {
        console.error(error);
        pesan.innerHTML =
            '❌ Gagal membuat gambar kartu.';
    }
}
</script>
</body>
</html>