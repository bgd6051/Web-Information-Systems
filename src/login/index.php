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

const RUTA_INICIO = "Location: ./../../";

session_start();

$username = isset($_GET["Username"]) ? $_GET["Username"] : null;
$password = isset($_GET["Password"]) ? $_GET["Password"] : null;

if($username==null || $password==null ){
    echo "err: valores nulos";
    exit;
}

$auth = new Auth($username);
$auth->setPassword($password);
$loginCorrect = $auth->authenticate();
$user = $auth->getFromDB();

if(!$loginCorrect){
    echo "Login no completado";
    exit;
}

$_SESSION["Username"] = $user->getUsername();
$_SESSION["Role"] = $user->getRole();

redireccionar();

function redireccionar(){
    header("Location: ".RUTA_INICIO);
} 


