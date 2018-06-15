<?php

include_once '../lib/Sistema.php';
include_once '../lib/Auxiliar.php';
include_once '../lib/View.php';
include_once '../app/model/Unidade.php';
include_once '../app/model/Cargo.php';
include_once '../app/model/Funcao.php';
include_once '../app/model/Avaliacao.php';

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
            $subtitle = " - Primeira Opção";
            $opcao = 'unidade_desejo1';
        }else if($action == "segunda_opcao"){
            $subtitle = " - Segunda Opção";
            $opcao = 'unidade_desejo2';
        }else if($action == "terceira_opcao"){
            $subtitle = " - Terceira Opção";
            $opcao = 'unidade_desejo3';
        }
        
//        if($action == "lista"){
//            return '<section>' .  $this->getFormFiltro() . $this->getLista(). '</section>';
//        }else if($action == "parecer"){
//            return '<section>' . $this->getDadosServidorInscrito($params) 
//                               . $this->getFormParecer($params)
//                    . '</section>';
//        }else{
            return '<section>'  . $this->getFormFiltro($subtitle) . $this->getLista($opcao). '</section>';
//        }
        return "";
        
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
    
    private function getFormFiltro($subtitle = null){
                  
        $objUnidade = new Unidade();
        $arrayUnidade = $objUnidade->getArrayBasic();
        
        $objCargo = new Cargo();
        $arrayCargo = $objCargo->getArrayBasic();
        
        $objFuncao = new Funcao();
        $arrayFuncao = $objFuncao->getArrayBasic();
        
        $tituloForm = "Filtro" . $subtitle;
        $actionForm = "classificacao.php";
        return ' '.$this->beginCard("col-lg-12", $tituloForm).'
                    '.$this->beginForm("col-lg-12" , "POST", $actionForm).'                          
                            '.$this->getSelect($arrayUnidade , "tx_unidade", "Unidade", "col-sm-6", true).'
                            '.$this->getSelect($arrayCargo , "tx_cargo", "Cargo", "col-sm-6", false).'
                            '.$this->getSelect($arrayFuncao , "tx_funcao", "Função", "col-sm-6", false).'                      '
                            .'<div class="line"></div>'
                            .$this->getInputButtonSubmit("btn_buscar", "Realziar Filtro", "btn-primary")
                    .$this->endForm()
                .$this->endCard()
                ;        
    }  
    
    private function getLista($opcao){
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

            $objAvaliacao = new Avaliacao();
            $dados = $objAvaliacao->getDadosClassificacao($arrayFiltro);
            
           // var_dump($dados);
                                      
//        
//            $objInscricao = new Inscricao();
//            $listaInscritos = $objInscricao->getListObjActive($arrayFiltro);
//                        
//            $objUnidade = new Unidade();
//            $objCargo = new Cargo();
//            $objFuncao = new Funcao();
//            $objAvaliacao = new Avaliacao();
//
//            $linhas = "";
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
//
//            $content_ .= '
//                        <div class="col-lg-12">
//                      <div class="card">                    
//                        <div class="card-header d-flex align-items-center">
//                          <h3 class="h4">Lista</h3>
//                        </div>
//                        <div class="card-body">
//                          <div class="table-responsive">                       
//                            <table class="table table-striped table-hover">
//                              <thead>
//                                <tr>
//                                  <th>#</th>
//                                  <th>SERVIDOR</th>                              
//                                  <th>CPF</th>                              
//                                  <th>UNIDADE ATUAL</th>                              
//                                  <th>CARGO</th>                              
//                                  <th>FUNÇÃO</th>          
//                                  <th>PONTUAÇÃO</th>
//                                  <th>MAIS INFORMAÇÕES</th>
//                                </tr>
//                              </thead>
//                              <tbody>
//                                   '.$linhas.'            
//                              </tbody>
//                            </table>
//                          </div>
//                        </div>
//                      </div>
//                   </div>
//                  ';
////        }
            
        }
                                  
        return $content_;       
    }
}
