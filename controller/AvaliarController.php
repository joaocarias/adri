<?php
session_start();

include_once '../app/model/Avaliacao.php';

if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
    header("location: ../page/login.php?msg=nao_logado");
}else{

    $btn_salvar = filter_input(INPUT_POST, "btn_salvar", FILTER_SANITIZE_STRING);

    if($btn_salvar){
        $nota1 = filter_input(INPUT_POST, "nota1", FILTER_SANITIZE_STRING);
        $nota2 = filter_input(INPUT_POST, "nota2", FILTER_SANITIZE_STRING);
        $nota3 = filter_input(INPUT_POST, "nota3", FILTER_SANITIZE_STRING);
        $nota4 = filter_input(INPUT_POST, "nota4", FILTER_SANITIZE_STRING);
        $nota5 = filter_input(INPUT_POST, "nota5", FILTER_SANITIZE_STRING);
        $pergunta6 = filter_input(INPUT_POST, "pergunta6", FILTER_SANITIZE_STRING);
        $pergunta7 = filter_input(INPUT_POST, "pergunta7", FILTER_SANITIZE_STRING);
        $pergunta8 = filter_input(INPUT_POST, "pergunta8", FILTER_SANITIZE_STRING);
        $pergunta9 = filter_input(INPUT_POST, "pergunta9", FILTER_SANITIZE_STRING);
        $hi_id_inscricao = filter_input(INPUT_POST, "hi_id_inscricao", FILTER_SANITIZE_STRING);
        
        $params = array(
                        "id_inscricao" => $hi_id_inscricao
                        , "nota1" => $nota1
                        , "nota2" => $nota2
                        , "nota3" => $nota3
                        , "nota4" => $nota4
                        , "nota5" => $nota5
                        , "pergunta6" => $pergunta6
                        , "pergunta7" => $pergunta7
                        , "pergunta8" => $pergunta8
                        , "pergunta9" => $pergunta9                        
                        , "id_avaliador" => $_SESSION['id_servidor']
                    );      
        
        
            $obj = new Avaliacao();
            $retorno = $obj->insertObj("tb_avaliacao", $params);
                
            $_SESSION['retorno'] =  $retorno;
          
        header('Location: ../page/avaliar.php?lista=true');   
      
    }else{     
        header('Location: ../page/avaliar.php?lista=true');        
    }       
    
}

