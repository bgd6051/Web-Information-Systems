<?php

spl_autoload_register(function ($class) {
    $directories = ['auth', 'databaseClasses', 'databaseClasses' . DIRECTORY_SEPARATOR . 'databaseModelClasses'];

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

$username = isset($_GET["Username"]) ? $_GET["Username"] : null;
$password = isset($_GET["Password"]) ? $_GET["Password"] : null;

if($username==null || $password==null ){
    $response["mensaje"] = "valores nulos";
    echo json_encode($response);
    exit;
}

$auth = new Auth($username);
$auth->setPassword($password);
$loginCorrect = $auth->authenticate();
$user = $auth->getFromDB();

if(!$loginCorrect){
    $response["mensaje"] = "el usuario o la contraseña no son correctos";
    echo json_encode($response);
    exit;
}

$_SESSION["Username"] = $user->getUsername();
$_SESSION["Role"] = $user->getRole();

$response["estado"] = "exito";
$response["mensaje"] = "redireccionando";
$response["ruta"] = RUTA_INICIO;

echo json_encode($response);


