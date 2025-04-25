<?php

header('Content-Type: application/json');

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

$username = $_SESSION["Username"] ?? null;

const SUBPAGE_TEMPLATE_PATH = "../../web/templates/subPage/";
$unauthorizedContent = file_get_contents(SUBPAGE_TEMPLATE_PATH . "unauthorizedDirectAccessContentSubpage.html");

if ($username === null || !isRegistered($username)) {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        echo json_encode(['error' => 'Unauthorized']);
    } else {
        echo $unauthorizedContent;
    }
    exit;
}

$graphs = getCoinChartGraphData();

if ($graphs === null || empty($graphs)) {
    echo json_encode(['error' => 'No hay gráficas disponibles']);
    exit;
}

echo json_encode($graphs);
exit;

function getCoinChartGraphData(): array
{
    $dbSelector = new DBSelector();
    $coins = $dbSelector->getAllCoins(null, null);
    $graphs = [];

    foreach ($coins as $coin) {
        $coinId = $coin->getID_COIN();
        $charts = $dbSelector->getCoinChartFromCoinId($coinId);

        $graph = [
            'titulo' => $coin->getName() ?? 'Criptomoneda',
            'labels' => [],
            'data' => []
        ];

        foreach ($charts as $chart) {
            $graph['labels'][] = date('c', $chart->getUnixTime()); // ISO 8601
            $graph['data'][] = $chart->getPrice();
        }

        $graphs[] = $graph;
    }

    return $graphs;
}

function isRegistered(string $username): bool
{
    $dbSelector = new DBSelector();
    $user = $dbSelector->getRegisteredUser($username);
    return !empty($user);
}
