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

if(!isRegistered($username)){
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
if(!$auth->existInDB()){
    $response["mensaje"] = "usuario a editar no encontrado, revisa el nombre";
    echo json_encode($response);
    exit;
} 
$response["estado"] = "exito";

$response = prepareResponse($auth, $newUsername, $newPassword, $response);

echo json_encode($response);

function isRegistered($username): bool{
    $dbSelector = new DBSelector();
    $user = $dbSelector->getRegisteredUser($username);
    if(empty($user)){
        return false;
    }
    return true;
} 

function prepareResponse(Auth $auth, String $newUsername, String $newPassword, array $response){
    $response["mensaje"] = "";
    $response = editUsername($auth, $newUsername, $response);
    $response = editPassword($auth, $newPassword, $response);

    return $response;
}

function editUsername(Auth $auth, String $newUsername, array $response){
    if($newUsername==null){
        return $response;
    }
    if($newUsername==""){
        return $response;
    }
    if(!$auth->editUsername($newUsername)){
        return $response;
    }
    $response["username"] = $newUsername;
    $response["mensaje"] .= "[actualizado username]";
    return $response;
    
}

function editPassword(Auth $auth, String $newPassword, array $response){
    if($newPassword==null){
        return $response;
    }
    if($newPassword==""){
        return $response;
    }
    if(!$auth->editPassword($newPassword)){
        return $response;
    }
    $response["password"] = $newPassword;
    $response["mensaje"] .= "[actualizado password]";
    return $response;
}