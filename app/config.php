<?php
// Definición de las constantes para la conexión a la base de datos
define('SERVIDOR', 'localhost');
define('USUARIO', 'root');
define('PASSWORD', '');
define('BD', 'sistemadeventas');

// Creación de la cadena de conexión PDO
$servidor = "mysql:dbname=" . BD . ";host=" . SERVIDOR;

try {
    // Crear la conexión PDO y asignarla a la variable $pdo
    $pdo = new PDO($servidor, USUARIO, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
} catch (PDOException $e) {
    // Manejar cualquier error de conexión PDO
    echo "Error en la conexión de la base de datos: " . $e->getMessage();
    exit(); // Salir del script si hay un error
}

// Definición de la URL base del sitio
$URL = "http://localhost/ww.sistemadeventas.com";

date_default_timezone_set('america/bogota');
$fechaHora = date("Y-m-d H:i:s");


