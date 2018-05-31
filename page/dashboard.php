<?php
session_start();

include_once '../app/view/DashboardView.php';

//var_dump($_SESSION);
if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
    header("location: login.php");
}else{
    $view = new DashboardView("Início");
    echo $view->get();
}

