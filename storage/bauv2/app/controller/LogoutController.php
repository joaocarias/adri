<?php

namespace App\controller;

/**
 * Description of LogoutContoller
 *
 * @author joao.franca
 */
class LogoutController {
    public function logout(){
        session_destroy();
        header("Location: home");
    }
}
