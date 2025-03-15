<?php

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

$ejecucionCorrecta = true;
echo "Comienzo<br>";
echo "Seleccionando<br>";
try {
    $dbSelector = new DBSelector();
    $arrays = array (
        "coins" => $dbSelector->getAllCoins(),
        "adminLogs" => $dbSelector->getAllAdminLogs(),
        "userRegistrations" => $dbSelector->getAllUserRegistrations(),
        "trendingCoins" => $dbSelector->getAllTrendingCoins(),
        "exchanges" => $dbSelector->getAllExchanges(),
        "trendingNfts" => $dbSelector->getAllTrendingNfts(),
        "coinsCharts" => $dbSelector->getAllCoinChart()
    );
} catch (Exception $e) { echo "Error: " . $e->getMessage(); }