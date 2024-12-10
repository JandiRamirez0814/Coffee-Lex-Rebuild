<?php
global $pdo, $URL;
include("../../config.php");

// Recoger los valores enviados por GET
$nro_venta = $_GET["nro_venta"];
$id_cliente = $_GET["id_cliente"];
$total_a_cancelar = $_GET["total_a_cancelar"];


$pdo->beginTransaction();
// Preparar la sentencia SQL
$sentencia = $pdo->prepare("INSERT INTO tb_ventas
        (nro_venta, id_cliente, total_pagado, fyh_creacion)
    VALUES (:nro_venta, :id_cliente, :total_pagado, :fyh_creacion)");

// Enlazar los parámetros
$sentencia->bindParam(':nro_venta', $nro_venta);
$sentencia->bindParam(':id_cliente', $id_cliente);
$sentencia->bindParam(':total_pagado', $total_a_cancelar);

$sentencia->bindParam(':fyh_creacion', $fechaHora);

// Ejecutar la consulta y manejar el resultado
if ($sentencia->execute()) {



    $pdo->commit();

    session_start();
    $_SESSION["mensaje"] = "Se registró la venta correctamente";
    $_SESSION["icono"] = "success";
    $URL = "http://localhost/www.sistemadeventas.com";
    ?>
    <script>
        location.href = "http://localhost/Coffe_lex/www.sistemadeventas.com/ventas";
    </script>
    <?php
} else {
    $pdo->rollback();

    session_start();
    $_SESSION["mensaje"] = "Error: no se pudo registrar la venta";
    $_SESSION["icono"] = "error";
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/ventas/create.php";
    </script>
    <?php
}


// Enlaza los parámetros

?>
