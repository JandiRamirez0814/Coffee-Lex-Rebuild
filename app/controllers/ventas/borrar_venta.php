<?php
global $pdo, $URL;
include("../../config.php");

$id_venta = $_GET["id_venta"];
$nro_venta = $_GET["nro_venta"];
$pdo->beginTransaction();

// Obtener el nro_venta asociado al carrito

$sentencia = $pdo->prepare("DELETE FROM tb_ventas WHERE id_venta = :id_venta");
$sentencia->bindParam(':id_venta', $id_venta);



if ($sentencia->execute()) {
    $sentencia2 = $pdo->prepare("DELETE FROM tb_carrito WHERE nro_venta = :nro_venta");
    $sentencia2->bindParam(':nro_venta', $nro_venta);
    $sentencia2->execute();
    $pdo->commit();
    session_start();
    $_SESSION["mensaje"] = "Se borro la venta correctamente";
    $_SESSION["icono"] = "success";
    ?>
    <script>
        location.href = "http://localhost/Coffe_lex/www.sistemadeventas.com/ventas";
    </script>
    <?php
} else {
    ?>
    <script>
        location.href = "http://localhost/Coffe_lex/www.sistemadeventas.com/ventas";
    </script>
    <?php


    echo "Error al eliminar la venta";
    session_start();
    $_SESSION["mensaje"] = "Error: no se borraron los datos";
    $_SESSION["icono"] = "error";
    $pdo->rollBack();
}
?>