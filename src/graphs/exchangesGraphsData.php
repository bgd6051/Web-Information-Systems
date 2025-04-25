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
if ($username == null) {
    echo $content;
    exit;
}

if (!isRegistered($username)) {
    echo $content;
    exit;
}

$graphs = getExchangesGraphData();

if ($graphs == null) {
    echo 'no hay graficas';
    exit;
}
echo json_encode($graphs);

function getExchangesGraphData()
{
    $dbSelector = new DBSelector();
    $exchanges = $dbSelector->getAllExchanges(null, null);
    $graphs = [];
    $graph = [
        'titulo' => 'Volumen de comercio (24h) en BTC',
        'labels' => '',
        'data' => ''
    ];
    $labels = [];
    $data = [];
    foreach ($exchanges as $exchange) {
        $labels[] = $exchange->getName();
        $data[] = $exchange->getTradeVolume24hBtc();
        $roundedData = array_map(function ($valor) {
            return round($valor, 2);
        }, $data);
        $graph['labels'] = $labels;
        $graph['data'] = $roundedData;
    }
    $graphs[] = $graph;
    return $graphs;
}

function isRegistered($username): bool
{
    $dbSelector = new DBSelector();
    $user = $dbSelector->getRegisteredUser($username);
    if (empty($user)) {
        return false;
    }
    return true;
}