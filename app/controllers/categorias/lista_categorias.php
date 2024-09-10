<?php

global $pdo;


$sql_categorias = "SELECT * FROM tb_categorias";
$squery_categorias = $pdo->prepare($sql_categorias);
$squery_categorias->execute(); // Aquí corregido
$categorias_datos = $squery_categorias->fetchAll(PDO::FETCH_ASSOC);

