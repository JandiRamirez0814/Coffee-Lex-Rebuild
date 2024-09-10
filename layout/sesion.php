<?php
global $pdo;
session_start();
global $URL;

if(isset($_SESSION['sesion_email'])){
    //echo "Sesión iniciada para " . $_SESSION['sesion_email'];
    $email_sesion = $_SESSION['sesion_email'];
    $sql = "SELECT us.id_usuario as id_usuario, us.nombres as nombres, us.email as email, rol.rol as rol 
                FROM tb_usuarios AS us INNER JOIN tb_roles as rol ON us.id_rol= rol.id_rol WHERE email= '$email_sesion'";
    $squery = $pdo->prepare($sql);
    $squery->execute(); // Aquí corregido
    $usuarios = $squery->fetchAll(PDO::FETCH_ASSOC);
    foreach ($usuarios as $usuario){
        $id_usuario_sesion = $usuario['id_usuario'];
        $nombres_sesion = $usuario['nombres'];
        $rol_sesion = $usuario['rol'];
    }
} else {
    echo "No hay sesión iniciada.";
    header('Location: '.$URL.'/login');

}
