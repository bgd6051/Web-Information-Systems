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

$graphs = getCoinChartGraphData();

if($graphs == null){
    echo 'no hay graficas';
    exit;
}
echo json_encode($graphs);

function getCoinChartGraphData(){
    $dbSelector = new DBSelector();
    $coins = $dbSelector->getAllCoins(null,null);
    $graphs = [];
    foreach($coins as $coin){
        $coinId = $coin->getID_COIN();
        $charts = $dbSelector->getCoinChartFromCoinId($coinId);
        $graph = ['titulo' => 'Distribución de NFTs',
        'labels' => '',
        'data' => ''];
        $labels = []; 
        $data = []; 
        foreach($charts as $chart){
            $labels[] = $chart->getUnixTime();
            $data[] = $chart->getPrice();
            $graph['labels'] = $labels;
            $graph['data'] = $data;
        } 
        $graphs[] = $graph;
    } 
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