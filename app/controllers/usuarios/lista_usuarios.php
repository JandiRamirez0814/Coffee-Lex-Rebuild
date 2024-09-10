<?php

global $pdo;


$sql_usuarios = "SELECT us.id_usuario as id_usuario, us.nombres as nombres, us.email as email, rol.rol as rol 
                FROM tb_usuarios AS us INNER JOIN tb_roles as rol ON us.id_rol= rol.id_rol";
$squery_usuarios = $pdo->prepare($sql_usuarios);
$squery_usuarios->execute(); // Aquí corregido
$usuarios_datos = $squery_usuarios->fetchAll(PDO::FETCH_ASSOC);
    
