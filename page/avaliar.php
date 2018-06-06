<?php
session_start();

include_once '../app/view/AvaliarView.php';

if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
    header("location: login.php");
}else{
    $view = new AvaliarView("Avaliar");
   
    echo $view->get("lista");
   
}


