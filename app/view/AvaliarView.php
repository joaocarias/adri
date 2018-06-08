<?php

include_once '../lib/Sistema.php';
include_once '../lib/Auxiliar.php';
include_once '../lib/View.php';
include_once '../app/model/Inscricao.php';
include_once '../app/model/Unidade.php';
include_once '../app/model/Cargo.php';
include_once '../app/model/Funcao.php';
include_once '../app/model/Avaliador.php';

class AvaliarView extends View{
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
    
    public function getDadosServidorInscrito($params){
        $objInscricao = new Inscricao();
        $item = $objInscricao->selectObj($params);
        
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
                    </tr>
                ';

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
                              <th>DATA LOTAÇÃO</th>
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
        
        $id_avaliador = $_SESSION['id_servidor'];
        
        $objAvaliador = new Avaliador();
        
        if($objAvaliador->is_avaliador($id_avaliador)){
                                
            $params = $objAvaliador->getArrayIdUnidadesPorAvaliador($id_avaliador);

            $content_ = '';        

            $objInscricao = new Inscricao();
            $listaInscritoPorUnidades = $objInscricao->getObjsPorUnidadeAtual($params);

            $objUnidade = new Unidade();
            $objCargo = new Cargo();
            $objFuncao = new Funcao();

            $linhas = "";
            foreach ($listaInscritoPorUnidades as $item){
                
                $button_avaliar = "<a id='btn_avaliar' name='btn-avaliar' href='?inscricao={$item->getIdInscricao()}' class='btn btn-success btn-sm'>Avaliar</a>";

                $linhas .= '<tr>
                                  <th scope="row">'.$item->getIdInscricao().'</th>
                                  <td>'.$item->getNomeServidor().'</td>
                                  <td>'.$item->getCpfServidor().'</td>
                                  <td>'.$objUnidade->selectObj($item->getUnidadeAtual())->getNome_unidade().'</td>                              
                                  <td>'.$objCargo->selectObj($item->getCargo())->getNome_cargo().'</td>                              
                                  <td>'.$objFuncao->selectObj($item->getFuncao())->getNome_funcao().'</td>        
                                  <td>'.$button_avaliar.'</td>                                                                                       
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
                                  <th>AVALIAR</th>
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
        }
                                  
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
    
    private function getFormParecer($params = null){
                
        $hi_id_inscricao = $this->getHidden("hi_id_inscricao", $params);
        
        $tituloForm = "Parecer da Chefia Imediata";
        $actionForm = "../controller/AvaliarController.php";
        
        $arrayZeroANove = array();
        
        for($i=0; $i<=9; $i++){
            $arrayZeroANove[$i]['id'] = $i;
            $arrayZeroANove[$i]['value'] = $i;            
        }
        
        $arraySimNao = array();
        $arraySimNao[0]['id'] = "sim";
        $arraySimNao[0]['value'] = "SIM - Confirmo que o servidor trabalhou na unidade no período indicado";            
        $arraySimNao[1]['id'] = "nao";
        $arraySimNao[1]['value'] = "NÃO";      
        
        $arrayLiberacao = array();
        $arrayLiberacao[0]['id'] = "1";
        $arrayLiberacao[0]['value'] = "Libero o (a) servidor (a) sem substituição";            
        $arrayLiberacao[1]['id'] = "2";
        $arrayLiberacao[1]['value'] = "Libero o (a) servidor (a) mediante substituição";      
        $arrayLiberacao[2]['id'] = "3";
        $arrayLiberacao[2]['value'] = "Não Libero o (a) servidor (a)";      
                                                        
        return ' 
                '.$this->beginCard("col-lg-12", $tituloForm).'
                    '.$this->beginForm("col-lg-12" , "POST", $actionForm).'                          
                            <h5>Descreva a atuação do servidor no setor quanto aos seguintes aspectos:</h5>
                            <p>* Avalie com notas de 0 a 9 (sendo 0 a menor nota e 9 a maior nota)</p>
                             <div class="line"><hr /></div>
                            '.$this->getSelect($arrayZeroANove, "nota1", "O Servidor demostra interesse pela atividade desenvolvida" , "col-sm-2", true).'
                                        
                            '.$this->getSelect($arrayZeroANove, "nota2", "O Servidor cumpre com as tarefas que lhe são atribuídas e atende as necessidades dos usuários "
                                    . " que procuram a Unidade/Departamento" , "col-sm-2", true).'
                                        
                            '.$this->getSelect($arrayZeroANove, "nota3", "O Servidor mantém um bom relacionamento com a chefia imediata bem como "
                                    . "respeita aos regulamentos e normas internas" , "col-sm-2", true).'

                            '.$this->getSelect($arrayZeroANove, "nota4", "O servidor cumpre sua jornada de trabalho com pontualidade e regularidade" , "col-sm-2", true).'

                            '.$this->getSelect($arrayZeroANove, "nota5", "O Servidor mantém uma postrura ética perante os demais profissionais "
                                    . " e usuários" , "col-sm-2", true).'
                                        
                            '.$this->getTextarea("pergunta6", "Cite outras informações que julgue importantes ou "
                                    . " que não foram citadas anteriormente", "", "col-sm-6" , true).'
                                        
                            '.$this->getSelect($arraySimNao, "pergunta7", "Você confirma que o servidor trabalhou na unidade "
                                    . " no período <strong>NNN</strong> ", "col-sm-6", true).'

                            '.$this->getSelect($arrayLiberacao, "pergunta8", "Mediante as informações acimas prestadas", "col-sm-6", true).'
                                
                            '.$this->getTextarea("pergunta9", "Justificava", "Justifique a sua resposta anterior", "col-sm-6" , true).'

                            '.$hi_id_inscricao.'

                            <div class="line"></div>
                            '.$this->getInputButtonSubmit("btn_salvar", "Salvar Avaliação", "btn-primary").' 
                                                       
                    '.$this->endForm().'
                '.$this->endCard().'                    
                ';
    }
}