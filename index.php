<?php
session_start();
    
    if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
        header("location: https://natal.rn.gov.br/sms/remanejamentointerno/page/login.php");
    }else{
        header("location: https://natal.rn.gov.br/sms/remanejamentointerno/page/dashboard.php");
    }
    
    