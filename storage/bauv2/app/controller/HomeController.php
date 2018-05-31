<?php

namespace App\controller;

use App\view\LoginView;
use App\view\DashboardView;

/**
 * Description of HomeContoller
 *
 * @author joao.franca
 */
class HomeController {
    
    public function index(){  
        
        if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
            $login = new LoginView();
            echo $login->get();
        }else{
            $this->dashboard();
        }
    }
    
    public function dashboard(){
        $dashboard = new DashboardView("Dashboard");
        echo $dashboard->get();
    }
}
