<?php
// Verifica si se enviaron los datos del formulario
global $fechaHora, $URL;
if(isset($_POST['nombres'], $_POST['email'], $_POST['password_user'], $_POST['password_repeat'])) {
    $nombres = $_POST['nombres'];
    $email = $_POST['email'];
    $id_rol = $_POST['rol'];
    $password_user = $_POST['password_user'];
    $password_repeat = $_POST['password_repeat'];


    if ($password_user == $password_repeat) {
        // Realiza la conexión a la base de datos
        global $pdo;
        include('../../config.php');
        $password_user = password_hash($password_user, PASSWORD_DEFAULT);
        // Prepara la consulta SQL
        $sentencia = $pdo->prepare("INSERT INTO tb_usuarios 
                                    (nombres, email, id_rol ,password_user, fyh_creacion) 
                                    VALUES(:nombres, :email,:id_rol ,:password_user, :fyh_creacion)");

        // Enlaza los parámetros
        $sentencia->bindParam(':nombres', $nombres);
        $sentencia->bindParam(':email', $email);
        $sentencia->bindParam(':id_rol', $id_rol);
        $sentencia->bindParam(':password_user', $password_user);
        $sentencia->bindParam(':fyh_creacion', $fechaHora);

        // Ejecuta la consulta SQL
        $sentencia->execute();
        session_start();
        $URL = "http://localhost/www.sistemadeventas.com";

        $_SESSION['mensaje']="Se regitro de manera exitosa";
        header('Location: ' .$URL.'/usuarios/');

    } else {
        $URL = "http://localhost/www.sistemadeventas.com";
        //echo "error las contraseñas no son iguales";
        session_start();
        $_SESSION['mensaje']="Error las contraseñas no son iguales";

        header('Location: ' .$URL.'/usuarios/create.php');


    }

}




