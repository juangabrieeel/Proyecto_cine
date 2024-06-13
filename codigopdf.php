<?php
require_once('QR/FPDF/fpdf.php');
require_once('QR/PHPQRCode/qrlib.php');
session_start();

// Verificar si la sesion está iniciada
if (!isset($_SESSION['iniciada'])) {
    header("Location: index.php");
    exit;
}

// Iniciar la clase FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Información para el código QR
$asiento = $_GET["asiento"];
$cine = $_SESSION["cine"];
$nombreCliente = $_SESSION["nombreCliente"];

// Texto para el código QR
$qrText = "http://localhost/Cine/entrada.php?usuario=$nombreCliente&asiento=$asiento&cine=$cine";

// Generar el código QR en un archivo temporal
$qrFile = tempnam(sys_get_temp_dir(), 'qr');
QRcode::png($qrText, $qrFile, QR_ECLEVEL_L, 8);

// Insertar el código QR en el PDF
$pdf->Image($qrFile, 10, 10, 80, 0, 'PNG');

// Enviar el PDF al navegador
$pdf->Output();

// Eliminar el archivo temporal del código QR
unlink($qrFile);