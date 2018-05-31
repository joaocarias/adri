<?php

namespace App\controller;

use App\view\UserView;
use App\view\LoginView;
use App\model\Usuario;
use Lib\Auxiliar;
use App\model\LogEdicao;


/**
 * Description of UserController
 *
 * @author joao.franca
 */
class UserController {
    public function novo(){
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{
            $view = new UserView("Usuário");
            echo $view->get("novo");
        }
    }
    
    public function lista(){
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{
            $view = new UserView("Usuário");
            echo $view->get("lista");
        }
    }
    
    public function edituser($params = null){
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{
            $view = new UserView("Usuário");            
            
            if(!is_null($params)){
                echo $view->get("editar", $params);
            }else{
                echo $view->get("lista");
            }
        }
    }
    
    public function updateuser(){
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{
            $hi_id_obj = filter_input(INPUT_POST, "hi_id_obj", FILTER_SANITIZE_STRING);
            
            $tx_nome = filter_input(INPUT_POST, "tx_nome", FILTER_SANITIZE_STRING);
            $tx_cpf = filter_input(INPUT_POST, "tx_cpf", FILTER_SANITIZE_STRING);
            $tx_data_de_nascimento = filter_input(INPUT_POST,"tx_data_de_nascimento", FILTER_SANITIZE_STRING);

            $tx_genero = filter_input(INPUT_POST, "tx_genero", FILTER_SANITIZE_STRING);
            $tx_telefone = filter_input(INPUT_POST, "tx_telefone", FILTER_SANITIZE_STRING);
            $tx_email = filter_input(INPUT_POST,"tx_email", FILTER_SANITIZE_STRING);

            $btn_salvar = filter_input(INPUT_POST,"btn_salvar", FILTER_SANITIZE_STRING);

            if($btn_salvar){

                $user = new Usuario();
                $objOrig = $user->selectObj($hi_id_obj);
                
                $paramSet = array();
                
                if(isset($objOrig) and !is_null($objOrig)){
                    $log = "";
                    
                    if($objOrig->getNome() != $tx_nome){
                        $log .= " : nome: ".$objOrig->getNome()." - ".$tx_nome;
                        $paramSet["nome"] = $tx_nome;
                    }
                    
                    if($objOrig->getCpf() != $tx_cpf){
                        $log .= " : cpf: ".$objOrig->getCpf()." - ".$tx_cpf;
                        $paramSet["cpf"] = $tx_cpf;
                    }
                    
                    if($objOrig->getData_de_nascimento() != $tx_data_de_nascimento){
                        $log .= " : data_de_nascimento: ".$objOrig->getData_de_nascimento()." - ".$tx_data_de_nascimento;
                        $paramSet["data_de_nascimento"] = $tx_data_de_nascimento;
                    }
                    
                    if($objOrig->getGenero() != $tx_genero){
                        $log .= " : genero: ".$objOrig->getGenero()." - ".$tx_genero;
                        $paramSet["genero"] = $tx_genero;
                    }
                    
                    if($objOrig->getEmail() != $tx_email){
                        $log .= " : email: ".$objOrig->getEmail()." - ".$tx_email;
                        $paramSet["email"] = $tx_email;
                    }
                    
                    if($objOrig->getTelefone() != $tx_telefone){
                        $log .= " : telefone: ".$objOrig->getTelefone()." - ".$tx_telefone;
                        $paramSet["telefone"] = $tx_telefone;
                    }
                    
                    $paramSet["modificado_por"] = $_SESSION['id_usuario'];                   
                }else{
                    
                }
                
                $paramWhere["id_usuario"] = $hi_id_obj;

                $usuario = new Usuario();
                $retorno = $usuario->updateObj("tb_usuario", $paramSet, $paramWhere);
                
                $_SESSION['retorno'] =  $retorno;
                
                $logObj = new LogEdicao("tb_usuario", $hi_id_obj, "UPDATE: ".$log." ".$retorno['msg_tipo']." : ".$retorno['msg'] );   
                $logObj->inserir();
                
                header("location: /user/edituser/{$hi_id_obj}"); 
                
            }else{
                header("location: /home");
            }  
        }
    }
    
    public function adduser(){
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{
            $tx_nome = filter_input(INPUT_POST, "tx_nome", FILTER_SANITIZE_STRING);
            $tx_cpf = filter_input(INPUT_POST, "tx_cpf", FILTER_SANITIZE_STRING);
            $tx_data_de_nascimento = filter_input(INPUT_POST,"tx_data_de_nascimento", FILTER_SANITIZE_STRING);

            $tx_genero = filter_input(INPUT_POST, "tx_genero", FILTER_SANITIZE_STRING);
            $tx_telefone = filter_input(INPUT_POST, "tx_telefone", FILTER_SANITIZE_STRING);
            $tx_email = filter_input(INPUT_POST,"tx_email", FILTER_SANITIZE_STRING);

            $btn_salvar = filter_input(INPUT_POST,"btn_salvar", FILTER_SANITIZE_STRING);

            if($btn_salvar){

                $params = array(
                        "nome" => $tx_nome
                        , "cpf" => $tx_cpf
                        , "data_de_nascimento" => $tx_data_de_nascimento
                        , "genero" => $tx_genero
                        , "email" => $tx_email
                        , "telefone" => $tx_telefone
                        , "login" => $tx_cpf
                        , "senha" => password_hash(Auxiliar::getSenhaPadrao(), PASSWORD_DEFAULT)
                        , "criado_por" => $_SESSION['id_usuario']
                    );

                $usuario = new Usuario();
                $retorno = $usuario->insertObj("tb_usuario", $params);
                
                $_SESSION['retorno'] =  $retorno;
                
                header("location: /user/lista");                
            }else{
                header("location: /home");
            }  
        }
    }
    
    public function deleteuser($params = null){
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{
            $view = new UserView("Usuário");            
            
            if(!is_null($params)){
                $user = new Usuario();
                $retorno = $user->deleteObj($params[0]);
                
                $_SESSION['retorno'] =  $retorno;
                 
                $log = new LogEdicao("tb_usuario", $params[0], "DELETE: ".$retorno['msg_tipo']." : ".$retorno['msg'] );   
                $log->inserir();
                
                echo $view->get("lista");
            }else{
                echo $view->get("lista");
            }
        }
    }
    
}

