<?php
global $pdo, $URL;
include('../../config.php');

$id_proveedor = $_GET['id_proveedor'];

// Prepara la consulta SQL
$sentencia = $pdo->prepare("DELETE FROM tb_proveedores WHERE id_proveedor = :id_proveedor");

// Vincula el parámetro correctamente
$sentencia->bindParam(':id_proveedor', $id_proveedor);

// Ejecuta la consulta SQL
if($sentencia->execute()) {
    session_start();
    $_SESSION["mensaje"] = "Se eliminó el proveedor correctamente";
    $_SESSION["icono"] = "success";
    $URL = "http://localhost/www.sistemadeventas.com";
    ?>
    <script>
        location.href = "<?php echo $URL;?>/proveedores";
    </script>
    <?php
} else {
    session_start();
    $_SESSION["mensaje"] = "Error: no se pudo eliminar el proveedor correctamente";
    $_SESSION["icono"] = "error";
    $URL = "http://localhost/www.sistemadeventas.com";
    ?>
    <script>
        location.href = "<?php echo $URL;?>/proveedores";
    </script>
    <?php
}
?>
