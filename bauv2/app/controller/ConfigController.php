<?php

namespace App\controller;
use App\view\TipoAtendimentoView;
use App\model\TipoAtendimento;

/**
 * Description of ConfigController
 *
 * @author joao.franca
 */
class ConfigController {
    public function tipoatendimento($params = null){
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{
            $view = new TipoAtendimentoView("Tipo de Atendimento");            
            
            if(!is_null($params)){
                echo $view->get("editar", $params);
            }else{
                echo $view->get("lista");
            }
        }
    }
    
    public function novotipoatendimento($params = null){
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{
            $view = new TipoAtendimentoView("Configurações");  
                echo $view->get("novo");            
        }
    }
    
    public function addtipoatendimento(){
       if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{
            $tx_tipo_atendimento = filter_input(INPUT_POST, "tx_tipo_atendimento", FILTER_SANITIZE_STRING);
           
            $btn_salvar = filter_input(INPUT_POST,"btn_salvar", FILTER_SANITIZE_STRING);

            if($btn_salvar){

                $params = array(
                        "tipo_atendimento" => $tx_tipo_atendimento                        
                        , "criado_por" => $_SESSION['id_usuario']
                    );

                $obj = new TipoAtendimento();
                $retorno = $obj->insertObj("tb_tipo_atendimento", $params);
                
                $_SESSION['retorno'] =  $retorno;
                
                header("location: /config/tipoatendimento");                
            }else{
                header("location: /home");
            }  
        }
    }
    
     public function edittipoatendimento($params = null){
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{
            $view = new TipoAtendimentoView("Configurações");            
            
            if(!is_null($params)){
                echo $view->get("editar", $params);
            }else{
                echo $view->get("lista");
            }
        }
    }
    
    public function updatetipoatendimento(){
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{
            $hi_id_obj = filter_input(INPUT_POST, "hi_id_obj", FILTER_SANITIZE_STRING);
            
            $tx_tipo_atendimento = filter_input(INPUT_POST, "tx_tipo_atendimento", FILTER_SANITIZE_STRING);

            $btn_salvar = filter_input(INPUT_POST,"btn_salvar", FILTER_SANITIZE_STRING);

            if($btn_salvar){

                $objNew = new TipoAtendimento();
                $objOrig = $objNew->selectObj($hi_id_obj);
                
                $paramSet = array();
                
                if(isset($objOrig) and !is_null($objOrig)){
                    $log = "";
                    
                    if($objOrig->getTipo_atendimento() != $tx_tipo_atendimento){
                        $log .= " : tipo_atendimento: ".$objOrig->getTipo_atendimento()." - ".$tx_tipo_atendimento;
                        $paramSet["tipo_atendimento"] = $tx_tipo_atendimento;
                    }
                    
                    $paramSet["modificado_por"] = $_SESSION['id_usuario'];                   
                }else{
                    
                }
                
                $paramWhere["id_tipo_atendimento"] = $hi_id_obj;

                $objO = new TipoAtendimento();
                $retorno = $objO->updateObj("tb_tipo_atendimento", $paramSet, $paramWhere);
                
                $_SESSION['retorno'] =  $retorno;
                
                header("location: /config/edittipoatendimento/{$hi_id_obj}"); 
                
            }else{
                header("location: /home");
            }  
        }
    }
    
    public function deletetipoatendimento($params = null){
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{
            $view = new TipoAtendimentoView("Profissão");
            
            if(!is_null($params)){
                $user = new TipoAtendimento();
                $retorno = $user->deleteObj($params[0]);
                
                 $_SESSION['retorno'] =  $retorno;
                
                echo $view->get("lista");
            }else{
                echo $view->get("lista");
            }
        }
    }
}
