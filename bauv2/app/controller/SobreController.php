<?php

namespace App\controller;
use App\view\SobreView;

/**
 * Description of SobreController
 *
 * @author joao.franca
 */
class SobreController {
    public function sobre(){
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            $login = new LoginView();
            echo $login->get();
        }else{
            $view = new SobreView("Sobre");
            echo $view->get();
        }
    }
}
