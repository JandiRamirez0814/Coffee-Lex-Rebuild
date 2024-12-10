<?php

global $pdo;


$sql_clientes = "SELECT * FROM tb_clientes";

$squery_clientes = $pdo->prepare($sql_clientes);
$squery_clientes->execute(); // Aquí corregido
$clientes_datos = $squery_clientes->fetchAll(PDO::FETCH_ASSOC);

