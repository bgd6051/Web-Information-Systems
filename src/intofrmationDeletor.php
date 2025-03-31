<?php
$output = '';

$output .= "Eliminando contenido de las tablas...<br>";

$ejecucionCorrecta = true;

try {
    $dbDeletor = new DBDeletor();
    $responseCode = $dbDeletor->deleteAllIntormationFromTables();
    if (!$responseCode) {
        $output .= "Ha habido algún problema eliminando el contenido de las tablas<br>";
        $ejecucionCorrecta = false;
    }
} catch (Exception $e) { $output .= "Error: " . $e->getMessage(); }

if ($ejecucionCorrecta) {
    $output .= "Información de las tablas eliminadas correctamente<br>";
    $output .= "Fecha de eliminación: " .  date('Y-m-d H:i:s') . "<br>"; 
} else {
    $output .= "No se ha podido eliminar la información de las tablas <br>";
}

echo $output;