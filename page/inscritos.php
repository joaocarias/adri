<?php
session_start();

include_once '../app/view/InscritosView.php';

if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
    header("location: login.php");
}else{
    $view = new InscritosView("Inscritos");    
    echo $view->get("lista");  
}
