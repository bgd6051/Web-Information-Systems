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

$username = isset($_GET["Username"]) ? $_GET["Username"] : null;
$password = isset($_GET["Password"]) ? $_GET["Password"] : null;

if($username==null || $password==null ){
    echo "err: valores nulos";
    exit;
}

$loginCorrect = isLoginCorrect($username,$password);

if($loginCorrect){
    echo "Login completado";
    exit;
}
echo "Login no completado";


function isLoginCorrect($username,$password): bool{
    $dbSelector = new DBSelector();
    $user = $dbSelector->getRegisteredUser($username);
    if(empty($user)){
        return false;
    }
    if($user[0]->getPassword() != $password){
        return false;
    }
    return true;
} 




