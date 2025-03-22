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

$Nfiltro = isset($_GET["Nfiltro"]) ? $_GET["Nfiltro"] : null;
$filtro = isset($_GET["filtro"]) ? $_GET["filtro"] : null;

$listaHTMLFiltrada = filtrarLista($Nfiltro,$filtro);
$fechaActualizacion = "<li>".getUltimaAtualizacion()."<li>";

if($listaHTMLFiltrada == null){
    echo $fechaActualizacion;
}else{
    echo $fechaActualizacion.$listaHTMLFiltrada;
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
    if($lista[0] != null){
        $elemTitleHTML = $lista[0]->titleHTML();
        $HTML = $elemTitleHTML.$HTML;
    }
    return $HTML;
} 
function getLista($NLista){
    if($NLista == null){
        return null;
    }
    $dbSelector = new DBSelector();
    if($NLista == 0){
        return $dbSelector->getAllCoins();
    }
    if($NLista == 1){
        return $dbSelector->getAllTrendingNfts();
    }
    if($NLista == 2){
        return $dbSelector->getAllExchanges();
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

    if($NLista == 0){
        return ($elem->getCurrentPrice() >= (int) $filtro);
    }
    if($NLista == 1){
        return ($elem->getFloorPrice24hPercentageChange() >= (float) $filtro);
    }
    if($NLista == 2){
        return ($elem->getCountry() == $filtro);
    }
    return True;
} 

function getUltimaAtualizacion(){
    $dbSelector = new DBSelector();
    $actualizaciones = $dbSelector->getLastAdminLog();
    if($actualizaciones == null){
        return "Ultima actualizacion no guardada";
    }
    return "Ultima actualizacion fue guardada en ".$actualizaciones[0];
} 