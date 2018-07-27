<?php
session_start();

include_once '../app/view/RelatorioView.php';

if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
    header("location: login.php");
}else{
    $view = new RelatorioView("Relatórios");    
    
    $inscritos = isset($_GET["inscritos"]) ? filter_input(INPUT_GET, "inscritos", FILTER_SANITIZE_STRING) : filter_input(INPUT_POST, "inscritos", FILTER_SANITIZE_STRING);
    $classifica = isset($_GET["classifica"]) ? filter_input(INPUT_GET, "classifica", FILTER_SANITIZE_STRING) : filter_input(INPUT_POST, "classifica", FILTER_SANITIZE_STRING);
        
    if($inscritos){        
        $param = isset($_POST["tx_buscar"]) ? filter_input(INPUT_POST, "tx_buscar", FILTER_SANITIZE_STRING) : null;
        echo $view->get("inscritos", $param);
    } else if($classifica){
        echo $view->get("classifica");
    } else {
        echo $view->get();
    }  
}
