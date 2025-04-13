<?php

spl_autoload_register(function ($class) {
    $directories = ['databaseClasses', 'databaseClasses' . DIRECTORY_SEPARATOR . 'databaseModelClasses'];

    foreach ($directories as $dir) {
        $file = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $class . '.php';

        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

$fechaActualizacion = getUltimaAtualizacion();

echo $fechaActualizacion;

function getUltimaAtualizacion(){
    $dbSelector = new DBSelector();
    $actualizaciones = $dbSelector->getLastAdminLog();
    if($actualizaciones == null){
        return "Ultima actualizacion no guardada";
    }
    return "Ultima actualizacion fue guardada en ".$actualizaciones[0][0];
} 