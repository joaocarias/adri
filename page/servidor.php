<?php
session_start();

include_once '../app/view/ServidorView.php';

if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
    header("location: login.php");
}else{
    $view = new ServidorView("Servidor");
    
    $id_inscricao = filter_input(INPUT_GET, "idinscricao", FILTER_SANITIZE_STRING );
    
    if($id_inscricao){
        $params = array();
        $params['id_inscricao'] = $id_inscricao;
        
        echo $view->get("exibir", $params);
    }else{
        echo $view->get();
    }
    
    
}