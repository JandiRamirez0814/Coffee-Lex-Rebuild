<?php
global $pdo, $URL;
include("../../config.php");

$id_carrito = $_POST["id_carrito"];

// Obtener el nro_venta asociado al carrito
$sentencia_nro = $pdo->prepare("SELECT nro_venta FROM tb_carrito WHERE id_carrito = :id_carrito");
$sentencia_nro->bindParam(':id_carrito', $id_carrito);
$sentencia_nro->execute();
$nro_venta = $sentencia_nro->fetchColumn();

// Eliminar registros dependientes de tb_ventas
if ($nro_venta) {
    $sentencia_ventas = $pdo->prepare("DELETE FROM tb_ventas WHERE nro_venta = :nro_venta");
    $sentencia_ventas->bindParam(':nro_venta', $nro_venta);
    $sentencia_ventas->execute();
}

// Eliminar el registro del carrito
$sentencia_carrito = $pdo->prepare("DELETE FROM tb_carrito WHERE id_carrito = :id_carrito");
$sentencia_carrito->bindParam(':id_carrito', $id_carrito);

if ($sentencia_carrito->execute()) {
    ?>
    <script>
        location.href = "http://localhost/Coffe_lex/www.sistemadeventas.com/ventas/create.php";
    </script>
    <?php
} else {
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/ventas/create.php";
    </script>
    <?php
}
?>
