<?php
session_start();

include_once '../app/model/Administrador.php';

if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
    header("location: ../page/login.php?msg=nao_logado");
}else{
    var_dump($_GET);
    $inserir = filter_input(INPUT_GET, 'inserir', FILTER_SANITIZE_STRING);
    $remover = filter_input(INPUT_GET, 'remover', FILTER_SANITIZE_STRING);
    
    if($inserir){
        $params = array(
                        "id_servidor" => $inserir                        
                        , "criado_por" => $_SESSION['id_servidor']
                    );

                $obj = new Administrador();
                $retorno = $obj->insertObj("tb_administrador", $params);
                
                $_SESSION['retorno'] =  $retorno;
          
        header('Location: ../page/administradores.php?lista=true');                
    }else if($remover){
        $admin = new Administrador();
        $retorno = $admin->deleteObj($remover);
      
        header('Location: ../page/administradores.php?lista=true');                
    }else{
        header('Location: ../page/administradores.php?lista=true');                
   }
}