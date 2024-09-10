<?php
include('../../config.php');
global $pdo;


$nombre_categoria = $_GET['nombre_categoria'];
$id_categoria = $_GET['id_categoria'];

$sentencia = $pdo->prepare("UPDATE tb_categorias 
    SET nombre_categoria = :nombre_categoria,
        fyh_actualizacion= :fyh_actualizacion
    WHERE id_categoria = :id_categoria");

// Enlaza los parámetros
$sentencia->bindParam(':nombre_categoria', $nombre_categoria);
$sentencia->bindParam(':fyh_actualizacion', $fechaHora);
$sentencia->bindParam(':id_categoria', $id_categoria);

if($sentencia->execute()){
    session_start();
    $URL = "http://localhost/www.sistemadeventas.com";

    $_SESSION['mensaje']="Se actualizo la categoria de manera exitosa";
    $_SESSION['icono']="success";
    //header('Location: ' .$URL.'/roles/');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/categorias";
    </script>

    <?php

}else{
    $URL = "http://localhost/www.sistemadeventas.com";
    //echo "error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje']="Error no se pudo actualizar la categoria de manera exitosa";
    $_SESSION['icono']="error";

    //header('Location: ' .$URL.'/roles/update.php?id='.$id_rol);
    ?>
    <script>
        location.href = "<?php echo $URL;?>/categorias";
    </script>

    <?php
}
















