<?php


namespace Core;

/**
 * Description of Container
 *
 * @author joao.franca
 */
class Container {
    public static function newController($controller){             
        $controller_ = "App\\controller\\" . $controller;     
        return new $controller_;
    }   
}
