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

const MAX_PASSWORD_LENGTH = 32;
const RUTA_LOGIN = "./../login";

$response = [
    'estado' => 'error',
    'mensaje' => 'no iniciado',
    'ruta' => ''
];

$username = isset($_GET["username"]) ? $_GET["username"] : null;
$password = isset($_GET["password"]) ? $_GET["password"] : null;
$role = isset($_GET["role"]) ? $_GET["role"] : "REGISTERED";

if($role != "ADMIN"){
    $role = "REGISTERED";
} 

if($username==null || $password==null ){
    $response["mensaje"] = "valores nulos";
    echo json_encode($response);
    exit;
}
if($username=="" || $password=="" ){
    $response["mensaje"] = "valores vacios";
    echo json_encode($response);
    exit;
}

$registered = isRegistered($username);
$validPassword = isPasswordValid($password);

if($registered){
    $response["mensaje"] = "username no disponible";
    echo json_encode($response);
    exit;
}
if(!$validPassword){
    $response["mensaje"] = "password no valido";
    echo json_encode($response);
    exit;
}
if(!registrarUsuario($username, $password,$role)){
    $response["mensaje"] = "error en insercion";
    echo json_encode($response);
    exit;
}

$response["estado"] = "exito";
$response["mensaje"] = "redireccionando";
$response["ruta"] = RUTA_LOGIN;

echo json_encode($response); 

function isRegistered($username): bool{
    $dbSelector = new DBSelector();
    $user = $dbSelector->getRegisteredUser($username);
    if(empty($user)){
        return false;
    }
    return true;
} 

function isPasswordValid($password): bool{
    return !(strlen($password) > MAX_PASSWORD_LENGTH);
} 

function registrarUsuario($username, $password, $role): bool{
    $dbInsertor = new DBInsertor();
    $userRegistration = new UserRegistration($username,$password,$role);
    return $dbInsertor->insertUserRegistration($userRegistration);
} 
