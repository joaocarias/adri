<?php
session_start();

include_once '../app/view/InscricaoView.php';

//var_dump($_SESSION);
if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
    header("location: login.php");
}else{
    $view = new InscricaoView("Inscrição");
    echo $view->get();
}

