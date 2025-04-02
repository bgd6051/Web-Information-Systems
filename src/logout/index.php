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

const RUTA_INICIO = "./../../";

$response = [
    'estado' => 'error',
    'mensaje' => 'no iniciado',
    'ruta' => ''
];

session_start();

session_unset();

if(session_destroy()){
    $response["estado"] = "exito";
    $response["mensaje"] = "redireccionando";
    $response["ruta"] = RUTA_INICIO;
    echo json_encode($response);
    exit;
}

$response["mensaje"] = "Logout no completado";

 echo json_encode($response);
