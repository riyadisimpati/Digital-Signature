<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Dokumen PDF</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .box {
            border: 1px solid #ccc;
            padding: 15px;
            max-width: 500px;
        }
        button {
            padding: 8px 15px;
        }
    </style>
</head>
<body>

<h2>🔍 Verifikasi Dokumen PDF</h2>

<div class="box">

<?php
// JIKA FORM DIKIRIM
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_FILES['pdf']) || $_FILES['pdf']['error'] !== 0) {
        echo "<p style='color:red'>❌ File PDF tidak valid</p>";
    } else {

        // Ambil hash PDF asli
        $data = json_decode(file_get_contents("data/pdf_hash.json"), true);

        $uploadedPdf = $_FILES['pdf']['tmp_name'];
        $uploadedHash = hash_file("sha256", $uploadedPdf);

        echo "<p><b>Hash PDF Upload:</b><br><small>$uploadedHash</small></p>";
        echo "<p><b>Hash PDF Asli:</b><br><small>{$data['hash']}</small></p>";

        if ($uploadedHash === $data['hash']) {
            echo "<h3 style='color:green'>✔ PDF ASLI & TIDAK DIUBAH</h3>";
        } else {
            echo "<h3 style='color:red'>❌ PDF PALSU / SUDAH DIEDIT</h3>";
        }
    }

    echo "<hr>";
}
?>

<!-- FORM UPLOAD PDF -->
<form method="POST" enctype="multipart/form-data">
    <label>Pilih file PDF:</label><br><br>
    <input type="file" name="pdf" accept="application/pdf" required>
    <br><br>
    <button type="submit">🔍 Verifikasi PDF</button>
</form>

</div>

</body>
</html>
