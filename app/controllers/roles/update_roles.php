<?php
global $pdo;


$id_rol_get = $_GET['id'];

$sql_roles = "SELECT * FROM tb_roles WHERE id_rol =  '$id_rol_get' ";
$squery_roles = $pdo->prepare($sql_roles);
$squery_roles->execute();
$roles_datos = $squery_roles->fetchAll(PDO::FETCH_ASSOC);

foreach ($roles_datos as $roles_dato){
    $rol = $roles_dato['rol'];

}
