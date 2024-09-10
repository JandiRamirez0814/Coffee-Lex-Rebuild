<?php
global $pdo;
include('../../config.php');

$id_producto = $_POST['id_producto'];

// Prepara la consulta SQL
$sentencia = $pdo->prepare("DELETE FROM tb_almacen WHERE id_producto = :id_producto");

// Vincula el parámetro correctamente
$sentencia->bindParam(':id_producto', $id_producto);

// Ejecuta la consulta SQL
if ($sentencia->execute()) {
    session_start();
    $URL = "http://localhost/www.sistemadeventas.com";

    $_SESSION['mensaje'] = "Se elimino el producto de manera exitosa";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/almacen/');
} else {
    $URL = "http://localhost/www.sistemadeventas.com";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar el producto de manera exitosa";
    $_SESSION['icono'] = "error";

    header('Location: ' . $URL . '/almacen/delete.php?id=' . $id_producto);
}
?>
