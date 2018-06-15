<?php
session_start();

include_once '../app/view/ClassificacaoView.php';

if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
    header("location: login.php");
}else{
    $view = new ClassificacaoView("Classificação");
    
    $primeira_opcao = isset($_GET["primeira_opcao"]) ?  filter_input(INPUT_GET, "primeira_opcao", FILTER_SANITIZE_STRING) :  filter_input(INPUT_POST, "primeira_opcao", FILTER_SANITIZE_STRING);
           
    if($primeira_opcao){        
        echo $view->get("primeira_opcao");      
    }else{
        echo $view->get();      
    }
    
    
//    $cadastro = isset($_GET["cadastro"]) ? filter_input(INPUT_GET, "cadastro", FILTER_SANITIZE_STRING) : filter_input(INPUT_POST, "cadastro", FILTER_SANITIZE_STRING);
//    $lista = isset($_GET["lista"]) ? filter_input(INPUT_GET, "lista", FILTER_SANITIZE_STRING) : filter_input(INPUT_POST, "lista", FILTER_SANITIZE_STRING);
//        
//    if($cadastro){        
//        $param = isset($_POST["tx_buscar"]) ? filter_input(INPUT_POST, "tx_buscar", FILTER_SANITIZE_STRING) : null;
//        echo $view->get("cadastro", $param);
//    } else if($lista){
//        echo $view->get("lista");
//    } else {

//    }       
}