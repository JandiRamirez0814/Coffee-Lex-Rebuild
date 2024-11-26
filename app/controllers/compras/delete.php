<?php
global $pdo, $URL;
include("../../config.php");

$id_compra = $_GET["id_compra"];
$id_producto = $_GET["id_producto"];
$cantidad_compra = $_GET["cantidad_compra"];
$stock_actual = $_GET["stock_actual"];


$pdo->beginTransaction();
// Preparar la sentencia SQL
$sentencia = $pdo->prepare("DELETE FROM tb_compras WHERE id_compra = :id_compra");

// Enlazar los parámetros
$sentencia->bindParam('id_compra', $id_compra);
//$sentencia->bindParam('id_producto', $id_producto);


// Ejecutar la consulta y manejar el resultado
if ($sentencia->execute()) {

    //actualiza el stock desde la compra
    $stock = $stock_actual - $cantidad_compra;
    $sentencia = $pdo->prepare("UPDATE tb_almacen SET stock = :stock WHERE id_producto = :id_producto");
    $sentencia->bindParam(':stock', $stock);
    $sentencia->bindParam(':id_producto', $id_producto);
    $sentencia->execute();

    $pdo->commit();

    session_start();
    $_SESSION["mensaje"] = "Se Elimino la compra correctamente";
    $_SESSION["icono"] = "success";
    $URL = "http://localhost/www.sistemadeventas.com";
    ?>
    <script>
        location.href = "http://localhost/Coffe_lex/www.sistemadeventas.com/compras";
    </script>
    <?php
} else {
    $pdo->rollback();

    session_start();
    $_SESSION["mensaje"] = "Error: no se pudo eliminar la compra";
    $_SESSION["icono"] = "error";
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/compras";
    </script>
    <?php
}


// Enlaza los parámetros

?>
