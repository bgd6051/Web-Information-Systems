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
//
$listaHTMLFiltrada = listar();

if($listaHTMLFiltrada == null){
    $response["mensaje"] = "listado vacio, error inesperado";
    echo "";
    exit;
}

$response["estado"] = "exito";
$response["mensaje"] = $listaHTMLFiltrada;
echo json_encode($response);


function listar(){
    $dbSelector = new DBSelector();

    $HTML = "<ul><li>Usuarios Registrados: ";
    $HTML .= count($dbSelector->getAllUserRegistrations(null,null,null));
    $HTML = "</li><li>CoinChart Registrados: ";
    $HTML .= count($dbSelector->getAllCoinChart(null,null));
    $HTML = "</li><li>TrendingCoins Registrados: ";
    $HTML .= count($dbSelector->getAllTrendingCoins(null,null));
    $HTML = "</li><li>TrendingNfts Registrados: ";
    $HTML .= count($dbSelector->getAllTrendingNfts(null,null));
    $HTML = "</li><li>Coins Registrados: ";
    $HTML .= count($dbSelector->getAllCoins(null,null));
    $HTML = "</li><li>Exchanges Registrados: ";
    $HTML .= count($dbSelector->getAllExchanges(null,null));
    $HTML .= "</li></ul>";
    
    return $HTML;
}
