<?php

include_once '../lib/Sistema.php';
include_once '../lib/View.php';

class AvaliarView extends View{
    function __construct($title_page = null, $sistema = null) {
        parent::__construct($title_page, $sistema);        
    }
    
    private function getContent($action = null, $params = null){
        return '<section>' .  $this->getFormParecer(). '</section>';
//        if(is_null($action) OR $action == "lista"){              
          //  return  '<section>' . $this->getLista() . '</section>';
//        }else if($action == "novo"){
//            return  '<section>' . $this->getForm() . '</section>';
//        }else if($action == "editar"){
//            return  '<section>' . $this->getAviso() . $this->getForm($action, $params) . '</section>';
//        }else{
//            return $this->getLista();
//        }
    }
    
    public function getDadosServidor(){
        
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
    
    private function getFormParecer(){
        $tituloForm = "Parecer da Chefia Imediata";
        $actionForm = "avaliar.php";
        
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
                            '.$this->getSelect($arrayZeroANove, "teste", "O Servidor demostra interesse pela atividade desenvolvida" , "col-sm-2", false).'
                                        
                            '.$this->getSelect($arrayZeroANove, "teste", "O Servidor cumpre com as tarefas que lhe são atribuídas e atende as necessidades dos usuários "
                                    . " que procuram a Unidade/Departamento" , "col-sm-2", false).'
                                        
                            '.$this->getSelect($arrayZeroANove, "teste", "O Servidor mantém um bom relacionamento com a chefia imediata bem como "
                                    . "respeita aos regulamentos e normas internas" , "col-sm-2", false).'

                            '.$this->getSelect($arrayZeroANove, "teste", "O servidor cumpre sua jornada de trabalho com pontualidade e regularidade" , "col-sm-2", false).'

                            '.$this->getSelect($arrayZeroANove, "teste", "O Servidor mantém uma postrura ética perante os demais profissionais "
                                    . " e usuários" , "col-sm-2", false).'
                                        
                            '.$this->getTextarea("teste", "Cite outras informações que julgue importantes ou "
                                    . " que não foram citadas anteriormente", "", "col-sm-6" , true).'
                                        
                            '.$this->getSelect($arraySimNao, "teste", "Você confirma que o servidor trabalhou na unidade "
                                    . " no período <strong>NNN</strong> ", "col-sm-6", true).'

                            '.$this->getSelect($arrayLiberacao, "teste", "Mediante as informações acimas prestadas", "col-sm-6", true).'
                                
                            '.$this->getTextarea("teste", "Justificava", "Justifique a sua resposta anterior", "col-sm-6" , true).'

                            <div class="line"></div>
                            '.$this->getInputButtonSubmit("btn_salvar", "Salvar Avaliação", "btn-primary").' 
                                                       
                    '.$this->endForm().'
                '.$this->endCard().'                    
                ';
    }
}