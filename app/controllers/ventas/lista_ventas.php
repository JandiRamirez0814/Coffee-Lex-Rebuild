<?php

global $pdo;


$sql_ventas = "SELECT *, cli.nombre_cliente as nombre_cliente
                FROM tb_ventas as ve INNER JOIN tb_clientes as cli ON cli.id_cliente = ve.id_cliente ";

$squery_ventas = $pdo->prepare($sql_ventas);
$squery_ventas->execute(); // Aquí corregido
$ventas_datos = $squery_ventas->fetchAll(PDO::FETCH_ASSOC);

