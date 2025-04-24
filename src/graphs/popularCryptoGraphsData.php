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

session_start();

$username = isset($_SESSION["Username"]) ? $_SESSION["Username"] : null;

const SUBPAGE_TEMPLATE_PATH = "../../web/templates/subPage/";
$content = file_get_contents(SUBPAGE_TEMPLATE_PATH . "unauthorizedDirectAccessContentSubpage.html");
if($username==null){
    echo $content;
    exit;
}

if(!isRegistered($username)){
    echo $content;
    exit;
}

$graphs = getTrendingGraphData();

if($graphs == null){
    echo 'no hay graficas';
    exit;
}
echo json_encode($graphs);

function getTrendingGraphData(){
    $dbSelector = new DBSelector();
    $trending = $dbSelector->getAllTrendingNfts(null,null);
    $graphs = [];
    $graph = ['titulo'=>'Distribución de NFTs',
        'labels' => [],
        'data' => []];
    $labels = []; 
    $data = []; 
    foreach($trending as $trendingElement){
        $labels[] = $trendingElement->getName();
        $data[] = $trendingElement->getFloorPrice24hPercentageChange();
        $graph['labels'] = $labels;
        $graph['data'] = $data;
    } 
    $graphs[] = $graph;
    $trending = $dbSelector->getAllTrendingCoins(null,null);
    $graph = ['titulo'=>'Distribución de Criptomonedas',
        'labels' => [],
        'data' => []];
    $labels = []; 
    $data = []; 
    foreach($trending as $trendingElement){
        $labels[] = $trendingElement->getName();
        $data[] = $trendingElement->getPriceChangePercentage24h();
        $graph['labels'] = $labels;
        $graph['data'] = $data;
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