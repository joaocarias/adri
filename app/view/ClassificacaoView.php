<?php

include_once '../lib/Sistema.php';
include_once '../lib/Auxiliar.php';
include_once '../lib/View.php';
include_once '../app/model/Unidade.php';
include_once '../app/model/Cargo.php';
include_once '../app/model/Funcao.php';
include_once '../app/model/Avaliacao.php';
include_once '../app/model/Inscricao.php';

/**
 * Description of ClassificacaoView
 *
 * @author joao.franca
 */
class ClassificacaoView extends View{
    function __construct($title_page = null, $sistema = null) {
        parent::__construct($title_page, $sistema);        
    }
    
    private function getContent($action = null, $params = null){
        
        $subtitle = "";
        $opcao = 'unidade_desejo1';
        if($action == "primeira_opcao"){
            $subtitle = "Primeira Opção";
            $opcao = 'unidade_desejo1';
        }else if($action == "segunda_opcao"){
            $subtitle = "Segunda Opção";
            $opcao = 'unidade_desejo2';
        }else if($action == "terceira_opcao"){
            $subtitle = "Terceira Opção";
            $opcao = 'unidade_desejo3';
        }
        
        return '<section>'  . $this->getFormFiltro($subtitle, $action) . $this->getLista($opcao, $subtitle). $this->getListaNaoAvaliados($opcao, $subtitle) . '</section>' ;        
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
    
    private function getFormFiltro($subtitle = null, $action = null){
                  
        $objUnidade = new Unidade();
        $arrayUnidade = $objUnidade->getArrayBasic();
        
        $objCargo = new Cargo();
        $arrayCargo = $objCargo->getArrayBasic();
        
        $objFuncao = new Funcao();
        $arrayFuncao = $objFuncao->getArrayBasic();
        
        $tituloForm = "Filtro: " . $subtitle;
        $actionForm = "classificacao.php";
        return ' '.$this->beginCard("col-lg-12", $tituloForm).'
                    '.$this->beginForm("col-lg-12" , "POST", $actionForm).'                          
                            '.$this->getSelect($arrayUnidade , "tx_unidade", "Unidade", "col-sm-6", true).'
                            '.$this->getSelect($arrayCargo , "tx_cargo", "Cargo", "col-sm-6", false).'
                            '.$this->getSelect($arrayFuncao , "tx_funcao", "Função", "col-sm-6", false).'   
                            '.$this->getHidden($action, "true").' 
                             <div class="line"></div>'
                            .$this->getInputButtonSubmit("btn_buscar", "Realizar Filtro", "btn-primary")
                    .$this->endForm()
                .$this->endCard()
                ;        
    }  
    
    private function getLista($opcao, $classificacao){
        $content_ = '';    

//            //Filtros de consulta
        $tx_unidade = filter_input(INPUT_POST, "tx_unidade", FILTER_SANITIZE_STRING);
        $tx_cargo = filter_input(INPUT_POST, "tx_cargo", FILTER_SANITIZE_STRING);
        $tx_funcao = filter_input(INPUT_POST, "tx_funcao", FILTER_SANITIZE_STRING);

        $arrayFiltro = array();
        if($tx_unidade || $tx_cargo || $tx_funcao ){
            if($tx_unidade){
                $arrayFiltro[$opcao] = $tx_unidade;
            }

            if($tx_cargo){
                $arrayFiltro['cargo'] = $tx_cargo;
            }

            if($tx_funcao){
                $arrayFiltro['funcao'] = $tx_funcao;
            }            
        }else{
            $arrayFiltro = null;
        }

        if(!is_null($arrayFiltro)){

            $objUnidade = new Unidade();
            $objCargo = new Cargo();
            $objFuncao = new Funcao();
            
            $subtitle = "";
            
            $subtitle .= isset($arrayFiltro[$opcao]) ? " - " .  $objUnidade->selectObj($arrayFiltro[$opcao])->getNome_unidade() : "";
            $subtitle .= isset($arrayFiltro['cargo']) ? " - " .  $objCargo->selectObj($arrayFiltro['cargo'])->getNome_cargo() : "";
            $subtitle .= isset($arrayFiltro['funcao']) ? " - " .  $objFuncao->selectObj($arrayFiltro['funcao'])->getNome_funcao() : "";

            $objAvaliacao = new Avaliacao();
            $dados = $objAvaliacao->getDadosClassificacao($arrayFiltro);
            
            foreach ($dados as $row2){
                $objInscricao1 = new Inscricao();
                $servidor1 = $objInscricao1->selectObj($row2->id_inscricao);
                
                $tempoAdmissao = $objAvaliacao->tempoDeServico($servidor1->getDataChegadaSms());
                $tempoUnidade = $objAvaliacao->tempoDeServico($servidor1->getDataChegadaAtual());
                $tempoSetor = $objAvaliacao->tempoDeServico($servidor1->getDataChegadaSetor());
                
                $row2->pontuacao += $objAvaliacao->pontuacaoTempo($tempoAdmissao, 1);
                $row2->pontuacao += $objAvaliacao->pontuacaoTempo($tempoUnidade, 2);
                $row2->pontuacao += $objAvaliacao->pontuacaoTempo($tempoSetor, 3);
            }
            
            usort($dados,
                 function( $a, $b ) {
                     if( $a->pontuacao == $b->pontuacao ) return 0;
                     return ( ( $a->pontuacao > $b->pontuacao ) ? -1 : 1 );
                 }
            );
            
            $linhas = "";
            $posicao = 1;
            
            foreach ($dados as $row){
                        
        
            $objInscricao = new Inscricao();
            $servidor = $objInscricao->selectObj($row->id_inscricao);

            $button_mais_informacoes = "<a id='btn_mais_informacoes' name='btn-mais-informacoes' href='servidor.php?idinscricao={$row->id_inscricao}' class='btn btn-info btn-sm'>Mais Informações</a>";

            $status = "";
            if ($servidor->getUnidadeAtual() == 89 || $servidor->getUnidadeAtual() == 157){
                $status = "color: #EEAD0E;";
            }
            elseif($row->pergunta8 == 3){
                $status = "color: red;";
            }
            if ($servidor->getCargo() == 110){
                    $status = "color: blue;";
            }
            
                $linhas .= '<tr style="'.$status.'">
                                  <th scope="row">'.$posicao.'</th>
                                  <td>'.$servidor->getNomeServidor().'</td>
                                  <td>'.$servidor->getCpfServidor().'</td>
                                  <td>'.$objUnidade->selectObj($servidor->getUnidadeAtual())->getNome_unidade().'</td>                              
                                  <td>'.$objCargo->selectObj($servidor->getCargo())->getNome_cargo().'</td>                              
                                  <td>'.$objFuncao->selectObj($servidor->getFuncao())->getNome_funcao().'</td>        
                                  <td>'.
                                            $row->pontuacao
                                       .'</td>   
                                   <td>'.$button_mais_informacoes.'</td>
                            </tr>
                            ';
                
                $posicao++;
            }           
            
            
            $tabela = ' <div class="table-responsive">                       
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
                          </div>';
            
            $content_ .= '
                        <div class="col-lg-12">
                      <div class="card">                    
                        <div class="card-header d-flex align-items-center">
                          <h3 class="h4">Lista: '. $classificacao  .$subtitle.'</h3>
                        </div>
                        <div class="card-body">
                         '.$tabela.'
                        </div>
                      </div>
                   </div>
                  ';
        }
                                  
        return $content_;       
    }
    
    
    private function getListaNaoAvaliados($opcao, $classificacao){
        $content_ = '';    

//            //Filtros de consulta
        $tx_unidade = filter_input(INPUT_POST, "tx_unidade", FILTER_SANITIZE_STRING);
        $tx_cargo = filter_input(INPUT_POST, "tx_cargo", FILTER_SANITIZE_STRING);
        $tx_funcao = filter_input(INPUT_POST, "tx_funcao", FILTER_SANITIZE_STRING);

        $arrayFiltro = array();
        if($tx_unidade || $tx_cargo || $tx_funcao ){
            if($tx_unidade){
                $arrayFiltro[$opcao] = $tx_unidade;
            }

            if($tx_cargo){
                $arrayFiltro['cargo'] = $tx_cargo;
            }

            if($tx_funcao){
                $arrayFiltro['funcao'] = $tx_funcao;
            }            
        }else{
            $arrayFiltro = null;
        }

        if(!is_null($arrayFiltro)){

            $objUnidade = new Unidade();
            $objCargo = new Cargo();
            $objFuncao = new Funcao();
            
            $subtitle = "";
            
            $subtitle .= isset($arrayFiltro[$opcao]) ? " - " .  $objUnidade->selectObj($arrayFiltro[$opcao])->getNome_unidade() : "";
            $subtitle .= isset($arrayFiltro['cargo']) ? " - " .  $objCargo->selectObj($arrayFiltro['cargo'])->getNome_cargo() : "";
            $subtitle .= isset($arrayFiltro['funcao']) ? " - " .  $objFuncao->selectObj($arrayFiltro['funcao'])->getNome_funcao() : "";

            $linhas = "";
            $posicao = 1;

            $objInscricao = new Inscricao();
            $arrayInscricoes = $objInscricao->getListNaoAvaliados($arrayFiltro);
            
            foreach ($arrayInscricoes as $row){
                
            
                $status = "";
            if ($row->getUnidadeAtual() == 89 || $row->getUnidadeAtual() == 157){
                $status = "color: #EEAD0E;";
            }
            elseif ($row->getCargo() == 110){
                    $status = "color: blue;";
            }

            $button_mais_informacoes = "<a id='btn_mais_informacoes' name='btn-mais-informacoes' href='servidor.php?idinscricao={$row->getIdInscricao()}' class='btn btn-info btn-sm'>Mais Informações</a>";

                $linhas .= '<tr>
                                  <th scope="row">'.$posicao.'</th>
                                  <td>'.$row->getNomeServidor().'</td>
                                  <td>'.$row->getCpfServidor().'</td>
                                  <td>'.$objUnidade->selectObj($row->getUnidadeAtual())->getNome_unidade().'</td>                              
                                  <td>'.$objCargo->selectObj($row->getCargo())->getNome_cargo().'</td>                              
                                  <td>'.$objFuncao->selectObj($row->getFuncao())->getNome_funcao().'</td>        
                                  
                                   <td>'.$button_mais_informacoes.'</td>
                            </tr>
                            ';
                
                $posicao++;
            }           

            $tabela = ' <div class="table-responsive">                       
                            <table class="table table-striped table-hover">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>SERVIDOR</th>                              
                                  <th>CPF</th>                              
                                  <th>UNIDADE ATUAL</th>                              
                                  <th>CARGO</th>                              
                                  <th>FUNÇÃO</th>         
                                  
                                  <th>MAIS INFORMAÇÕES</th>
                                </tr>
                              </thead>
                              <tbody>
                                   '.$linhas.'            
                              </tbody>
                            </table>
                          </div>';
            
            $content_ .= '
                        <div class="col-lg-12">
                      <div class="card">                    
                        <div class="card-header d-flex align-items-center">
                          <h3 class="h4">Não Avaliados</h3>
                        </div>
                        <div class="card-body">
                         '.$tabela.'
                        </div>
                      </div>
                   </div>
                  ';
        }
                                  
        return $content_;       
    }
}
