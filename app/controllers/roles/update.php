<?php
include('../../config.php');
global $pdo;
$id_rol = $_POST['id_rol'];
$rol = $_POST['rol'];

        $sentencia = $pdo->prepare("UPDATE tb_roles 
    SET rol = :rol,
        fyh_actualizacion= :fyh_actualizacion
    WHERE id_rol = :id_rol");

        // Enlaza los parámetros
        $sentencia->bindParam(':rol', $rol);
        $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
        $sentencia->bindParam(':id_rol', $id_rol);

        if($sentencia->execute()){
            session_start();
            $URL = "http://localhost/www.sistemadeventas.com";

            $_SESSION['mensaje']="Se actualizo el rol de manera exitosa";
            $_SESSION['icono']="success";
            header('Location: ' .$URL.'/roles/');

        }else{
            $URL = "http://localhost/www.sistemadeventas.com";
            //echo "error las contraseñas no son iguales";
            session_start();
            $_SESSION['mensaje']="Error no se pudo registar el rol de manera exitosa";
            $_SESSION['icono']="error";

            header('Location: ' .$URL.'/roles/update.php?id='.$id_rol);

        }
















