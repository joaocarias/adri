<?php
session_start();

include_once '../app/view/ContatoView.php';


if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
    header("location: login.php");
}else{
    $view = new ContatoView("Contato");    
    
    echo $view->get();   
    
}