<?php

include_once '../lib/View.php';
include_once '../lib/Sistema.php';
include_once '../lib/Pergunta.php';
include_once '../lib/Auxiliar.php';
include_once '../app/model/Unidade.php';
include_once '../app/model/Cargo.php';
include_once '../app/model/Funcao.php';
include_once '../app/model/Inscricao.php';
include_once '../app/model/Avaliacao.php';
include_once '../app/model/Servidor.php';

/**
 * Description of ServidorView
 *
 * @author joao.franca
 */
class ServidorView extends View {
    function __construct($title_page = null, $sistema = null) {
        parent::__construct($title_page, $sistema);        
    }
    
    private function getContent($action = null, $params = null){
        if($action == "lista"){
            return '<section>' .  $this->getLista(). '</section>';
        }else if($action == "exibir" and ! is_null($params)){
            return '<section>' 
                        . $this->getDadosServidorInscrito($params)                               
                        . $this->getContatoServidor($params)
                        . $this->getMaisInfoServidor($params)
                        . $this->getAvaliacaoRespostas($params)
                    . '</section>';
        }else{
            return '<section>' .  $this->getLista(). '</section>';
        }
    }    
    
    public function getDadosServidorInscrito($params){
        $objInscricao = new Inscricao();
        $item = $objInscricao->selectObj($params['id_inscricao']);
        
        $content_ = '';        

        $objUnidade = new Unidade();
        $objCargo = new Cargo();
        $objFuncao = new Funcao();

        $linhas = '<tr>
                          <th scope="row">'.$item->getIdInscricao().'</th>
                          <td>'.$item->getNomeServidor().'</td>
                          <td>'.$item->getCpfServidor().'</td>
                          <td>'.$objUnidade->selectObj($item->getUnidadeAtual())->getNome_unidade().'</td>                              
                          <td>'.$objCargo->selectObj($item->getCargo())->getNome_cargo().'</td>                              
                          <td>'.$objFuncao->selectObj($item->getFuncao())->getNome_funcao().'</td>        
                          <td>'. Auxiliar::converterDataParaBR($item->getDataChegadaAtual()).'</td>   
                          <td>'. Auxiliar::converterDataParaBR($item->getDataChegadaSms()).'</td>
                    </tr>
                ';

        $content_ .= '
                    <div class="col-lg-12">
                  <div class="card">                    
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Dados</h3>
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
                              <th>DATA LOTAÇÃO</th>
                              <th>DATA ADMISSÃO</th>
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
    
    public function getAvaliacaoRespostas($params){
        $objAvaliacao = new Avaliacao();
        $objInscricao = new Inscricao();
        $objInscricao = $objInscricao->selectObj($params['id_inscricao']);
        
        $content_ = '';        
        if($objAvaliacao->is_avaliado($params['id_inscricao'])){        
        
            $item = $objAvaliacao->getObjPorInscricao($params['id_inscricao']);
        
            $objServidor = new Servidor();
            $objServidor = $objServidor->selectObj($item->getId_avaliador());
            
            $linhas =  '<tr><th scope="row">1</th>
                                  <td>'.Pergunta::getNota1Avaliacao().'</td>
                                  <td>'.$item->getNota1().'</td>                                  
                            </tr>
                            
                            <tr><th scope="row">2</th>
                                  <td>'.Pergunta::getNota2Avaliacao().'</td>
                                  <td>'.$item->getNota2().'</td>                                  
                            </tr>
                            
                            <tr><th scope="row">3</th>
                                  <td>'.Pergunta::getNota3Avaliacao().'</td>
                                  <td>'.$item->getNota3().'</td>                                  
                            </tr>
                            
                            <tr><th scope="row">4</th>
                                  <td>'.Pergunta::getNota4Avaliacao().'</td>
                                  <td>'.$item->getNota4().'</td>                                  
                            </tr>
                            
                            <tr><th scope="row">5</th>
                                  <td>'.Pergunta::getNota5Avaliacao().'</td>
                                  <td>'.$item->getNota5().'</td>                                  
                            </tr>
                            
                            <tr><th scope="row">6</th>
                                  <td>'.Pergunta::getPergunta6Avaliacao().'</td>
                                  <td>'.$item->getPergunta6().'</td>                                  
                            </tr>
                            
                            <tr><th scope="row">7</th>
                                  <td>'.Pergunta::getPergunta7Avaliacao(Auxiliar::converterDataParaBR($objInscricao->getDataChegadaAtual())).'</td>
                                  <td>'. Pergunta::stringPergunta7($item->getPergunta7()).'</td>                                  
                            </tr>
                            
                            <tr><th scope="row">8</th>
                                  <td>'.Pergunta::getPergunta8Avaliacao().'</td>
                                  <td>'. Pergunta::stringPergunta8($item->getPergunta8()).'</td>                                  
                            </tr>
                            
                            <tr><th scope="row">9</th>
                                  <td>'.Pergunta::getPergunta9Avaliacao().'</td>
                                  <td>'.$item->getPergunta9().'</td>                                  
                            </tr>
                            <tr><th scope="row">10</th>
                                  <td>'.Pergunta::getPergunta10Avaliacao(Auxiliar::converterDataParaBR($objInscricao->getDataChegadaSetor())).'</td>
                                  <td>'.Pergunta::stringPergunta10($item->getPergunta10()).'</td>                                  
                            </tr>
                            ';
            
            $tabela = '
                      <p>Avaliador: <strong>'.$objServidor->getNome_servidor().' - '.$objServidor->getCpf_servidor().'</strong>
                      <br />Avaliado em: <strong>'.$item->getData_da_avaliacao().'</strong>                      
                      <br />Pontuação: <strong>'.$item->getPontuacao($params['id_inscricao']).'</strong></p>         
                        <table class="table table-striped table-hover">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>QUESTIONAMENTO</th>                              
                              <th>RESPOSTA</th>                                                            
                            </tr>
                          </thead>
                          <tbody>
                               '.$linhas.'            
                          </tbody>
                        </table>
                   ';
        
        }else{
            $tabela =    '<p>Servidor não avaliado!</p>';
        }
        
        $content_ .= '
                    <div class="col-lg-12">
                  <div class="card">                    
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Avaliação</h3>
                    </div>                    
                    <div class="card-body">
                        <div class="table-responsive">     
                        '.$tabela.'
                            </div>
                    </div>
                  </div>
                </div>
              ';        
                                  
        return $content_;     
    }
    
    public function getMaisInfoServidor($params){
        $objInscricao = new Inscricao();
        $item = $objInscricao->selectObj($params['id_inscricao']);
        
        $content_ = '';        

        $objUnidade = new Unidade();  

        $linhas = '<tr>
                          <th scope="row">'.$item->getIdInscricao().'</th>
                          <td>'.$item->getMotivoSolicitacao().'</td>
                          <td>'.$item->getExperienciaSaude().'</td>
                          <td>'.$objUnidade->selectObj($item->getUnidadeDesejo1())->getNome_unidade().'</td>                              
                          <td>'.$objUnidade->selectObj($item->getUnidadeDesejo2())->getNome_unidade().'</td>                                                        
                          <td>'.$objUnidade->selectObj($item->getUnidadeDesejo3())->getNome_unidade().'</td>                                                        
                    </tr>
                ';

        $content_ .= '
                    <div class="col-lg-12">
                  <div class="card">                    
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Mais Informações</h3>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">                       
                        <table class="table table-striped table-hover">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>MOTIVO DA SOLICITAÇÃO</th>                              
                              <th>EXPERIÊNCIA EM SAÚDE</th>                              
                              <th>UNIDADE DE DESEJO 1</th>                              
                              <th>UNIDADE DE DESEJO 2</th>                              
                              <th>UNIDADE DE DESEJO 3</th>                              
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
    
     public function getContatoServidor($params){
        $objInscricao = new Inscricao();
        $item = $objInscricao->selectObj($params['id_inscricao']);
        
        $content_ = '';        

        $objUnidade = new Unidade();
        $objCargo = new Cargo();
        $objFuncao = new Funcao();

        $linhas = '<tr>
                          <th scope="row">'.$item->getIdInscricao().'</th>
                          <td>'.$item->getEndereco().'</td>
                          <td>'.$item->getCep().'</td>
                          <td>'.$item->getTelefone().'</td>                              
                          <td>'.$item->getEmail().'</td>                                                        
                    </tr>
                ';

        $content_ .= '
                    <div class="col-lg-12">
                  <div class="card">                    
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Contato</h3>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">                       
                        <table class="table table-striped table-hover">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>ENDEREÇO</th>                              
                              <th>CEP</th>                              
                              <th>TELEFONE</th>                              
                              <th>E-MAIL</th>                                                            
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
    
    private function getLista(){
        $content_ = '';    

            $objInscricao = new Inscricao();
            $listaInscritos = $objInscricao->selectObj($id);
//
//            $objUnidade = new Unidade();
//            $objCargo = new Cargo();
//            $objFuncao = new Funcao();
//            $objAvaliacao = new Avaliacao();
//
            $linhas = "";
//            foreach ($listaInscritos as $item){
//                
//                if($objAvaliacao->is_avaliado($item->getIdInscricao())){
//                    $pontuacao = $objAvaliacao->getPontuacao($item->getIdInscricao());
//                }else{
//                    $pontuacao = "Ainda não Avaliado";
//                }
//                
//                $button_mais_informacoes = "<a id='btn_mais_informacoes' name='btn-mais-informacoes' href='servidor.php?idinscricao={$item->getIdInscricao()}' class='btn btn-info btn-sm'>Mais Informações</a>";
//
//                $linhas .= '<tr>
//                                  <th scope="row">'.$item->getIdInscricao().'</th>
//                                  <td>'.$item->getNomeServidor().'</td>
//                                  <td>'.$item->getCpfServidor().'</td>
//                                  <td>'.$objUnidade->selectObj($item->getUnidadeAtual())->getNome_unidade().'</td>                              
//                                  <td>'.$objCargo->selectObj($item->getCargo())->getNome_cargo().'</td>                              
//                                  <td>'.$objFuncao->selectObj($item->getFuncao())->getNome_funcao().'</td>        
//                                  <td>'.
//                                            $pontuacao
//                                       .'</td>   
//                                   <td>'.$button_mais_informacoes.'</td>
//                            </tr>
//                            ';
//            }

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
                                  <th>DATA DE LOTAÇÃO</th>                                  
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
