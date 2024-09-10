<?php

global $pdo;


$sql_roles = "SELECT * FROM tb_roles";
$squery_roles = $pdo->prepare($sql_roles);
$squery_roles->execute(); // Aquí corregido
$roles_datos = $squery_roles->fetchAll(PDO::FETCH_ASSOC);

