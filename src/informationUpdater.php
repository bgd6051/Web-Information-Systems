<?php
const SYSTEM_ID = 1;

spl_autoload_register(function ($class) {
    $directories = ['requestClasses', 'databaseClasses', 'databaseClasses/databaseModelClasses/'];

    foreach ($directories as $dir) {
        $file = __DIR__ . "/$dir/$class.php";
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }

});

echo "Contactando con la API...<br>";

// Conseguir respuestas de la API y construir arrays 
$coinsResponse = CoinRequest::getCoinResponseContent();
$coinsArrayResponse = Coin::constructCoinArray($coinsResponse);

$coinsChartsArrayResponse = [];
foreach (MAIN_COINS_ID as $coinId) {
    $intCoinId = MAIN_COINS_ID_INT[$coinId];
    $coinChartArrayResponse = CoinChartRequest::getCoinChartResponseContent( $coinId);
    $coinChartInstanceArrayResponse = CoinChartInstance::constructCoinChartArray($coinChartArrayResponse, $intCoinId);
    $coinsChartsArrayResponse[] = $coinChartInstanceArrayResponse;
}

$exchangeResponse = ExchangeRequest::getExchangeResponseContent();
$exchangeArrayResponse = Exchange::constructExchangeArray($exchangeResponse);

$trendingResponse = TrendingRequest::getTrendingResponseContent();
$trendingCoinsArrayResponse = TrendingCoin::constructTrendingCoinArray($trendingResponse);
$trendingNftArrayResponse = TrendingNft::constructTrendingNftArray($trendingResponse);


echo "Eliminando contenido de las tablas...<br>";

// Eliminar el contenido que ya había en la base de datos 
$ejecucionCorrecta = true;

try {
    $dbDeletor = new DBDeletor();
    
    $responseCode = $dbDeletor->deleteAllIntormationFromTables();
    if (!$responseCode) {
        echo "Ha habido algun problema eliminando el contenido de las tablas<br>";
        $ejecucionCorrecta = false;
    }
} catch (Exception $e) { echo "Error: " . $e->getMessage(); }

echo "Insertando el contenido en las tablas...<br>";

// Insertar todo el contenido en las bases de datos dados los arrays
try {
    $dbInsertor = new DBInsertor();

    $adminlog = new AdminLog(SYSTEM_ID,"reload",date('Y-m-d H:i:s'));
    
    $fullInformationArray = buildFullInformationArray($coinsArrayResponse, $coinsChartsArrayResponse, 
    $exchangeArrayResponse, $trendingCoinsArrayResponse, 
    $trendingNftArrayResponse);

    $responseCode = $dbInsertor->insertAdminLog($adminlog);
    if (!$responseCode) {
        echo "Ha habido algun problema insertando el log del cambio<br>";
        $ejecucionCorrecta = false;
    }

    $responseCode = $dbInsertor->insertAllInformation($fullInformationArray);
    if (!$responseCode) {
        echo "Ha habido algun problema insertando el contenido de las tablas<br>";
        $ejecucionCorrecta = false;
    }
} catch (Exception $e) { echo "Error: " . $e->getMessage(); }

if ($ejecucionCorrecta) {
    echo "Información de las tablas actualizada correctamente<br>";
    echo "Fecha de actualización: " . date('Y-m-d H:i:s') . "<br>"; 
}
else {
    echo "No se ha podido actualizar la información correctamente <br>";
}

function buildFullInformationArray( $coinsArrayResponse, $coinsChartsArrayResponse, 
                                    $exchangeArrayResponse, $trendingCoinsArrayResponse, 
                                    $trendingNftArrayResponse ) : array 
{
    return array (
        "coins" => $coinsArrayResponse,
        "coinsCharts" => $coinsChartsArrayResponse,
        "exchanges" => $exchangeArrayResponse,
        "trendingCoins" => $trendingCoinsArrayResponse,
        "trendingNfts" => $trendingNftArrayResponse,
    );
}