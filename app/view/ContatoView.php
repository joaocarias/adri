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
        return $this->beginCard("col-lg-12", "DGTES").'
                    <ul>
                        <li>DGTES - Departamento de Gestão do Trabalho e da Educação na Saúde</li>
                        <li>Telefone: 84-3232-8501</li>                        
                        <li>E-Mail: <a href="mailto:dgtessms14@gmail.com">dgtessms14@gmail.com</a></li>
                    </ul>
                '.$this->endCard().'                    
                ';
    }
}
