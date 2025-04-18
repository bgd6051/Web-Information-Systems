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

$username = isset($_SESSION["Username"]) ? $_SESSION["Username"] : null;
$Ngraph = isset($_GET["Ngraph"]) ? $_GET["Ngraph"] : null;

const SUBPAGE_TEMPLATE_PATH = "../../web/templates/subPage/";
$content = file_get_contents(SUBPAGE_TEMPLATE_PATH . "unauthorizedDirectAccessContentSubpage.html");
if($username==null){
    echo $content;
    exit;
}

if(isRegistered($newUsername)){
    echo $content;
    exit;
}

$graphs = getGraphs($Ngraph);

if($graphs == null){
    echo 'no hay graficas';
    exit;
}
echo $graphs;


function getGraphs($Ngraph){
    $graphs = getGraphsData($Ngraph);// GraphList[ Graph[ Data['y','x']]] 
    if($graphs == null){
        return null;
    }
    return json_encode($graphs);
} 
function getGraphsData($Ngraph){//lista de graficas ToDo
    if($Ngraph == null){
        return null;
    }
    if($Ngraph == 0){
        return getCoinChartGraphData();
    }
    if($Ngraph == 1){
        return getTrendingGraphData();
    }
    if($Ngraph == 2){
        return getExchangesGraphData();
    }
    return null;
}

function getCoinChartGraphData(){
    $dbSelector = new DBSelector();
    $coins = $dbSelector->getAllCoins(null,null);
    $graphs = [];
    foreach($coins as $coin){
        $coinId = $coin->getID_COIN();
        $charts = $dbSelector->getCoinChartFromCoinId($coinId);
        $graph = [];
        foreach($charts as $chart){
            $graph[] = ['y' => $chart->getPrice(),'x' => $chart->getUnixTime()] ;
        } 
        $graphs[] = $graph;
    } 
    return $graphs;
} 

function getTrendingGraphData(){
    $dbSelector = new DBSelector();
    $trending = $dbSelector->getAllTrendingNfts(null,null);
    $graphs = [];
    $graph = [];
    foreach($trending as $trendingElement){
        $graph[] = ['y' => $trendingElement->getFloorPrice24hPercentageChange(),'x' => $trendingElement->getName()] ;
    } 
    $graphs[] = $graph;
    $trending = $dbSelector->getAllTrendingCoins(null,null);
    foreach($trending as $trendingElement){
        $graph[] = ['y' => $trendingElement->getPriceChangePercentage24h(),'x' => $trendingElement->getName()] ;
    }
    $graphs[] = $graph;
    return $graphs;
} 

function getExchangesGraphData(){
    $dbSelector = new DBSelector();
    $exchanges = $dbSelector->getAllExchanges(null,null);
    $graphs = [];
    $graph = [];
    foreach($exchanges as $exchange){
        $graph[] = ['y' => $exchange->getTradeVolume24hBtc(),'x' => $exchange->getName()] ;
    } 
    $graphs[] = $graph;
    return $graphs;
} 

function isRegistered($username): bool{
    $dbSelector = new DBSelector();
    $user = $dbSelector->getRegisteredUser($username);
    if(empty($user)){
        return false;
    }
    return true;
} 