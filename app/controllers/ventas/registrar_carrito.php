<?php
global $pdo, $URL;
include("../../config.php");

// Recoger los valores enviados por GET
$nro_venta = $_GET["nro_venta"];
$id_producto = $_GET["id_producto"];
$cantidad = $_GET["cantidad"];

$fechaHora = date('Y-m-d H:i:s'); // Establecer fecha y hora actual

// Preparar la sentencia SQL
$sentencia = $pdo->prepare("INSERT INTO tb_carrito
        (nro_venta, id_producto, cantidad, fyh_creacion)
    VALUES (:nro_venta, :id_producto, :cantidad, :fyh_creacion)");

// Enlazar los parámetros
$sentencia->bindParam(':nro_venta', $nro_venta);
$sentencia->bindParam(':id_producto', $id_producto);
$sentencia->bindParam(':cantidad', $cantidad);
$sentencia->bindParam(':fyh_creacion', $fechaHora);

// Ejecutar la consulta y manejar el resultado
if ($sentencia->execute()) {
    //actualiza el stock desde la compra
    ?>
    <script>
        location.href = "http://localhost/Coffe_lex/www.sistemadeventas.com/ventas/create.php";
    </script>
    <?php
} else {
    session_start();
    $_SESSION["mensaje"] = "Error: no se pudo registrar la compra";
    $_SESSION["icono"] = "error";
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/ventas/create.php";
    </script>
    <?php
}
?>
