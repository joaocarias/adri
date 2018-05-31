<?php

namespace App\controller;
use App\model\Paciente;
use App\view\PacienteView;

/**
 * Description of PacienteController
 *
 * @author joao.franca
 */
class PacienteController {
    public function novo(){
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{     
            $view = new PacienteView("Paciente");
            echo $view->get("novo");
        }
    }
    
    public function lista(){
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{
            $view = new PacienteView("Paciente");
            echo $view->get("lista");
        }
    }
    
    public function buscar(){
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{
            $view = new PacienteView("Paciente");
            echo $view->get("buscar");
        }
    }
    
    public function addpaciente(){
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{
            
            $tx_nome = filter_input(INPUT_POST, "tx_nome", FILTER_SANITIZE_STRING);
            $tx_cpf = filter_input(INPUT_POST, "tx_cpf", FILTER_SANITIZE_STRING);
            $tx_cartao_sus = filter_input(INPUT_POST, "tx_cartao_sus", FILTER_SANITIZE_STRING);
            
            $tx_genero = filter_input(INPUT_POST, "tx_genero", FILTER_SANITIZE_STRING);
            $tx_rg = filter_input(INPUT_POST, "tx_rg", FILTER_SANITIZE_STRING);            
            $tx_data_de_nascimento = filter_input(INPUT_POST,"tx_data_de_nascimento", FILTER_SANITIZE_STRING);

            $tx_estado_civil = filter_input(INPUT_POST,"tx_estado_civil", FILTER_SANITIZE_STRING);
            $tx_responsavel = filter_input(INPUT_POST,"tx_responsavel", FILTER_SANITIZE_STRING);           
            $tx_telefone = filter_input(INPUT_POST, "tx_telefone", FILTER_SANITIZE_STRING);
            
            $tx_profissao = filter_input(INPUT_POST, "tx_profissao", FILTER_SANITIZE_STRING);
            
            $tx_cep = filter_input(INPUT_POST, "tx_cep", FILTER_SANITIZE_STRING);
            $tx_logradouro = filter_input(INPUT_POST, "tx_logradouro", FILTER_SANITIZE_STRING);
            $tx_numero = filter_input(INPUT_POST, "tx_numero", FILTER_SANITIZE_STRING);
            $tx_bairro = filter_input(INPUT_POST, "tx_bairro", FILTER_SANITIZE_STRING);
            
            $tx_cidade = filter_input(INPUT_POST, "tx_cidade", FILTER_SANITIZE_STRING);
            $tx_uf = filter_input(INPUT_POST, "tx_uf", FILTER_SANITIZE_STRING);
                      
            $btn_salvar = filter_input(INPUT_POST,"btn_salvar", FILTER_SANITIZE_STRING);
                       
            if($btn_salvar){
                
                 $params = array(
                        "nome" => $tx_nome
                        , "cpf" => $tx_cpf
                        , "cartao_sus" => $tx_cartao_sus
                        , "genero" => $tx_genero
                        , "rg" => $tx_rg
                        , "data_de_nascimento" => $tx_data_de_nascimento
                        , "id_estado_civil" => $tx_estado_civil
                        , "responsavel" => $tx_responsavel                        
                        , "telefone" => $tx_telefone
                        , "id_profissao" => $tx_profissao
                        , "cep" => $tx_cep
                        , "logradouro" => $tx_logradouro
                        , "numero" => $tx_numero
                        , "bairro" => $tx_bairro
                        , "cidade" => $tx_cidade
                        , "uf" => $tx_uf
                        , "criado_por" => $_SESSION['id_usuario']
                    );

                $obj = new Paciente();
                $retorno = $obj->insertObj("tb_paciente", $params);
                
                $_SESSION['retorno'] =  $retorno;
                
                header("location: /paciente/lista");                
            }else{
                header("location: /home");
            }  
        }
    }
}

