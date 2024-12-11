<?php

global $pdo, $id_venta_get, $id_cliente;


$sql_clientes = "SELECT * FROM tb_clientes WHERE id_cliente = '$id_cliente'";

$squery_clientes = $pdo->prepare($sql_clientes);
$squery_clientes->execute(); // Aquí corregido
$clientes_datos = $squery_clientes->fetchAll(PDO::FETCH_ASSOC);
