<?php

const SYSTEM_ID = 1;

spl_autoload_register(function ($class) {
    $directories = ['requestClasses', 'databaseClasses', 'databaseClasses' . DIRECTORY_SEPARATOR . 'databaseModelClasses'];

    foreach ($directories as $dir) {
        $file = __DIR__ . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

$output = '';

$output .= "Eliminando contenido de las tablas...<br>";

$ejecucionCorrecta = true;

$deleteDate = date('Y-m-d H:i:s');

try {
    $dbDeletor = new DBDeletor();
    $responseCode = $dbDeletor->deleteAllIntormationFromTables();
    if (!$responseCode) {
        $output .= "Ha habido algún problema eliminando el contenido de las tablas<br>";
        $ejecucionCorrecta = false;
    }
} catch (Exception $e) { $output .= "Error: " . $e->getMessage(); }

try {
    $dbInsertor = new DBInsertor();
    $adminlog = new AdminLog(SYSTEM_ID,"DELETE",$deleteDate);
    
    $responseCode = $dbInsertor->insertAdminLog($adminlog);
    if (!$responseCode) {
        $output .= "Ha habido algún problema insertando el log del cambio<br>";
        $ejecucionCorrecta = false;
    }
    
} catch (Exception $e) { $output .= "Error: " . $e->getMessage(); }

if ($ejecucionCorrecta) {
    $output .= "Información de las tablas eliminadas correctamente<br>";
    $output .= "Fecha de eliminación: " . $deleteDate . "<br>"; 
} else {
    $output .= "No se ha podido eliminar la información de las tablas <br>";
}

echo $output;