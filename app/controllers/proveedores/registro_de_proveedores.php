<?php
global $pdo, $URL;
include ('../../config.php');

$nombre_proveedor = $_GET['nombre_proveedor'];
$celular = $_GET['celular'];
$telefono = $_GET['telefono'];
$empresa = $_GET['empresa'];
$email = $_GET['email'];
$direccion = $_GET['direccion'];

// Realizar la inserción en la base de datos
$sql = "INSERT INTO tb_proveedores (nombre_proveedor, celular, telefono, empresa, email, direccion) 
        VALUES (:nombre_proveedor, :celular, :telefono, :empresa, :email, :direccion)";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':nombre_proveedor', $nombre_proveedor);
$stmt->bindParam(':celular', $celular);
$stmt->bindParam(':telefono', $telefono);
$stmt->bindParam(':empresa', $empresa);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':direccion', $direccion);

if($stmt->execute()) {
    session_start();
    //echo 'se registro correctamente';
    $_SESSION["mensaje"] = "Se registro el proveedor correctamente";
    $_SESSION["icono"] = "success";
    $URL = "http://localhost/www.sistemadeventas.com";
    //header('location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/proveedores";
    </script>

    <?php

}else{
    session_start();
    $_SESSION["mensaje"] = "Error no se puede registrar la categoria correctamente";
    $_SESSION["icono"] = "error";
    //header('location: ' . $URL . '/categorias');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/proveedores";
    </script>

    <?php
}
?>
