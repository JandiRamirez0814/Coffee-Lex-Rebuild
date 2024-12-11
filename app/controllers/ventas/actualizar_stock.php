<?php
global $pdo, $URL;
include("../../config.php");

// Recoger los valores enviados por GET
$id_productos = $_GET["id_productos"];
$stock_calculado = $_GET["stock_calculado"];

// Asegúrate de que los valores recibidos son válidos
if (is_numeric($stock_calculado) && is_numeric($id_productos)) {

    // Preparar la sentencia SQL
    $sentencia = $pdo->prepare("UPDATE tb_almacen SET stock = :stock WHERE id_producto = :id_producto");

    // Enlazar los parámetros
    $sentencia->bindParam(':stock', $stock_calculado);
    $sentencia->bindParam(':id_producto', $id_productos);

    // Ejecutar la consulta y manejar el resultado
    if ($sentencia->execute()) {
        echo "ok, actualizado correctamente";
    } else {
        echo "error al actualizar stock";
    }

} else {
    echo "Datos inválidos recibidos";
}
?>
