<?php
global $pdo, $URL;
include("../../config.php");

$id_carrito = $_POST["id_carrito"];


// Preparar la sentencia SQL
$sentencia = $pdo->prepare("DELETE FROM tb_carrito WHERE id_carrito = :id_carrito");

// Enlazar los parámetros
$sentencia->bindParam('id_carrito', $id_carrito);

// Ejecutar la consulta y manejar el resultado
if ($sentencia->execute()) {


    ?>
    <script>
        location.href = "http://localhost/Coffe_lex/www.sistemadeventas.com/ventas/create.php";
    </script>
    <?php
} else {

    ?>
    <script>
        location.href = "<?php echo $URL; ?>/ventas/create.php";
    </script>
    <?php
}


// Enlaza los parámetros

?>
