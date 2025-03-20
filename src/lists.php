<?php

$Nfiltro = isset($_GET["Nfiltro"]) ? $_GET["Nfiltro"] : null;
$filtro = isset($_GET["filtro"]) ? $_GET["filtro"] : null;
/*
if($Nfiltro == 1){
    $lista = $dbSelector->getAllCoins();
    if(){
        $listaFiltrada = $lista;
    }else{
        $elemnum = 0;
        $listaFiltrada = [] ;
        foreach($lista as $elem){
            if($elem->getCurrentPrice() === (int) ){
                $listaFiltrada[$elemnum] = $elem;
                $elemnum += 1;
            } 
        } 
    } 
};
        $structuredSelection = [];
        foreach ($selection as $row) {
            $structuredSelection[$rownum] = new Exchange(
                $row[1],$row[2],$row[3],$row[4],
                $row[5],$row[6],
                $row[7],$row[0]);
*/    
if(1){
    echo "AJAX; filtro="+$Nfiltro+"&filtro="+$filtro;
};