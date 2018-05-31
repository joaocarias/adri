<?php

include_once 'app/view/LoginView.php';

/**
 * Description of DashboardController
 *
 * @author joao
 */
class DashboardController {
    public function index(){          
        
    }
    
    public function dashboard(){
        $dashboard = new DashboardView("Dashboard");
        echo $dashboard->get();
    }
}
