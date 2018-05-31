<?php
session_start();
    
    if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
        header("location: page/login.php");
    }else{
        header("location: page/dashboard.php");
    }
    
    