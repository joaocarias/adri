<?php

namespace App\controller;

use App\view\AtendimentoView;

/**
 * Description of AtendimentoController
 *
 * @author joao.franca
 */
class AtendimentoController {
    public function novo(){
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{     
            $view = new AtendimentoView("Atendimento");
            echo $view->get("novo");
        }
    }
    
     public function paciente($params = null){
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            header("location: /home");
        }else{     
            $view = new AtendimentoView("Atendimento");
            echo $view->get("novo", $params );
        }
    }
}
