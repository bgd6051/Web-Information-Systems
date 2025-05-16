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
$filtroOrden = isset($_GET["filtroOrden"]) ? $_GET["filtroOrden"] : null;
$orderReversed = isOrderReversed($filtroOrden);
$listaHTMLFiltrada = filtrarLista($Nfiltro,$filtro,$orderReversed);
$fechaActualizacion = "<li class='listingsHeader'>".getUltimaAtualizacion()."</li>";
$mensajeListaVacia = "<li class='listingsHeader'>La lista esta vacia</li>";

if($listaHTMLFiltrada == null){
    echo $fechaActualizacion.$mensajeListaVacia;
    exit;
}
echo $fechaActualizacion.$listaHTMLFiltrada;


function filtrarLista($NLista, $filtro, $orderReversed){
    $listas = getLista($NLista,$orderReversed);
    if($listas == null){
        return null;
    }
    
    $HTML = "";
    $count = 0;
    foreach($listas as $lista){
        $thisHTML = "";
        if($lista == null){
            continue;
        }
        if($lista[0] == null){
            continue;
        }
        $elemTitleHTML = $lista[0]->titleHTML();
        $esVacio = true;
        foreach($lista as $elem){
            if(esFiltrado($elem,$filtro,$NLista,$count)){
                $elemHTML = $elem->toHTML();
                $thisHTML .= $elemHTML;
                $esVacio = false;
            } 
        }
        $count += 1;
        if($esVacio){
            continue;
        }
        $HTML .= $elemTitleHTML;
        $HTML .= $thisHTML;
    }
    return $HTML;
} 
function getLista($NLista, $orderReversed){
    if($NLista == null){
        return null;
    }
    $dbSelector = new DBSelector();
    if($NLista == 0){
        return [$dbSelector->getAllCoins("Current_price",$orderReversed)];
    }
    if($NLista == 1){
        return [$dbSelector->getAllTrendingNfts("floor_price_in_native_currency",$orderReversed),
                $dbSelector->getAllTrendingCoins("price",$orderReversed)];
    }
    if($NLista == 2){
        return [$dbSelector->getAllExchanges("year_established",$orderReversed)];
    }
    return null;
}

function esFiltrado($elem, $filtro, $NLista, $count): bool{
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
        if($count == 0){
            return ($elem->getFloorPriceInNativeCurrency() >= (float) $filtro);
        }
        if($count == 1){
            return ($elem->getPrice() >= (float) $filtro);
        }
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
    return "Ultima actualizacion fue guardada en ".$actualizaciones[0][0];
} 
function isOrderReversed($filtroOrden): ?bool{
    if($filtroOrden == null){
        return null;
    }
    if($filtroOrden == "asc"){
        return False;
    } 
    if($filtroOrden == "desc"){
        return True;
    } 
    return null;
} 
