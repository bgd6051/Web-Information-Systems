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

$response = [
    'estado' => 'error',
    'mensaje' => 'no iniciado'
];

session_start();

$username = isset($_SESSION["Username"]) ? $_SESSION["Username"] : null;
$role = isset($_SESSION["Role"]) ? $_SESSION["Role"] : null;

$filtroUser = isset($_GET["filtroUser"]) ? $_GET["filtroUser"] : null;

if($username==null|| $role==null){
    $response["mensaje"] = "no estas logeado";
    echo json_encode($response);
    exit;
}

if(!isRegistered($username)){
    $response["mensaje"] = "no estas registrado: ".$username;
    echo json_encode($response);
    exit;
}

if($role != "ADMIN"){
    $response["mensaje"] = "no estas autorizado";
    echo json_encode($response);
    exit;
}

$listaHTMLFiltrada = filtrarLista($filtroUser);

if($listaHTMLFiltrada == null){
    $response["mensaje"] = "listado vacio, puede que el filtrado sea muy estricto";
    echo "";
    exit;
}

$response["estado"] = "exito";
$response["mensaje"] = $listaHTMLFiltrada;
echo json_encode($response);


function filtrarLista($filtroUser){
    $filtro = filtrado($filtroUser);
    $lista = getLista($filtro);
    if($lista == null){
        return null;
    }
    
    $HTML = "";
    if($lista[0] == null){
        return "";
    }
    foreach($lista as $elem){
        $elemHTML = $elem->toHTML();
        $HTML .= $elemHTML;
    }
    
    return $HTML;
} 
function getLista($filtro){
    $dbSelector = new DBSelector();
    return $dbSelector->getAllUserRegistrations(null,null,$filtro);
}

function filtrado($filtro){
    if($filtro == null){
        return null;
    }
    
    return $filtro."%";
} 

function isRegistered($username): bool{
    $dbSelector = new DBSelector();
    $user = $dbSelector->getRegisteredUser($username);
    if(empty($user)){
        return false;
    }
    return true;
} 