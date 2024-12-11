<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

global $l;



// Include the main TCPDF library (search for installation path).
require_once('../app/TCPDF-main/tcpdf.php');

$id_venta_get = $_GET['id_venta'];
$nro_venta_get = $_GET['nro_venta'];
include ("../app/config.php");

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(210, 279), true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Coffe_Lex');
$pdf->setTitle('Factura de Venta');
$pdf->setSubject('Factura de Venta');
$pdf->setKeywords('Factura de Venta');

// Disable default header and footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->setMargins(15, 15, 15);
$pdf->SetAutoPageBreak(TRUE, 5);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Uncomment this section if you are using a language file (if available)
// if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//     require_once(dirname(__FILE__) . '/lang/eng.php');
//     $pdf->setLanguageArray($l);
// }

// Add a page to the PDF
$pdf->setFont('times', '', 12); // Times-Roman de tamaño 12

$pdf->AddPage();

// Create content
$html = '
<table border="0">
<tr>
    <td style="text-align: center;width: 200px">
    <img src="../public/images/logo.jpg" width="80px" alt=""><br>
        <b>Sistema de ventas Coffe Lex</b><br>
    Calle 32#33-69 Barrio: Victoria <br>
    3003327483 - 3017880215 <br>
    Tulua Valle <br>
    </td>
    <td style="width: 280px"></td>
        <td style="font-size: 16px;width: 150px" >
        <b>NIT:</b>1115182742 <br>
        <b>Nro Factura : </b>0001 <br>
        <b>Nro Oc : </b>875487521 <br>
    </td>
</tr>
</table>   

<p style="text-align: center;font-size: 25px"><b>FACTURA</b></p>
<div style="border: 1px solid #000000 ">
<table border="0" cellspacing="7" cellpadding="5"> 
<tr>
    <td><b>Fecha :</b>24/03/2024</td>
    <td></td>
    <td><b>Nit :</b>1115182742</td>
</tr>
<tr>
    <td colspan="3"><b>Cliente</b>Paula Lemus</td>
</tr>
</table>
</div>
<br>
<table border="1"  cellpadding="5" style="font-size: 10px">
<tr style="text-align: center;background-color: #c0c0c0">
    <th style="width: 40px">Nro</th>
    <th style="width: 120px">Detalle</th>
    <th style="width: 200px">Descripción</th>
    <th style="width: 70px">Cantidad</th>
    <th>Precio Unitario</th>
    <th>Sub Total</th>
</tr>
<tr>
    <td style="text-align: center">1</td>
    <td style="text-align: center">AGUARDIENTE</td>
    <td style="text-align: center">ANTIOQUEÑO TAPA AZUL</td>
    <td style="text-align: center">2</td>
    <td style="text-align: center">$ 45000</td>
    <td style="text-align: center">$ 90000</td>
</tr>
<tr>
    <td style="text-align: center">2</td>
    <td style="text-align: center">AGUARDIENTE</td>
    <td style="text-align: center">ANTIOQUEÑO TAPA AZUL</td>
    <td style="text-align: center">2</td>
    <td style="text-align: center">$ 45000</td>
    <td style="text-align: center">$ 90000</td>
</tr>
<tr style="background-color: #c0c0c0">
    <td colspan="3"style="text-align: right;"><b>Total</b></td>
    <td style="text-align: center">4</td>
    <td style="text-align: center">90000</td>
    <td style="text-align: center">180000</td>
</tr>
</table>

<p style="text-align: right">
    <b>Monto Total: </b> Es. 250
    </p>
    <p>
        <b>Son: </b> DOSCIENTOS CINCUENTA 00/100 $
    </p>
    <br>
    ------------------------------------------------------------------<br>
    <b>USUARIO</b> Paula lemus <br>
    
    <p style="text-align: center">"ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAIS, EL USO ILICITO DE ESTA SERA SANCIONADO DE ACUERDO A LA LEY"  
    </p>
    <p style="text-align: center">GRACIAS POR PREFERIRNOS</p>

';
$pdf->writeHTML($html, true, false, true, false, '');

// Style settings for the QR code
$style = array(
    'border' => 0,
    'vpadding' => '3',
    'hpadding' => '3',
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => false,
    'module_width' => 1,
    'module_height' => 1,
);

// Generate QR code
$QR = 'Factura';
$pdf->write2DBarcode($QR, 'QRCODE,L', 170, 240, 40,40, $style);

// Output the PDF
$pdf->Output('Factura de Venta.pdf', 'I');
?>
