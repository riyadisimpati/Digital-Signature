<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ==========================
    // LOAD DATA ASLI
    // ==========================
    $data = json_decode(file_get_contents("data/signed_data.json"), true);
    $hashAsli = $data['hash'];
    $signature = base64_decode($data['signature']);

    // ==========================
    // AMBIL FILE PDF
    // ==========================
    $pdfTmp = $_FILES['pdf']['tmp_name'];
    $hashPdf = hash_file('sha256', $pdfTmp);

    // ==========================
    // LOAD PUBLIC KEY
    // ==========================
    $publicKey = openssl_pkey_get_public(
        file_get_contents("keys/public.pem")
    );

    // ==========================
    // VERIFIKASI
    // ==========================
    $hashMatch = ($hashPdf === $hashAsli);
    $verifySign = openssl_verify(
        $hashPdf,
        $signature,
        $publicKey,
        OPENSSL_ALGO_SHA256
    );

    echo "<h2>Hasil Verifikasi Dokumen</h2>";

    if ($hashMatch && $verifySign === 1) {
        echo "<b style='color:green'>✔ DOKUMEN ASLI & TIDAK DIUBAH</b>";
    } else {
        echo "<b style='color:red'>✖ DOKUMEN TIDAK VALID / TELAH DIMODIFIKASI</b>";
    }

    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Dokumen PDF</title>
</head>
<body>

<h2>Upload PDF untuk Verifikasi</h2>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="pdf" accept="application/pdf" required>
    <br><br>
    <button type="submit">Verifikasi PDF</button>
</form>

</body>
</html>

