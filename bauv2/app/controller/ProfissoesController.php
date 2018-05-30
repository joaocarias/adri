<?php

namespace App\controller;
use App\view\ProfissoesView;
use App\model\Profissao;


/**
 * Description of ProfissoesController
 *
 * @author joao.franca
 */
class ProfissoesController {
    public function novo(){
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{
            $view = new ProfissoesView("Profissão");
            echo $view->get("novo");
        }
    }
    
    public function lista(){
       if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{
            $view = new ProfissoesView("Profissão");
            echo $view->get("lista");
        }
    }
    
    public function addprofissao(){
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{
            $tx_profissao = filter_input(INPUT_POST, "tx_profissao", FILTER_SANITIZE_STRING);
           
            $btn_salvar = filter_input(INPUT_POST,"btn_salvar", FILTER_SANITIZE_STRING);

            if($btn_salvar){

                $params = array(
                        "profissao" => $tx_profissao                        
                        , "criado_por" => $_SESSION['id_usuario']
                    );

                $obj = new Profissao();
                $retorno = $obj->insertObj("tb_profissao", $params);
                
                $_SESSION['retorno'] =  $retorno;
                
                header("location: /profissoes/lista");                
            }else{
                header("location: /home");
            }  
        }
    }
    
    public function editprofissao($params = null){
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{
            $view = new ProfissoesView("Profissão");            
            
            if(!is_null($params)){
                echo $view->get("editar", $params);
            }else{
                echo $view->get("lista");
            }
        }
    }
    
    public function updateprofissao(){
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{
            $hi_id_obj = filter_input(INPUT_POST, "hi_id_obj", FILTER_SANITIZE_STRING);
            
            $tx_profissao = filter_input(INPUT_POST, "tx_profissao", FILTER_SANITIZE_STRING);

            $btn_salvar = filter_input(INPUT_POST,"btn_salvar", FILTER_SANITIZE_STRING);

            if($btn_salvar){

                $objNew = new Profissao();
                $objOrig = $objNew->selectObj($hi_id_obj);
                
                $paramSet = array();
                
                if(isset($objOrig) and !is_null($objOrig)){
                    $log = "";
                    
                    if($objOrig->getProfissao() != $tx_nome){
                        $log .= " : profissao: ".$objOrig->getProfissao()." - ".$tx_profissao;
                        $paramSet["profissao"] = $tx_profissao;
                    }
                    
                    $paramSet["modificado_por"] = $_SESSION['id_usuario'];                   
                }else{
                    
                }
                
                $paramWhere["id_profissao"] = $hi_id_obj;

                $objO = new Profissao();
                $retorno = $objO->updateObj("tb_profissao", $paramSet, $paramWhere);
                
                $_SESSION['retorno'] =  $retorno;
                
                header("location: /profissoes/editprofissao/{$hi_id_obj}"); 
                
            }else{
                header("location: /home");
            }  
        }
    }
    
    public function deleteprofissao($params = null){
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{
            $view = new ProfissoesView("Profissão");
            
            if(!is_null($params)){
                $user = new Profissao();
                $retorno = $user->deleteObj($params[0]);
                
                 $_SESSION['retorno'] =  $retorno;
                
                echo $view->get("lista");
            }else{
                echo $view->get("lista");
            }
        }
    }
}
