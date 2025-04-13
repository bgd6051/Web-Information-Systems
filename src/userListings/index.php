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

const SUBPAGE_TEMPLATE_PATH = "../../web/templates/subPage/";
$content = file_get_contents(SUBPAGE_TEMPLATE_PATH . "unauthorizedDirectAccessContentSubpage.html");
if($username==null|| $role==null){
    echo $content;
    exit;
}

if(!isRegistered($username)){
    echo $content;
    exit;
}

if($role != "ADMIN"){
    echo $content;
    exit;
}

$listaHTMLFiltrada = filtrarLista($filtroUser);

if($listaHTMLFiltrada == null){
    $response["mensaje"] = "listado vacio, puede que el filtrado sea muy estricto";
    echo json_encode($response);
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
    
    return $filtro;
} 

function isRegistered($username): bool{
    $dbSelector = new DBSelector();
    $user = $dbSelector->getRegisteredUser($username);
    if(empty($user)){
        return false;
    }
    return true;
} 