<?php
session_start();

include_once '../app/model/Avaliador.php';

if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
    header("location: ../page/login.php?msg=nao_logado");
}else{
    
    $btn_salvar_unidade_administrador = filter_input(INPUT_POST, 'btn_salvar_unidade_administrador', FILTER_SANITIZE_STRING);
    $remover = filter_input(INPUT_GET, 'remover', FILTER_SANITIZE_STRING);
    
    if($btn_salvar_unidade_administrador){
        $tx_id_unidade = filter_input(INPUT_POST, 'tx_id_unidade', FILTER_SANITIZE_STRING);
        $hi_cadastro = filter_input(INPUT_POST, 'cadastro', FILTER_SANITIZE_STRING);
        $hi_id_servidor = filter_input(INPUT_POST, 'hi_id_servidor', FILTER_SANITIZE_STRING);
        
        $params = array(
                        "id_servidor" => $hi_id_servidor
                        , "id_unidade" => $tx_id_unidade                        
                        , "criado_por" => $_SESSION['id_servidor']
                    );

                $obj = new Avaliador();
                $retorno = $obj->insertObj("tb_avaliador", $params);
                
                $_SESSION['retorno'] =  $retorno;
          
        header('Location: ../page/avaliadores.php?lista=true');                
    }else if($remover){
        $avaliador = new Avaliador();
        $retorno = $avaliador->deleteObj($remover);
       // var_dump($retorno);
        header('Location: ../page/avaliadores.php?lista=true');       
       //   var_dump($_GET);
    }else{
        header('Location: ../page/avaliadores.php?lista=true');   
     //  var_dump($_GET);
    }
}


