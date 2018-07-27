<?php

include_once '../app/model/Unidade.php';
include_once '../app/model/Distrito.php';
include_once '../app/model/Avaliador.php';
include_once '../app/model/Servidor.php';
include_once '../app/model/UnidadesBloqueadas.php';
include_once '../lib/Sistema.php';
include_once '../lib/View.php';


/**
 * Description of UnidadeView
 *
 * @author joao
 */
class UnidadeView extends View{
    function __construct($title_page = null, $sistema = null) {
        parent::__construct($title_page, $sistema);        
    }
    
    private function getContent($action = null, $params = null){
//        if(is_null($action) OR $action == "lista"){              
            return  '<section>' . $this->getLista() . '</section>';
//        }else if($action == "novo"){
//            return  '<section>' . $this->getForm() . '</section>';
//        }else if($action == "editar"){
//            return  '<section>' . $this->getAviso() . $this->getForm($action, $params) . '</section>';
//        }else{
//            return $this->getLista();
//        }
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
        
    private function getLista(){
               
        $content_ = '';        
        $idModalExcluir = 'myModalExcluir';        
        
        $myObj = new Unidade();
        $lista = $myObj->getListObjActive();
        
        $linhas = "";
        foreach ($lista as $item){
            if(!UnidadesBloqueadas::unidadeBloqueada($item->getId_unidade())){
                $objAvaliador = new Avaliador();
                $objServidor = new Servidor();
                $listaAvaliadores = $objAvaliador->selectAvaliadoresPorUnidade($item->getId_unidade());

                $stringAvaliadores = "";

                $i = 0;
                foreach ($listaAvaliadores as $v){
                    if($i == 0){
                        $stringAvaliadores .= $objServidor->selectObj($v->getId_servidor())->getNome_servidor();
                    }else{
                        $stringAvaliadores .= ", ".$objServidor->selectObj($v->getId_servidor())->getNome_servidor();
                    }

                    $i++;
                }

                $distrito = new Distrito();
                $distrito = $distrito->selectObj($item->getId_distrito());

                $linhas .= '<tr>
                                  <th scope="row">'.$item->getId_unidade().'</th>
                                  <td>'.$item->getNome_unidade().'</td>
                                  <td>'.$item->getSigla_unidade().'</td>
                                  <td>'.$distrito->getNome_distrito().'</td>                              
                                  <td>'.$stringAvaliadores.'</td>                                                       
                                </tr>
                            ';
            } 
        }
        
        $content_ .= '
                    <div class="col-lg-12">
                  <div class="card">                    
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Lista</h3>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">                       
                        <table class="table table-striped table-hover">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>UNIDADE</th>                              
                              <th>SIGLA</th>                              
                              <th>DISTRITO</th>
                              <th>AVALIADOR(ES)</th>                             
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
}
