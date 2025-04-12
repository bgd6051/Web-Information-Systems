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
    'mensaje' => 'no iniciado'
];

session_start();

$username = isset($_SESSION["Username"]) ? $_SESSION["Username"] : null;
$role = isset($_SESSION["Role"]) ? $_SESSION["Role"] : null;
$oldUsername = isset($_GET["OldUsername"]) ? $_GET["OldUsername"] : null;

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
    $response["mensaje"] = "usuario a eliminar no seleccionado";
    echo json_encode($response);
    exit;
} 
if($oldUsername == $username){
    $response["mensaje"] = "no puedes eliminarte a ti mismo";
    echo json_encode($response);
    exit;
} 

$auth = new Auth($oldUsername);
if(!$auth->existInDB()){
    $response["mensaje"] = "usuario a eliminar no encontrado, revisa el nombre";
    echo json_encode($response);
    exit;
} 
if($auth->getFromDB()->getRole() == "ADMIN"){
    $response["mensaje"] = "usuario a eliminar es un administrador, no es posible eliminarlo";
    echo json_encode($response);
    exit;
} 

$response["estado"] = "exito";

$response = prepareResponse($auth, $response);

echo json_encode($response);

function isRegistered($username): bool{
    $dbSelector = new DBSelector();
    $user = $dbSelector->getRegisteredUser($username);
    if(empty($user)){
        return false;
    }
    return true;
} 

function prepareResponse(Auth $auth, array $response){
    if(!$auth->deleteUser()){
        $response["mensaje"] = "no se ha podido eliminar el usuario";
        return $response;
    }
    $response["mensaje"] = "el usuario ha sido eliminado";
    return $response;
}