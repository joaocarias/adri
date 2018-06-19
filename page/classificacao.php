<?php
session_start();

include_once '../app/view/ClassificacaoView.php';

if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
    header("location: login.php");
}else{
    $view = new ClassificacaoView("Classificação");
    
    $primeira_opcao = isset($_GET["primeira_opcao"]) ?  filter_input(INPUT_GET, "primeira_opcao", FILTER_SANITIZE_STRING) :  filter_input(INPUT_POST, "primeira_opcao", FILTER_SANITIZE_STRING);
    $segunda_opcao = isset($_GET["segunda_opcao"]) ?  filter_input(INPUT_GET, "segunda_opcao", FILTER_SANITIZE_STRING) :  filter_input(INPUT_POST, "segunda_opcao", FILTER_SANITIZE_STRING);
    $terceira_opcao = isset($_GET["terceira_opcao"]) ?  filter_input(INPUT_GET, "terceira_opcao", FILTER_SANITIZE_STRING) :  filter_input(INPUT_POST, "terceira_opcao", FILTER_SANITIZE_STRING);
           
    if($primeira_opcao){        
        echo $view->get("primeira_opcao");
    }else if($segunda_opcao){        
        echo $view->get("segunda_opcao");
    }else if($terceira_opcao){        
        echo $view->get("terceira_opcao");
    }else{
        echo $view->get();      
    }         
}