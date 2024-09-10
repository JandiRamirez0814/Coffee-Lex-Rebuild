<?php

global $pdo;


$sql_productos = "SELECT *, cat.nombre_categoria as nombre_categoria, u.email as email
                FROM tb_almacen AS a INNER JOIN tb_categorias as cat ON a.id_categoria= cat.id_categoria
                INNER JOIN tb_usuarios as u ON u.id_usuario = a.id_usuario";
$squery_productos = $pdo->prepare($sql_productos);
$squery_productos->execute(); // Aquí corregido
$productos_datos = $squery_productos->fetchAll(PDO::FETCH_ASSOC);

