<?php
require('fpdf/fpdf.php');
require('phpqrcode/qrlib.php');

$data = json_decode(file_get_contents("data/signed_data.json"), true);

$pdfDir = __DIR__ . "/pdf";
$dataDir = __DIR__ . "/data";

if (!is_dir($pdfDir)) mkdir($pdfDir, 0777, true);
if (!is_dir($dataDir)) mkdir($dataDir, 0777, true);

// Simpan tanda tangan
$img = base64_decode(str_replace('data:image/png;base64,', '', $data['signature_image']));
file_put_contents("$pdfDir/signature.png", $img);

// QR Code (hanya URL verifikasi)
$verifyUrl = "https://riyadisimpati.web.id/verify_pdf.php";
QRcode::png($verifyUrl, "$pdfDir/qr.png", QR_ECLEVEL_L, 4);

// Buat PDF
$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'DOKUMEN BERTANDA TANGAN DIGITAL',0,1,'C');
$pdf->Ln(5);

$pdf->SetFont('Arial','',11);
$pdf->MultiCell(0,8,"Nama:\n".$data['nama']);
$pdf->Ln(2);
$pdf->MultiCell(0,8,"Isi Dokumen:\n".$data['dokumen']);
$pdf->Ln(5);

$pdf->Cell(0,8,'Tanda Tangan:',0,1);
$pdf->Image("$pdfDir/signature.png",10,$pdf->GetY(),60);
$pdf->Ln(45);

$pdf->SetFont('Arial','I',9);
$pdf->MultiCell(0,6,"Hash Dokumen:\n".$data['hash']);
$pdf->Ln(2);
$pdf->MultiCell(0,6,"Digital Signature:\n".$data['signature']);
$pdf->Ln(3);
$pdf->Cell(0,6,'Scan QR Code untuk verifikasi dokumen:',0,1);
$pdf->Image("$pdfDir/qr.png",10,$pdf->GetY(),35);

// Simpan PDF
$fileName = "dokumen_ttd_" . time() . ".pdf";
$filePath = "$pdfDir/$fileName";
$pdf->Output("F", $filePath);

// ================================
// SIMPAN HASH PDF ASLI
// ================================
$pdfHash = hash_file("sha256", $filePath);
file_put_contents(
    "$dataDir/pdf_hash.json",
    json_encode([
        "file" => $fileName,
        "hash" => $pdfHash
    ], JSON_PRETTY_PRINT)
);

// Output
echo "<h3>âœ… PDF Berhasil Dibuat</h3>";
echo "<a href='pdf/$fileName' download>ðŸ“„ Download PDF</a>";
