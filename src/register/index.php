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
const RUTA_LOGIN = "Location: ./../login/";

$username = isset($_GET["Username"]) ? $_GET["Username"] : null;
$password = isset($_GET["Password"]) ? $_GET["Password"] : null;

if($username==null || $password==null ){
    echo "err: valores nulos";
    exit;
}

$registered = isRegistered($username);
$validPassword = isPasswordValid($password);

if($registered){
    echo "err: username no disponible";
    exit;
}
if(!$validPassword){
    echo "err: password no valido";
    exit;
}
if(!registrarUsuario($username, $password)){
    echo "err: error en insercion";
    exit;
}
redireccionar();Location: 

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

function registrarUsuario($username, $password): bool{
    $role = "REGISTERED";
    $dbInsertor = new DBInsertor();
    $userRegistration = new UserRegistration($username,$password,$role);
    return $dbInsertor->insertUserRegistration($userRegistration);
} 

function redireccionar(){
    header("Location: ".RUTA_LOGIN);
} 
