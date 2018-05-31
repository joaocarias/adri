<?php
session_start();

include_once '../app/view/UnidadeView.php';

if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
    header("location: login.php");
}else{
    $view = new UnidadeView("Unidade");
    echo $view->get();
}