<?php

namespace Core;

/**
 * Description of Router
 *
 * @author joao.franca
 */
class Router {
    private $routes;
    private $url;

    private $explode;    
    
    public function __construct(array $routes) {
        $this->setRoutes($routes);
        $this->run();
    }
    
    private function setExplode(){
        $this->explode = explode("/", $this->url);
    }
    
    private function setUrl(){
        $this->url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
    
    private function setRoutes($routes){
        foreach ($routes as $route){
            $explode = explode("@", $route[1]);
            $r = [$route[0], $explode[0], $explode[1]];            
            $newRoutes[] = $r;
        }
        $this->routes = $newRoutes;
    }
    private function getUrl(){
        return $this->url;
    }  
           
    private function run(){
        
        $param = array();
        
        $this->setUrl();
        $this->setExplode();
        
        $found = true;
        $controller = null;
        
        $uri = "";
        foreach ($this->routes as $route){
            $routeArray = explode("/", $route[0]);
                       
           
            if(count($this->explode) > 3){                
                $uri = "/{$this->explode[1]}/{$this->explode[2]}";                
            }else{
                $uri = $this->url;
            }
            
            if( $uri == $route[0]){                 
                $found = true;
                $controller = $route[1];
                $action = $route[2];                
                
                for($i = 3; $i < count($this->explode); $i++ ){
                    $param[] = $this->explode[$i];
                }                
                break;
            }
        }     
        
        if($found){        
            $controller = Container::newController($controller);

            if(count($param) > 0){
                $controller->$action($param);
            }else{
                $controller->$action();
            }
        }
    }  
}
