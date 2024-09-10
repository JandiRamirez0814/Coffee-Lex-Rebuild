<?php
global $pdo;


$id_usuario_get = $_GET['id'];

$sql_usuarios = "SELECT us.id_usuario as id_usuario, us.nombres as nombres, us.email as email, rol.rol as rol 
                FROM tb_usuarios AS us INNER JOIN tb_roles as rol ON us.id_rol= rol.id_rol 
                WHERE id_usuario = :id_usuario";
$squery_usuarios = $pdo->prepare($sql_usuarios);
$squery_usuarios->bindParam(':id_usuario', $id_usuario_get);
$squery_usuarios->execute();
$usuarios_datos = $squery_usuarios->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios_datos as $usuarios_dato){
    $nombress = $usuarios_dato['nombres'];
    $email = $usuarios_dato['email'];
    $rol = $usuarios_dato['rol'];

}
