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
global $pdo;
include ("../app/config.php");
session_start();
global $URL;

if(isset($_SESSION['sesion_email'])){
    //echo "Sesión iniciada para " . $_SESSION['sesion_email'];
    $email_sesion = $_SESSION['sesion_email'];
    $sql = "SELECT us.id_usuario as id_usuario, us.nombres as nombres, us.email as email, rol.rol as rol 
                FROM tb_usuarios AS us INNER JOIN tb_roles as rol ON us.id_rol= rol.id_rol WHERE email= '$email_sesion'";
    $squery = $pdo->prepare($sql);
    $squery->execute(); // Aquí corregido
    $usuarios = $squery->fetchAll(PDO::FETCH_ASSOC);
    foreach ($usuarios as $usuario){
        $id_usuario_sesion = $usuario['id_usuario'];
        $nombres_sesion = $usuario['nombres'];
        $rol_sesion = $usuario['rol'];
    }
} else {
    echo "No hay sesión iniciada.";
    header('Location: '.$URL.'/login');

}

include ("../app/controllers/ventas/literal.php");

global $l, $pdo;
// Include the main TCPDF library (search for installation path).
require_once('../app/TCPDF-main/tcpdf.php');

$id_venta_get = $_GET['id_venta'];
$nro_venta_get = $_GET['nro_venta'];

$sql_ventas = "SELECT *, cli.nombre_cliente as nombre_cliente, cli.nit_ci_cliente as nit_ci_cliente,
                cli.nombre_cliente as nombre_cliente
                FROM tb_ventas as ve INNER JOIN tb_clientes as cli ON cli.id_cliente = ve.id_cliente
                WHERE ve.id_venta = '$id_venta_get'";

$squery_ventas = $pdo->prepare($sql_ventas);
$squery_ventas->execute(); // Aquí corregido
$ventas_datos = $squery_ventas->fetchAll(PDO::FETCH_ASSOC);

foreach ($ventas_datos as $ventas_dato) {
    $fyh_creacion=$ventas_dato['fyh_creacion'];
    $nit_ci_cliente=$ventas_dato['nit_ci_cliente'];
    $nombre_cliente=$ventas_dato['nombre_cliente'];
    $total_pagado=$ventas_dato['total_pagado'];
}
$fecha = date("d-m-Y", strtotime($fyh_creacion));
$monto_literal = convertir_a_literal($total_pagado);



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
$pdf->Image('../public/images/carrito.jpg', 10, 5, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

// Create content
$html = '
<table border="0">
<tr>
    <td style="text-align: center;width: 200px">
        <b>Sistema de ventas Coffe Lex</b><br>
    Calle 32#33-69 Barrio: Victoria <br>
    3003327483 - 3017880215 <br>
    Tulua Valle <br>
    </td>
    <td style="width: 240px"></td>
        <td style="font-size: 16px;width: 150px" >
        <b>NIT:</b>1115182742 <br>
        <b>Nro Factura : </b>'.$id_venta_get.' <br>
        <b>Nro Oc : </b>875487521 <br>
        <p style="text-align: center"><b>ORIGINAL</b></p>
        
    </td>
</tr>
</table>   

<p style="text-align: left;font-size: 25px"><b>FACTURA</b></p>
<div style="border: 1px solid #000000 ">
<table border="0" cellspacing="7" cellpadding="5"> 
<tr>
    <td><b>Fecha :</b>'.$fecha.'</td>
    <td></td>
    <td><b>Nit :</b> '.$nit_ci_cliente.'</td>
</tr>
<tr>
    <td colspan="3"><b>Cliente : </b>'.$nombre_cliente.'</td>
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
';
$contador_de_carrito = 0;
$cantidad_total = 0;
$precio_unitario_total = 0;
$precio_total = 0;
$sql_carrito = "SELECT *, pro.nombre as nombre_producto, pro.descripcion as descripcion,
                                    pro.precio_venta as precio_venta, pro.stock as stock, pro.id_producto as id_productos
                                    FROM tb_carrito AS carr INNER JOIN tb_almacen as pro ON carr.id_producto = pro.id_producto
                                    WHERE nro_venta = '$nro_venta_get' ORDER BY id_carrito ASC";
$squery_carrito = $pdo->prepare($sql_carrito);
$squery_carrito->execute(); // Aquí corregido
$carrito_datos = $squery_carrito->fetchAll(PDO::FETCH_ASSOC);
foreach ($carrito_datos as $carrito_dato) {
    $id_carrito = $carrito_dato['id_carrito'];
    $contador_de_carrito += 1;
    $cantidad_total = $cantidad_total + $carrito_dato['cantidad'];
    $precio_unitario_total += floatval($carrito_dato['precio_venta']);
    $subtotal = $carrito_dato['cantidad'] * $carrito_dato['precio_venta'];
    $precio_total = $precio_total + $subtotal;



    $html .= '
    <tr>
    <td style="text-align: center">'.$contador_de_carrito.'</td>
    <td>'.$carrito_dato['nombre_producto'].'</td>
    <td style="text-align: center">'.$carrito_dato['descripcion'].'</td>
    <td style="text-align: center">'.$carrito_dato['cantidad'].'</td>
    <td style="text-align: center"> $ '.$carrito_dato['precio_venta'].'</td>
    <td style="text-align: center">$ '.$subtotal .'</td>
</tr>
    
';
}

$html.='


<tr style="background-color: #c0c0c0">
    <td colspan="3"style="text-align: right;"><b>Total</b></td>
    <td style="text-align: center">'.$cantidad_total.'</td>
    <td style="text-align: center">$ '.$precio_unitario_total.'</td>
    <td style="text-align: center">$ '.$precio_total.'</td>
</tr>
</table>

<p style="text-align: right">
    <b>Monto Total: </b> Es. $ '.$precio_total.'
    </p>
    <p>
    <b>Son: </b> '.$monto_literal.' 
    </p>

    <br>
    ------------------------------------------------------------------<br>
    <b>USUARIO : </b> '.$nombres_sesion.' <br>
    
    <p>
    <table style="width: 100%;" border="0">
        <tr>
            <td style="text-align: center;">
                "ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAIS, EL USO ILICITO DE ESTA SERA SANCIONADO DE ACUERDO A LA LEY"
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                GRACIAS POR PREFERIRNOS
            </td>
        </tr>
    </table>
</p>


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
$QR = 'Factura realizada por el sistema de ventas Coffe Lex al cliente '.$nombre_cliente.' con nit '.$nit_ci_cliente.' el dia : '.$fecha.' con el monto de : '.$precio_total.'';
$pdf->write2DBarcode($QR, 'QRCODE,L', 170, 240, 40,40, $style);

// Output the PDF
$pdf->Output('Factura de Venta.pdf', 'I');
?>
