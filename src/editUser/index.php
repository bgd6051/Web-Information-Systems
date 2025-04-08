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

$response = [
    'estado' => 'error',
    'mensaje' => 'no iniciado',
    'username' => '',
    'password' => '',
    'role' => ''
];

session_start();

$username = isset($_SESSION["Username"]) ? $_SESSION["Username"] : null;
$role = isset($_SESSION["Role"]) ? $_SESSION["Role"] : null;
$oldUsername = isset($_GET["OldUsername"]) ? $_GET["OldUsername"] : null;
$newUsername = isset($_GET["NewUsername"]) ? $_GET["NewUsername"] : null;
$newPassword = isset($_GET["NewPassword"]) ? $_GET["NewPassword"] : null;

if($username==null|| $role==null){
    $response["mensaje"] = "no estas logeado";
    echo json_encode($response);
    exit;
}

if(isRegistered($newUsername)){
    $response["mensaje"] = "no estas registrado";
    echo json_encode($response);
    exit;
}

if($role != "ADMIN"){
    $response["mensaje"] = "no estas autorizado";
    echo json_encode($response);
    exit;
}

if($oldUsername == null){
    $response["mensaje"] = "usuario a editar no seleccionado";
    echo json_encode($response);
    exit;
} 

$auth = new Auth($oldUsername);
if($auth->existInDB()){
    $response["mensaje"] = "usuario a editar no encontrado, revisa el nombre";
    echo json_encode($response);
    exit;
} 
$response["estado"] = "exito";
$msg = "";
if($newUsername!=null){
    if($auth->editUsername($newUsername)){
        $response["username"] = $newUsername;
        $msg .= "[actualizado username]";
    } 
}
if($newPassword!=null){
    if($auth->editPassword($newPassword)){
        $response["password"] = $newPassword;
        $msg .= "[actualizado password]";
    } 
}

$response["mensaje"] = $msg;
echo json_encode($response);

function isRegistered($username): bool{
    $dbSelector = new DBSelector();
    $user = $dbSelector->getRegisteredUser($username);
    if(empty($user)){
        return false;
    }
    return true;
} 