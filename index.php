<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Digital Signature & Kriptografi</title>

    <!-- WAJIB untuk Android -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 15px;
            overscroll-behavior: none;
            background: #f9f9f9;
        }

        h1, h2, h3 {
            color: #333;
        }

        .box {
            background: #fff;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 6px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }

        canvas {
            border: 1px solid #000;
            background: #fff;
            display: block;
            width: 100%;
            max-width: 360px;
            height: 180px;
            touch-action: none;
            user-select: none;
        }

        button, .btn {
            padding: 10px 15px;
            margin-top: 10px;
            cursor: pointer;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            background: #007bff;
            color: #fff;
            border-radius: 4px;
        }

        .btn:hover {
            background: #0056b3;
        }

        hr {
            margin: 30px 0;
        }

        ul, ol {
            margin-left: 20px;
        }
    </style>
</head>
<body>

<h1>🔐 Digital Signature Berbasis Kriptografi</h1>

<!-- ===================== MENU ===================== -->
<div class="box">
    <h2>📌 Menu Utama</h2>

    <a href="#praktik" class="btn">✍️ Buat Tanda Tangan Digital</a>
    <br><br>
    <a href="verify_pdf.php" class="btn">🔍 Verifikasi PDF (Upload)</a>
</div>

<hr>

<!-- ===================== MATERI ===================== -->
<div class="box">
    <h2>📘 Materi Kriptografi</h2>

    <h3>1️⃣ Kriptografi Asimetris</h3>
    <p>
        Kriptografi asimetris adalah metode pengamanan data yang menggunakan
        <b>dua kunci berbeda</b>:
    </p>
    <ul>
        <li>🔑 <b>Private Key</b> → digunakan untuk <b>menandatangani dokumen</b></li>
        <li>🔓 <b>Public Key</b> → digunakan untuk <b>verifikasi keaslian</b></li>
    </ul>
    <p>
        Pada sistem ini, <b>private key hanya disimpan di server</b> dan tidak
        pernah dibagikan ke pengguna. Hal ini mencegah pemalsuan tanda tangan digital.
    </p>

    <h3>2️⃣ Hashing (SHA-256)</h3>
    <p>
        Hashing adalah proses mengubah data menjadi <b>sidik jari digital</b>
        menggunakan algoritma <b>SHA-256</b>.
    </p>
    <ul>
        <li>Panjang hash selalu tetap</li>
        <li>Perubahan 1 karakter → hash berubah total</li>
        <li>Hash tidak bisa dikembalikan ke data asli</li>
    </ul>
    <p>
        Hash digunakan untuk mendeteksi apakah isi dokumen
        <b>pernah diubah atau tidak</b>.
    </p>

    <h3>3️⃣ Digital Signature</h3>
    <p>Digital Signature dibuat melalui tahapan berikut:</p>
    <ol>
        <li>Isi dokumen di-hash menggunakan SHA-256</li>
        <li>Hash dienkripsi menggunakan <b>Private Key</b></li>
        <li>Hasil enkripsi disebut <b>Digital Signature</b></li>
    </ol>
    <p>
        Digital Signature <b>bukan gambar tanda tangan</b>,
        melainkan bukti kriptografi yang sah secara sistem.
    </p>

    <h3>4️⃣ Verifikasi Dokumen</h3>
    <p>
        Verifikasi dilakukan menggunakan <b>Public Key</b>.
        Sistem akan:
    </p>
    <ol>
        <li>Menghitung ulang hash dokumen</li>
        <li>Membandingkan dengan Digital Signature</li>
        <li>Menentukan status dokumen</li>
    </ol>
    <p>
        Hasil verifikasi:
        <br>✔ <b>VALID</b> → Dokumen asli & tidak diubah
        <br>❌ <b>INVALID</b> → Dokumen telah diubah / palsu
    </p>

    <h3>5️⃣ PDF dalam Sistem Ini</h3>
    <p>
        File PDF berfungsi sebagai <b>media tampilan</b>.
        Keamanan dokumen <b>bukan berasal dari PDF</b>,
        melainkan dari:
    </p>
    <ul>
        <li>Hash SHA-256</li>
        <li>Digital Signature</li>
        <li>Kriptografi Asimetris</li>
        <li>Verifikasi melalui sistem</li>
    </ul>
    <p>
        PDF dapat di-download dan diedit secara visual,
        tetapi <b>keasliannya tidak dapat dipalsukan</b>
        karena akan gagal saat diverifikasi.
    </p>
</div>

<hr>

<!-- ===================== PRAKTIK ===================== -->
<div class="box" id="praktik">
    <h2>✍️ Praktik Digital Signature</h2>

    <form method="POST" action="process_sign.php" onsubmit="return saveSignature();">

        <label>Nama:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Isi Dokumen:</label><br>
        <textarea name="dokumen" rows="5" cols="40" required></textarea><br><br>

        <label>Tanda Tangan (gunakan jari / mouse):</label><br><br>

        <canvas id="signature" width="360" height="180"></canvas>

        <button type="button" onclick="clearCanvas()">Hapus</button><br><br>

        <!-- hasil canvas -->
        <input type="hidden" name="signature_image" id="signature_image">

        <button type="submit">✅ Tanda Tangani & Buat PDF</button>
    </form>
</div>

<script src="assets/signature.js?v=3"></script>

</body>
</html>
