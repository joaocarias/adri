<?php
session_start();

include_once '../app/view/SobreView.php';


if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
    header("location: login.php");
}else{
    $view = new SobreView("Sobre");    
  
//    if($id_inscricao){
//        $params = array();
//        $params['id_inscricao'] = $id_inscricao;
//        
//        echo $view->get("exibir", $params);
//    }else{
        echo $view->get();
//    }
    
    
}