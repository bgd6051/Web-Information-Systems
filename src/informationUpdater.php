<?php

spl_autoload_register(function ($class) {
    $directories = ['requestClasses', 'databaseClasses'];

    foreach ($directories as $dir) {
        $file = __DIR__ . "/$dir/$class.php";
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Conseguir respuestas de la API y construir arrays 
$coinsResponse = CoinRequest::getCoinResponseContent();
$coinsArrayResponse = Coin::constructCoinArray($coinsResponse);


$coinsChartsArrayResponse = [];
foreach (MAIN_COINS_ID as $coinId) {
    $coinChartArrayResponse = CoinChartRequest::getCoinChartResponseContent($coinId);
    $coinsArrayResponse = CoinChartInstance::constructCoinChartArray($coinsResponse, $coinId);
    $coinsChartsArrayResponse[] = $coinChartArrayResponse;
}

$exchangeResponse = ExchangeRequest::getExchangeResponseContent();
$exchangeArrayResponse = Exchange::constructExchangeArray($exchangeResponse);

$trendingResponse = TrendingRequest::getTrendingResponseContent();
$trendingCoinsArrayResponse = TrendingCoin::constructTrendingCoinArray($trendingResponse);
$trendingNftArrayResponse = TrendingNft::constructTrendingNftArray($trendingResponse);

// Eliminar el contenido que ya había en la base de datos 
$ejecucionCorrecta = true;
try {
    $dbDeletor = new DBDeletor();
    $responseCode = $dbDeletor->deleteAllIntormationFromTables();
    if (!$dbDeletor->isQuerySuccessful($responseCode)) {
        echo "Ha habido algun problema eliminando el contenido de las tablas";
        $ejecucionCorrecta = false;
    }
} catch (Exception $e) { }

// Insertar todo el contenido en las bases de datos dados los arrays
try {
    $dbInsertor = new DBInsertor();

    $fullInformationArray = buildFullInformationArray($coinsArrayResponse, $coinsChartsArrayResponse, 
    $exchangeArrayResponse, $trendingCoinsArrayResponse, 
    $trendingNftArrayResponse);
    
    $responseCode = $dbInsertor->insertAllInformation($fullInformationArray);
    if (!$dbDeletor->isQuerySuccessful($responseCode)) {
        echo "Ha habido algun problema insertando el contenido de las tablas";
        $ejecucionCorrecta = false;
    }
} catch (Exception $e) { }

if ($ejecucionCorrecta) {
    echo "Información de las tablas actualizada correctamente";
    echo "Fecha de actualización: " . date('Y-m-d H:i:s'); 
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

// Closing DB Connection
DBConnection::closeConnection();
