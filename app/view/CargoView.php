<?php

include_once '../lib/Sistema.php';
include_once '../lib/View.php';
include_once '../app/model/CargosSelecao.php';
include_once '../app/model/CargoFuncaoSelecao.php';
include_once '../app/model/Cargo.php';
include_once '../app/model/Funcao.php';

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
        return '<section>' .  $this->getListaCargos(). '</section>';            
    }
    
    private function getListaCargos(){        
        $content_ = "";                               
        
        $objCargos = new CargosSelecao();
        $listaCargos = $objCargos->getListObjActive();
        
        $objC = new Cargo();
        
        $linhas = "";
        foreach ($listaCargos as $item){
            
            $objCargoFuncao = new CargoFuncaoSelecao();
            $listaCargoFuncao = $objCargoFuncao->getListPorCargo($item->getId_cargo());
            
            $listaFuncao = "";
            $i = 0;
            $objFuncao = new Funcao();
            
            foreach($listaCargoFuncao as $itemFuncao){
                if($i == 0){                    
                    $listaFuncao .= $itemFuncao->getId_funcao() . " - " . $objFuncao->selectObj($itemFuncao->getId_funcao())->getNome_funcao();
                }else{
                    $listaFuncao .= "<br />". $itemFuncao->getId_funcao() . " - " . $objFuncao->selectObj($itemFuncao->getId_funcao())->getNome_funcao();
                }
                
                $i++;
            }
            
            $linhas .= '<tr>
                            <th scope="row">'.$item->getId_cargo().'</th>
                              <td>'.$objC->selectObj($item->getId_cargo())->getNome_cargo().'</td>                              
                              <td>'.$listaFuncao.'</td>                              
                            </tr>
                        ';
        }
        
        $content_ .= '
                        <div class="col-lg-12">
                      <div class="card">                    
                        <div class="card-header d-flex align-items-center">
                          <h3 class="h4">Lista de Cargos e Funções Habilitados para Seleção</h3>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">                       
                            <table class="table table-striped table-hover">
                              <thead>
                                <tr>
                                  <th>#</th>                                                            
                                  <th>CARGO</th>                                                                
                                  <th>FUNÇÃO ESPECIFÍCA</th>   
                                </tr>
                              </thead>
                              <tbody>
                                   '.$linhas.'            
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                   </div>
                  ';
        
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
