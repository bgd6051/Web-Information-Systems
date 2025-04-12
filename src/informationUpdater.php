<?php

spl_autoload_register(function ($class) {
    $directories = ['requestClasses', 'databaseClasses', 'databaseClasses' . DIRECTORY_SEPARATOR . 'databaseModelClasses'];

    foreach ($directories as $dir) {
        $file = __DIR__ . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

session_start();

$username = isset($_SESSION["Username"]) ? $_SESSION["Username"] : null;
$role = isset($_SESSION["Role"]) ? $_SESSION["Role"] : null;

if($username==null|| $role==null){
    echo "no estas logeado";
    exit;
}

$auth = new Auth($username);
if(!$auth->existInDB()){
    echo "no estas registrado";
    exit;
} 
$admin = $auth->getFromDB();
if($admin->getRole() != "ADMIN"){
    echo "no estas autorizado";
    exit;
} 
$adminId = $admin->getID_USER();

$output = ''; // Inicializar variable para almacenar los mensajes

$output .= "Contactando con la API...<br>";

// Conseguir respuestas de la API y construir arrays 
$coinsResponse = CoinRequest::getCoinResponseContent();
$coinsArrayResponse = Coin::constructCoinArray($coinsResponse);

$coinsChartsArrayResponse = [];
foreach (MAIN_COINS_ID as $coinId) {
    $intCoinId = MAIN_COINS_ID_INT[$coinId];
    $coinChartArrayResponse = CoinChartRequest::getCoinChartResponseContent($coinId);
    $coinChartInstanceArrayResponse = CoinChartInstance::constructCoinChartArray($coinChartArrayResponse, $intCoinId);
    $coinsChartsArrayResponse[] = $coinChartInstanceArrayResponse;
}

$exchangeResponse = ExchangeRequest::getExchangeResponseContent();
$exchangeArrayResponse = Exchange::constructExchangeArray($exchangeResponse);

$trendingResponse = TrendingRequest::getTrendingResponseContent();
$trendingCoinsArrayResponse = TrendingCoin::constructTrendingCoinArray($trendingResponse);
$trendingNftArrayResponse = TrendingNft::constructTrendingNftArray($trendingResponse);

$output .= "Eliminando contenido de las tablas...<br>";

// Eliminar el contenido que ya había en la base de datos 
$ejecucionCorrecta = true;

try {
    $dbDeletor = new DBDeletor();
    $responseCode = $dbDeletor->deleteAllIntormationFromTables();
    if (!$responseCode) {
        $output .= "Ha habido algún problema eliminando el contenido de las tablas<br>";
        $ejecucionCorrecta = false;
    }
} catch (Exception $e) { $output .= "Error: " . $e->getMessage(); }

$output .= "Insertando el contenido en las tablas...<br>";

// Insertar todo el contenido en las bases de datos dados los arrays

$updatedDate = date('Y-m-d H:i:s');

try {
    $dbInsertor = new DBInsertor();
    $adminlog = new AdminLog($adminId,"RELOAD",$updatedDate);
    $fullInformationArray = buildFullInformationArray($coinsArrayResponse, $coinsChartsArrayResponse, 
    $exchangeArrayResponse, $trendingCoinsArrayResponse, $trendingNftArrayResponse);

    $responseCode = $dbInsertor->insertAdminLog($adminlog);
    if (!$responseCode) {
        $output .= "Ha habido algún problema insertando el log del cambio<br>";
        $ejecucionCorrecta = false;
    }

    $responseCode = $dbInsertor->insertAllInformation($fullInformationArray);
    if (!$responseCode) {
        $output .= "Ha habido algún problema insertando el contenido de las tablas<br>";
        $ejecucionCorrecta = false;
    }
} catch (Exception $e) { $output .= "Error: " . $e->getMessage(); }


if ($ejecucionCorrecta) {
    $output .= "Información de las tablas actualizada correctamente<br>";
    $output .= "Fecha de actualización: " . $updatedDate . "<br>"; 
} else {
    $output .= "No se ha podido actualizar la información correctamente <br>";
}

echo $output; // Devolver el contenido acumulado a la respuesta AJAX

function buildFullInformationArray($coinsArrayResponse, $coinsChartsArrayResponse, 
                                    $exchangeArrayResponse, $trendingCoinsArrayResponse, 
                                    $trendingNftArrayResponse): array 
{
    return array (
        "coins" => $coinsArrayResponse,
        "coinsCharts" => $coinsChartsArrayResponse,
        "exchanges" => $exchangeArrayResponse,
        "trendingCoins" => $trendingCoinsArrayResponse,
        "trendingNfts" => $trendingNftArrayResponse,
    );
}
?>
