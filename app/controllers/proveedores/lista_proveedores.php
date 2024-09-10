<?php

global $pdo;


$sql_proveedores = "SELECT * FROM tb_proveedores";
$squery_proveedores = $pdo->prepare($sql_proveedores);
$squery_proveedores->execute(); // Aquí corregido
$proveedores_datos = $squery_proveedores->fetchAll(PDO::FETCH_ASSOC);

