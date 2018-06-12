<?php
session_start();

include_once '../app/view/AvaliarView.php';

if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
    header("location: login.php");
}else{
    $view = new AvaliarView("Avaliar");
    
    $n_inscricao = filter_input(INPUT_GET, "inscricao", FILTER_SANITIZE_STRING);
    
    if($n_inscricao){
        echo $view->get("parecer", $n_inscricao);
    }else{
        echo $view->get("lista");
    }
}


