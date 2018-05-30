<?php

namespace App\view;
use Lib\View;

/**
 * Description of Sobre
 *
 * @author joao.franca
 */
class SobreView extends View{
    
    function __construct($title_page = null, $sistema = null) {
        parent::__construct($title_page, $sistema);        
    }
    
    private function getContent($action = null, $params = null){
//        if(is_null($action) OR $action == "lista"){              
//            return  '<section>' . $this->getAviso() . $this->getLista() . '</section>';
//        }else if($action == "novo"){
//            return  '<section>' . $this->getForm() . '</section>';
//        }else if($action == "editar"){
//            return  '<section>' . $this->getAviso() . $this->getForm($action, $params) . '</section>';
//        }else{
//            return $this->getLista();
//        }
    }
            
    public function get($action = null, $params = null, $outro = null){
                   
        return '<!DOCTYPE html>
                    <html>
                      
                    '.$this->getHeader().'
                      
                      <body>
                        <div class="page">
                            '.$this->getNavBar().'
                          <div class="page-content d-flex align-items-stretch"> 
                            <!-- Side Navbar -->
                            '.$this->getMenu().'
                            <div class="content-inner">
                              <!-- Page Header-->
                              '.$this->getPagHeader().'  
                                  
                                  <div class="container-fluid">

                              '.$this->getContent($action, $params).'
                                  
                                  </div>

                              <!-- Page Footer-->
                              '.$this->getFooter().'
                      </body>
                    </html>';
    }
}
