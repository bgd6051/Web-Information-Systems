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

session_start();

$username = isset($_SESSION["Username"]) ? $_SESSION["Username"] : null;
$newUsername = isset($_GET["NewUsername"]) ? $_GET["NewUsername"] : null;
$newPassword = isset($_GET["NewPassword"]) ? $_GET["NewPassword"] : null;

if($Username==null){
    echo "err: no logeado";
    exit;
}

if(isRegistered($newUsername)){
    echo "err: este usuario ya existe";
    exit;
}
$auth = new Auth($username);
if($newUsername!=null){
    $auth->editUsername($newUsername);
}
if($newPassword!=null){
    $auth->editPassword($newPassword);
}
echo "Updates completado";

function isRegistered($username): bool{
    $dbSelector = new DBSelector();
    $user = $dbSelector->getRegisteredUser($username);
    if(empty($user)){
        return false;
    }
    return true;
} 




