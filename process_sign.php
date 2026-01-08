<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$nama = $_POST['nama'];
$dokumen = $_POST['dokumen'];
$signature_image = $_POST['signature_image'];
$timestamp = date("Y-m-d H:i:s");

// HASH
$dataHash = $nama . $dokumen . $timestamp;
$hash = hash("sha256", $dataHash);

// LOAD PRIVATE KEY
$privateKey = openssl_pkey_get_private(
    file_get_contents(__DIR__ . "/keys/private.pem")
);

// SIGN
openssl_sign($hash, $digitalSignature, $privateKey, OPENSSL_ALGO_SHA256);
$digitalSignature = base64_encode($digitalSignature);

// SIMPAN DATA
$save = [
    "nama" => $nama,
    "dokumen" => $dokumen,
    "hash" => $hash,
    "signature" => $digitalSignature,
    "timestamp" => $timestamp,
    "signature_image" => $signature_image
];

// Folder data
$dataDir = __DIR__ . "/data";
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0777, true);
}

file_put_contents($dataDir . "/signed_data.json", json_encode($save, JSON_PRETTY_PRINT));

// REDIRECT KE PDF
header("Location: generate_pdf.php");
exit;