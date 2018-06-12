<?php

include_once '../lib/View.php';
include_once '../lib/Sistema.php';
include_once '../lib/Auxiliar.php';
include_once '../app/model/Unidade.php';
include_once '../app/model/Cargo.php';
include_once '../app/model/Funcao.php';
include_once '../app/model/Inscricao.php';
include_once '../app/model/Avaliacao.php';

class InscritosView extends View {
    function __construct($title_page = null, $sistema = null) {
        parent::__construct($title_page, $sistema);        
    }
    
    private function getContent($action = null, $params = null){
        if($action == "lista"){
            return '<section>' .  $this->getLista(). '</section>';
        }else if($action == "parecer"){
            return '<section>' . $this->getDadosServidorInscrito($params) 
                               . $this->getFormParecer($params)
                    . '</section>';
        }else{
            return '<section>' .  $this->getLista(). '</section>';
        }
    }
    
    private function getLista(){
        $content_ = '';    

            $objInscricao = new Inscricao();
            $listaInscritos = $objInscricao->getListObjActive();

            $objUnidade = new Unidade();
            $objCargo = new Cargo();
            $objFuncao = new Funcao();
            $objAvaliacao = new Avaliacao();

            $linhas = "";
            foreach ($listaInscritos as $item){
                
                if($objAvaliacao->is_avaliado($item->getIdInscricao())){
                    $pontuacao = $objAvaliacao->getPontuacao($item->getIdInscricao());
                }else{
                    $pontuacao = "Ainda não Avaliado";
                }
                
                $button_mais_informacoes = "<a id='btn_mais_informacoes' name='btn-mais-informacoes' href='servidor.php?idinscricao={$item->getIdInscricao()}' class='btn btn-info btn-sm'>Mais Informações</a>";

                $linhas .= '<tr>
                                  <th scope="row">'.$item->getIdInscricao().'</th>
                                  <td>'.$item->getNomeServidor().'</td>
                                  <td>'.$item->getCpfServidor().'</td>
                                  <td>'.$objUnidade->selectObj($item->getUnidadeAtual())->getNome_unidade().'</td>                              
                                  <td>'.$objCargo->selectObj($item->getCargo())->getNome_cargo().'</td>                              
                                  <td>'.$objFuncao->selectObj($item->getFuncao())->getNome_funcao().'</td>        
                                  <td>'.
                                            $pontuacao
                                       .'</td>   
                                   <td>'.$button_mais_informacoes.'</td>
                            </tr>
                            ';
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
                                  <th>SERVIDOR</th>                              
                                  <th>CPF</th>                              
                                  <th>UNIDADE ATUAL</th>                              
                                  <th>CARGO</th>                              
                                  <th>FUNÇÃO</th>          
                                  <th>PONTUAÇÃO</th>
                                  <th>MAIS INFORMAÇÕES</th>
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
//        }
                                  
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
