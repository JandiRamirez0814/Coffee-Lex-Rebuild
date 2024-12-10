<?php

global $pdo;


$sql_ventas = "SELECT * FROM tb_ventas";

$squery_ventas = $pdo->prepare($sql_ventas);
$squery_ventas->execute(); // Aquí corregido
$ventas_datos = $squery_ventas->fetchAll(PDO::FETCH_ASSOC);

