<?php

include_once '../lib/Sistema.php';
include_once '../lib/View.php';
include_once '../app/model/CargosSelecao.php';

/**
 * Description of CargoView
 *
 * @author joao.franca
 */
class CargoView extends View {
    function __construct($title_page = null, $sistema = null) {
        parent::__construct($title_page, $sistema);        
    }
    
    private function getContent($action = null, $params = null){
        return '<section>' .  $this->getLista(). '</section>';            
    }
    
    private function getLista(){        
        $content_ = "";                               
        
        $objCargos = new CargosSelecao();
        $listaCargos = $objCargos->getListObjActive();
        
        var_dump($listaCargos);
        
        return $content_;       
    }
            
    public function get($action = null, $params = null){
                   
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
