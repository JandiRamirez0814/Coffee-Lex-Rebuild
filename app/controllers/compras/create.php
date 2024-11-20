<?php
global $pdo, $URL;
include("../../config.php");

// Recoger los valores enviados por GET
$id_producto = $_GET["id_producto"];
$nro_compra = $_GET["nro_compra"];
$fecha_compra = $_GET["fecha_compra"];
$id_proveedor = $_GET["id_proveedor"];
$comprobante = $_GET["comprobante"];
$id_usuario = $_GET["id_usuario"];
$precio_compra = $_GET["valor_compra"];
$cantidad = $_GET["cantidad_compra"];
$Stock_total = $_GET["Stock_total"];
$fechaHora = date('Y-m-d H:i:s'); // Establecer fecha y hora actual

$pdo->beginTransaction();
// Preparar la sentencia SQL
$sentencia = $pdo->prepare("INSERT INTO tb_compras
        (id_producto, nro_compra, fecha_compra, id_proveedor, comprobante, id_usuario, precio_compra, cantidad, fyh_creacion)
    VALUES (:id_producto, :nro_compra, :fecha_compra, :id_proveedor, :comprobante, :id_usuario, :precio_compra, :cantidad, :fyh_creacion)");

// Enlazar los parámetros
$sentencia->bindParam(':id_producto', $id_producto);
$sentencia->bindParam(':nro_compra', $nro_compra);
$sentencia->bindParam(':fecha_compra', $fecha_compra);
$sentencia->bindParam(':id_proveedor', $id_proveedor);
$sentencia->bindParam(':comprobante', $comprobante);
$sentencia->bindParam(':id_usuario', $id_usuario);
$sentencia->bindParam(':precio_compra', $precio_compra);
$sentencia->bindParam(':cantidad', $cantidad);
$sentencia->bindParam(':fyh_creacion', $fechaHora);

// Ejecutar la consulta y manejar el resultado
if ($sentencia->execute()) {

    //actualiza el stock desde la compra
    $sentencia = $pdo->prepare("UPDATE tb_almacen
    SET stock = :stock
    WHERE id_producto = :id_producto");
    $sentencia->bindParam(':stock', $Stock_total);
    $sentencia->bindParam(':id_producto', $id_producto);
    $sentencia->execute();

    $pdo->commit();

    session_start();
    $_SESSION["mensaje"] = "Se registró la compra correctamente";
    $_SESSION["icono"] = "success";
    $URL = "http://localhost/www.sistemadeventas.com";
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/compras";
    </script>
    <?php
} else {
    $pdo->rollback();

    session_start();
    $_SESSION["mensaje"] = "Error: no se pudo registrar la compra";
    $_SESSION["icono"] = "error";
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/compras/create.php";
    </script>
    <?php
}


// Enlaza los parámetros

?>
