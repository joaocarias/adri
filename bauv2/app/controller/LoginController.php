<?php

namespace App\controller;

use App\model\Usuario;
use App\model\LogAcesso;

/**
 * Description of LoginController
 *
 * @author joao.franca
 */
class LoginController {
    public function login(){
        
        $loginUsername = filter_input(INPUT_POST, "loginUsername", FILTER_SANITIZE_STRING);
        $loginPassword = filter_input(INPUT_POST, "loginPassword", FILTER_SANITIZE_STRING);
        $btnLogin = filter_input(INPUT_POST,"btnLogin", FILTER_SANITIZE_STRING);
                
        if($btnLogin){
            $user = new Usuario();
            $login = new LogAcesso();
            $dados = $user->getObjPorLogin($loginUsername);
            
            foreach ($dados as $row){  
                if(password_verify($loginPassword, $row->senha)){
                    $_SESSION['id_usuario'] = $row->id_usuario;
                    $_SESSION['nome'] = $row->nome;
                    $_SESSION['cpf'] = $row->cpf;
                    $_SESSION['genero'] = $row->genero;
                    $_SESSION['logado'] = '1';                   
                    
                    $login->insertObj($row->id_usuario, $loginUsername, "PERMITIDO");                    
                }else{
                    $_SESSION['logado'] = '0';            
                    $login->insertObj(null, $loginUsername, "NEGADO");
                }   
            }
        }else{
            $_SESSION['logado'] = '0';            
        }       
        
        header("location: home");
    }
}
