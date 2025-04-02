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
const RUTA_LOGIN = "Location: ./../web/login";

$username = isset($_POST["username"]) ? $_POST["username"] : null;
$password = isset($_POST["password"]) ? $_POST["password"] : null;
$role = isset($_POST["role"]) ? $_POST["role"] : "REGISTERED";

if($role != "ADMIN"){
    $role = "REGISTERED";
} 

if($username==null || $password==null ){
    echo "err: valores nulos";
    exit;
}
if($username=="" || $password=="" ){
    echo "err: valores vacios";
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
if(!registrarUsuario($username, $password,$role)){
    echo "err: error en insercion";
    exit;
}
redireccionar(); 

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

function redireccionar(){
    header("Location: ".RUTA_LOGIN);
} 
