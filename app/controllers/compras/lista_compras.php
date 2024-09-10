<?php

global $pdo;


$sql_compras = "SELECT *, 
                pro.codigo as codigo, pro.nombre as nombre_producto, pro.descripcion as descripcion, 
                pro.stock as stock, pro.stock_minimo as stock_minimo, pro.stock_maximo as stock_maximo,
                pro.precio_compra as precio_compra_producto, pro.precio_venta as precio_venta_producto, pro.fecha_ingreso as fecha_ingreso,
                pro.imagen as imagen
                FROM tb_compras AS co INNER JOIN tb_almacen AS pro 
                ON co.id_producto = pro.id_producto";

$squery_compras = $pdo->prepare($sql_compras);
$squery_compras->execute(); // Aquí corregido
$compras_datos = $squery_compras->fetchAll(PDO::FETCH_ASSOC);

