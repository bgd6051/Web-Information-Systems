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

$oldUsername = isset($_GET["OldUsername"]) ? $_GET["OldUsername"] : null;
$newUsername = isset($_GET["NewUsername"]) ? $_GET["NewUsername"] : null;
$oldPassword = isset($_GET["OldPassword"]) ? $_GET["OldPassword"] : null;
$newPassword = isset($_GET["NewPassword"]) ? $_GET["NewPassword"] : null;

if($oldUsername==null){
    echo "err: este usuario es nulo";
    exit;
}
if(!isRegistered($username)){
    echo "err: este usuario no existe";
    exit;
}

if($newUsername!=null){
    editUsername($username, $newUsername);
}
if($newPassword!=null){
    editPassword($password, $newPassword);
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




