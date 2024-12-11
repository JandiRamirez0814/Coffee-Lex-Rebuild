<?php

// Conversión de monto a literal (en pesos colombianos)
function convertir_a_literal($monto) {
    // Se asegura de que el monto sea un número entero
    $monto = intval($monto);
    // Usamos convertir_entero para obtener la conversión literal
    return convertir_entero($monto) . " pesos";
}

function convertir_entero($numero) {
    $nombres = [
        0 => "cero", 1 => "uno", 2 => "dos", 3 => "tres", 4 => "cuatro",
        5 => "cinco", 6 => "seis", 7 => "siete", 8 => "ocho", 9 => "nueve",
        10 => "diez", 11 => "once", 12 => "doce", 13 => "trece", 14 => "catorce",
        15 => "quince", 16 => "dieciséis", 17 => "diecisiete", 18 => "dieciocho",
        19 => "diecinueve", 20 => "veinte", 30 => "treinta", 40 => "cuarenta",
        50 => "cincuenta", 60 => "sesenta", 70 => "setenta", 80 => "ochenta",
        90 => "noventa", 100 => "cien", 200 => "doscientos", 300 => "trescientos",
        400 => "cuatrocientos", 500 => "quinientos", 600 => "seiscientos",
        700 => "setecientos", 800 => "ochocientos", 900 => "novecientos"
    ];

    // Si el número es menor que 20, directamente lo devolvemos
    if (isset($nombres[$numero])) {
        return $nombres[$numero];
    }

    // Si es mayor que 20 y menor que 100, tratamos de descomponerlo
    if ($numero < 100) {
        $decena = floor($numero / 10) * 10;
        $unidad = $numero % 10;
        if ($unidad == 0) {
            return $nombres[$decena];
        } else {
            return $nombres[$decena] . " y " . $nombres[$unidad];
        }
    }

    // Manejo de centenas
    if ($numero < 1000) {
        $centena = floor($numero / 100) * 100;
        $resto = $numero % 100;
        if ($resto == 0) {
            return $nombres[$centena];
        } else {
            return $nombres[$centena] . " " . convertir_entero($resto);
        }
    }

    // Manejo de miles
    if ($numero < 1000000) {
        $mil = floor($numero / 1000);
        $resto = $numero % 1000;
        if ($resto == 0) {
            return convertir_entero($mil) . " mil";
        } else {
            return convertir_entero($mil) . " mil " . convertir_entero($resto);
        }
    }

    // Manejo de millones
    if ($numero < 1000000000) {
        $millones = floor($numero / 1000000);
        $resto = $numero % 1000000;
        if ($resto == 0) {
            return convertir_entero($millones) . " millones";
        } else {
            return convertir_entero($millones) . " millones " . convertir_entero($resto);
        }
    }

    return "Número fuera de rango";
}

?>
