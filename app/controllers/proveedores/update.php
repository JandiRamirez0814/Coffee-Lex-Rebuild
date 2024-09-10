<?php
global $pdo, $URL;
include ('../../config.php');

$id_proveedor = $_GET['id_proveedor'];
$nombre_proveedor = $_GET['nombre_proveedor'];
$celular = $_GET['celular'];
$telefono = $_GET['telefono'];
$empresa = $_GET['empresa'];
$email = $_GET['email'];
$direccion = $_GET['direccion'];


// Realizar la actualización en la base de datos
$sql = "UPDATE tb_proveedores 
        SET nombre_proveedor = :nombre_proveedor, 
            celular = :celular, 
            telefono = :telefono, 
            empresa = :empresa, 
            email = :email, 
            direccion = :direccion ,
            fyh_actualizacion = :fyh_actualizacion
        WHERE id_proveedor = :id_proveedor";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':nombre_proveedor', $nombre_proveedor);
$stmt->bindParam(':celular', $celular);
$stmt->bindParam(':telefono', $telefono);
$stmt->bindParam(':empresa', $empresa);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':direccion', $direccion);
$stmt->bindParam(':fyh_actualizacion', $fechaHora);
$stmt->bindParam(':id_proveedor', $id_proveedor);


if($stmt->execute()) {
    session_start();
    $_SESSION["mensaje"] = "Se actualizó el proveedor correctamente";
    $_SESSION["icono"] = "success";
    $URL = "http://localhost/www.sistemadeventas.com";
    ?>
    <script>
        location.href = "<?php echo $URL;?>/proveedores";
    </script>
    <?php
} else {
    session_start();
    $_SESSION["mensaje"] = "Error, no se pudo actualizar el proveedor correctamente";
    $_SESSION["icono"] = "error";
    ?>
    <script>
        location.href = "<?php echo $URL;?>/proveedores";
    </script>
    <?php
}
?>
