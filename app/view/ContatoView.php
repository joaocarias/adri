<?php

include_once '../lib/Sistema.php';
include_once '../lib/View.php';

/**
 * Description of ContatoView
 *
 * @author joao.franca
 */
class ContatoView extends View {
    function __construct($title_page = null, $sistema = null) {
        parent::__construct($title_page, $sistema);        
    }
    
    private function getContent($action = null, $params = null){        
        $retorno = '<section>' 
                       . $this->getInfo()
                    . '</section>';       
        return $retorno;
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
    
    public function getInfo(){
        return $this->beginCard("col-lg-12", "NCL").'
                    <ul>
                        <li>NCL - Núcleo de Cadastro de Lotação</li>
                        <li>Telefone: 84-3232-8163</li>                        
                        <li>E-Mail: <a href="mailto:ncl_dgtes@outlook.com">ncl_dgtes@outlook.com</a></li>
                    </ul>
                '.$this->endCard().'                    
                ';
    }
}
