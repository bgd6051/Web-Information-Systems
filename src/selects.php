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

function selectToArray($select){
    $rownum = 0;
    $Array = [];
    while ($row = $select->fetch_array(MYSQLI_ASSOC)) {
        $Array[$rownum] = $row;
        $rownum += 1;
    }
    return $Array;
}

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

echo "mostrando<br>";
foreach ($arrays as $selection){
    $coinArray = selectToArray($selection);
    foreach ($coinArray as $row) {
        foreach ($row as $elem) {
            print "$elem ";
        }
        print "<br>";
    }
    print "<br><br>";
}