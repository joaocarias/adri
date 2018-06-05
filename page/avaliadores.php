<?php
session_start();

include_once '../app/view/AvaliadoresView.php';

if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
    header("location: login.php");
}else{
    $view = new AvaliadoresView("Avaliador");
    
    $cadastro = isset($_GET["cadastro"]) ? filter_input(INPUT_GET, "cadastro", FILTER_SANITIZE_STRING) : filter_input(INPUT_POST, "cadastro", FILTER_SANITIZE_STRING);
        
    if($cadastro){
        
        $param = isset($_POST["tx_buscar"]) ? filter_input(INPUT_POST, "tx_buscar", FILTER_SANITIZE_STRING) : null;
        echo $view->get("cadastro", $param);
    } else {
        echo $view->get();
    }
    
    
}