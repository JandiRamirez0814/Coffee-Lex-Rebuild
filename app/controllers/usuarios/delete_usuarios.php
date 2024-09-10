<?php
global $pdo;
include('../../config.php');

$id_usuario = $_POST['id_usuario'];

    // Prepara la consulta SQL
    $sentencia = $pdo->prepare("DELETE FROM tb_usuarios WHERE id_usuario = :id_usuario");

    $sentencia->bindParam(':id_usuario', $id_usuario);
    // Ejecuta la consulta SQL
    $sentencia->execute();
    session_start();
    $URL = "http://localhost/www.sistemadeventas.com";

    $_SESSION['mensaje']="Se elimino el usuario de manera exitosa";
    $_SESSION['icono']="success";
    header('Location: ' .$URL.'/usuarios/');

