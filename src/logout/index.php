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

const RUTA_INICIO = "Location: ./../../";

session_start();

$_SESSION = [];

if(session_destroy()){
    echo "Logout completado";
    exit;
}
echo "Logout no completado";

function redireccionar(){
    header("Location: ".RUTA_INICIO);
} 