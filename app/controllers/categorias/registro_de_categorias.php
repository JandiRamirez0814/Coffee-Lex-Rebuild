<?php
global $pdo, $URL;
include ('../../config.php');

$nombre_categoria= $_GET['nombre_categoria'];

$sentencia =$pdo->prepare("INSERT INTO tb_categorias 
        (nombre_categoria, fyh_creacion)
    VALUES (:nombre_categoria,:fyh_creacion)");

$sentencia->bindParam(':nombre_categoria',$nombre_categoria);
$sentencia->bindParam(':fyh_creacion',$fechaHora);
if($sentencia->execute()) {
    session_start();
    //echo 'se registro correctamente';
    $_SESSION["mensaje"] = "Se registro la categoria correctamente";
    $_SESSION["icono"] = "success";
    $URL = "http://localhost/www.sistemadeventas.com";
    //header('location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/categorias";
    </script>

    <?php

}else{
    session_start();
    $_SESSION["mensaje"] = "Error no se puede registrar la categoria correctamente";
    $_SESSION["icono"] = "error";
    //header('location: ' . $URL . '/categorias');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/categorias";
    </script>

    <?php
}