<?php

spl_autoload_register(function ($class) {
    $directories = ['databaseClasses', 'databaseClasses/databaseModelClasses/'];

    foreach ($directories as $dir) {
        $file = __DIR__ . "/$dir/$class.php";
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }

});

$Nfiltro = isset($_GET["Nfiltro"]) ? $_GET["Nfiltro"] : null;
$filtro = isset($_GET["filtro"]) ? $_GET["filtro"] : null;

$listaHTMLFiltrada = filtrarLista($Nfiltro,$filtro);

if($listaHTMLFiltrada == null){
    echo "eror en el filtrado de la lista";
}else{
    echo $listaHTMLFiltrada;
};

function filtrarLista($NLista,$filtro){
    $lista = getLista($NLista);
    if($lista == null){
        return null;
    }
    
    $HTML = "";
    foreach($lista as $elem){
        if(esFiltrado($elem,$filtro,$NLista)){
            $elemHTML = $elem->toHTML();
            $HTML .= $elemHTML;
        } 
    }
    return $HTML;
} 
function getLista($NLista){
    if($NLista == null){
        return null;
    }
    $dbSelector = new DBSelector();
    if($NLista == 1){
        return $dbSelector->getAllCoins();
    }
    if($NLista == 2){
        return $dbSelector->getAllTrendingNfts();
    }
    if($NLista == 3){
        return $dbSelector->getAllCoinChart();
    }
    return null;
}

function esFiltrado($elem,$filtro,$NLista): bool{
    if($filtro == null){
        return True;
    }
    if($filtro == "none"){
        return True;
    }

    if($NLista == 1){
        return ($elem->getCurrentPrice() <= (int) $filtro);
    }
    if($NLista == 2){
        return ($elem->getFloorPrice24hPercentageChange() <= (float) $filtro);
    }
    if($NLista == 3){
        return ($elem->getPrice() <= (float) $filtro);
    }
    return True;
} 