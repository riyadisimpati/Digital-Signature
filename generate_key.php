<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// SET PATH CONFIG OPENSSL (WAJIB DI WINDOWS)
$opensslConfigPath = "C:/xampp/php/extras/openssl/openssl.cnf";

$config = [
    "config" => $opensslConfigPath,
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
];

$res = openssl_pkey_new($config);

if ($res === false) {
    die("GAGAL MEMBUAT KEY OPENSSL");
}

openssl_pkey_export($res, $privateKey, null, ["config" => $opensslConfigPath]);
$keyDetails = openssl_pkey_get_details($res);
$publicKey = $keyDetails["key"];

if (!is_dir("keys")) {
    mkdir("keys", 0777, true);
}

file_put_contents("keys/private.pem", $privateKey);
file_put_contents("keys/public.pem", $publicKey);

echo "✅ KEY BERHASIL DIBUAT";
