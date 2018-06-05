<?php

include_once '../lib/Sistema.php';
include_once '../lib/View.php';
include_once '../app/model/Servidor.php';
include_once '../app/model/Unidade.php';
include_once '../app/model/Distrito.php';

/**
 * Description of AvaliadoresView
 *
 * @author joao
 */
class AvaliadoresView extends View{
    function __construct($title_page = null, $sistema = null) {
        parent::__construct($title_page, $sistema);        
    }
    
    private function getContent($action = null, $params = null){
        if($action == "cadastro"){
            $conteudo = "";
            if(!is_null($params)){
                
                $myObj = new Servidor();
                $item = $myObj->getObjPorLogin($params);
                
                $conteudo .= $this->getTabelaBasicaServidor($item) ;
                $conteudo .= $this->getFormUnidade($item);
            }
            
            $retorno = '<section>' .  $this->getFormBusca() 
                            .$conteudo
                       . '</section>';
        }
        
        return $retorno;
//        if(is_null($action) OR $action == "lista"){              
       //     return  '<section>' . $this->getLista() . '</section>';
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
    
    private function getFormBusca(){
        $tituloForm = "Buscar Servidor";
        $actionForm = "avaliadores.php";
        
        $hi_cadastro = $this->getHidden("cadastro", "true");
                 
        return ' 
                '.$this->beginCard("col-lg-12", $tituloForm).'             
                    '.$this->beginForm("col-lg-12" , "POST", $actionForm).'                          
                    
                            '.$this->getInput("text", "tx_buscar", "Buscar Servidor", "CPF do Avaliador" ,"col-sm-6", true, null, false, "999.999.999-99" ).'
                                
                            '.$hi_cadastro.'

                                <div class="line"></div>
                            '.$this->getInputButtonSubmit("btn_buscar_servidor", "Buscar Servidor", "btn-primary").' 
                       
                    '.$this->endForm().'
                '.$this->endCard().'                    
                ';
    }       
    
    private function getFormUnidade(Servidor $item){
        $tituloForm = "Selecionar Unidade";
        $actionForm = "avaliadores.php";
        
        $hi_cadastro = $this->getHidden("cadastro", "true");
        $hi_id_servidor = $this->getHidden("hi_id_servidor", $item->getId_servidor());
                 
        $objUnidade = new Unidade();
        $arrayUnidades = $objUnidade->getArrayBasic();
        
        return ' 
                '.$this->beginCard("col-lg-12", $tituloForm).'             
                    '.$this->beginForm("col-lg-12" , "POST", $actionForm).'                          
                    
                            '.$this->getSelect($arrayUnidades, "tx_id_unidade", "Unidade/Setor/Departamento", "col-sm-6", true).'
                                
                            '.$hi_cadastro.'
                            '.$hi_id_servidor.'

                                <div class="line"></div>
                            '.$this->getInputButtonSubmit("btn_buscar_servidor", "Buscar Servidor", "btn-primary").' 
                       
                    '.$this->endForm().'
                '.$this->endCard().'                    
                ';
    }
    
    public function getTabelaBasicaServidor(Servidor $item){
        $content_ = '';        
//        $idModalExcluir = 'myModalExcluir';        
//        
        
        $unidade = new Unidade();
        $distrito = new Distrito();
        $lista = $item->getDadosServidorMovimentacaoPorCpf($item->getCpf_servidor());
        
//        
        $linhas = "";
        foreach ($lista as $row){
            
            $unidade = $unidade->selectObj($row->id_unidade_destino);
//            
////            $button_edit = "<a id='btn_edit' name='btn-edit' href='/profissoes/editprofissao/{$item->getId_profissao()}' class='btn btn-primary btn-sm'>Editar</a>";
////            $button_delete = '<button type="button" data-toggle="modal" data-target="#'.$idModalExcluir.$item->getId_profissao().'" class="btn btn-danger btn-sm">Excluir </button>';
////                         
////            $buttons = $button_edit." ".$button_delete ;
//
//            $distrito = new Distrito();
//            $distrito = $distrito->selectObj($item->getId_distrito());
//            
            $linhas .= '<tr>
                              <th scope="row">'.$row->id_servidor.'</th>
                              <td>'.$row->nome_servidor.'</td>
                              <td>'.$row->cpf_servidor.'</td>
                              <td>'.$row->nome_funcao.'</td>                              
                              <td>'.$unidade->getNome_unidade().'</td>                              
                              <td>'.$distrito->selectObj($unidade->getId_distrito())->getNome_distrito().'</td>                              
                            </tr>
                        ';
////            
////            $buttonsModal = array('<button type="button" data-dismiss="modal" class="btn btn-secondary">Cancelar</button>'
////                         ,'<a href="/profissoes/deleteprofissao/'.$item->getId_profissao().'"><button type="button" class="btn btn-danger">Excluir Cadastro</button></a>');
////            $content_ .= $this->getModal($idModalExcluir.$item->getId_profissao(), "Excluir Profissão", "Tem Certeza que deseja Excluir o Cadastro?", $buttonsModal);     
        }
//        
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
                              <th>FUNÇÃO</th>
                              <th>LOTAÇÃO</th>
                              <th>DISTRITO</th>                              
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
        
//    private function getForm($action = null, $param = null){
//        $tituloForm = "Profissão";
//        $actionForm = "/profissoes/addprofissao";
//        
//        $vProfissao = null;        
//       
//        $hi_id_obj = "";
//        
//        if($action == "editar"){
//            $tituloForm .= " - ".ucfirst($action);
//            $actionForm = "/profissoes/updateprofissao";
//            
//            $obj = new Profissao();
//            $obj = $obj->selectObj($param[0]);
//            $vProfissao = $obj->getProfissao();            
//            $hi_id_obj = $this->getHidden("hi_id_obj", $obj->getId_profissao());
//
//        }   
//                                       
//        return ' 
//                '.$this->beginCard("col-lg-12", $tituloForm).'             
//                    '.$this->beginForm("col-lg-12" , "POST", $actionForm).'                          
//                      
//                            '.$this->getInput("text", "tx_profissao", "Profissão", "Nome da Profissão" ,"col-sm-6",true, $vProfissao).'
//                                
//                            '.$hi_id_obj.'
//
//                                <div class="line"></div>
//                            '.$this->getInputButtonSubmit("btn_salvar", "Salvar", "btn-primary").' 
//                       
//                    '.$this->endForm().'
//                '.$this->endCard().'                    
//                ';
//    }
//
//    private function getLista(){
//               
//        $content_ = '';        
//        $idModalExcluir = 'myModalExcluir';        
//        
//        $myObj = new Unidade();
//        $lista = $myObj->getListObjActive();
//        
//        $linhas = "";
//        foreach ($lista as $item){
//            
////            $button_edit = "<a id='btn_edit' name='btn-edit' href='/profissoes/editprofissao/{$item->getId_profissao()}' class='btn btn-primary btn-sm'>Editar</a>";
////            $button_delete = '<button type="button" data-toggle="modal" data-target="#'.$idModalExcluir.$item->getId_profissao().'" class="btn btn-danger btn-sm">Excluir </button>';
////                         
////            $buttons = $button_edit." ".$button_delete ;
//
//            $distrito = new Distrito();
//            $distrito = $distrito->selectObj($item->getId_distrito());
//            
//            $linhas .= '<tr>
//                              <th scope="row">'.$item->getId_unidade().'</th>
//                              <td>'.$item->getNome_unidade().'</td>
//                              <td>'.$item->getSigla_unidade().'</td>
//                              <td>'.$distrito->getNome_distrito().'</td>                              
//                              <td></td>                              
//                              <td></td>                              
//                            </tr>
//                        ';
////            
////            $buttonsModal = array('<button type="button" data-dismiss="modal" class="btn btn-secondary">Cancelar</button>'
////                         ,'<a href="/profissoes/deleteprofissao/'.$item->getId_profissao().'"><button type="button" class="btn btn-danger">Excluir Cadastro</button></a>');
////            $content_ .= $this->getModal($idModalExcluir.$item->getId_profissao(), "Excluir Profissão", "Tem Certeza que deseja Excluir o Cadastro?", $buttonsModal);     
//        }
//        
//        $content_ .= '
//                    <div class="col-lg-12">
//                  <div class="card">                    
//                    <div class="card-header d-flex align-items-center">
//                      <h3 class="h4">Lista</h3>
//                    </div>
//                    <div class="card-body">
//                      <div class="table-responsive">                       
//                        <table class="table table-striped table-hover">
//                          <thead>
//                            <tr>
//                              <th>#</th>
//                              <th>UNIDADE</th>                              
//                              <th>SIGLA</th>                              
//                              <th>DISTRITO</th>
//                              <th>AVALIADORES</th>
//                              <th></th>
//                            </tr>
//                          </thead>
//                          <tbody>
//                               '.$linhas.'            
//                          </tbody>
//                        </table>
//                      </div>
//                    </div>
//                  </div>
//                </div>
//              ';
//                                  
//        return $content_;        
//    }
}
