<?php
session_start();

include_once '../app/view/AvaliadoresView.php';

if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
    header("location: login.php");
}else{
    $view = new AvaliadoresView("Avaliador");
    
    $cadastro = filter_input(INPUT_GET, "cadastro", FILTER_SANITIZE_STRING);
    
    if($cadastro){
        echo $view->get("Avaliar");
    } else {
        echo $view->get();
    }
}


