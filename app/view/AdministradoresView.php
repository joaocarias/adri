<?php

include_once '../lib/Sistema.php';
include_once '../lib/View.php';
include_once '../app/model/Servidor.php';
include_once '../app/model/Unidade.php';
include_once '../app/model/Distrito.php';
include_once '../app/model/Administrador.php';

/**
 * Description of AvaliadoresView
 *
 * @author joao
 */
class AdministradoresView extends View{
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
            }
            
            $retorno = '<section>' .  $this->getFormBusca() 
                            .$conteudo
                       . '</section>';
        }else if($action == "lista"){
            $retorno = '<section>' .  $this->getLista()                             
                       . '</section>';
        }else{
            $retorno = '<section>' .  $this->getLista()                             
                       . '</section>';
        }
        
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
    
    private function getFormBusca(){
        $tituloForm = "Buscar Servidor";
        $actionForm = "administradores.php";
        
        $hi_cadastro = $this->getHidden("cadastro", "true");
                 
        return ' 
                '.$this->beginCard("col-lg-12", $tituloForm).'             
                    '.$this->beginForm("col-lg-12" , "POST", $actionForm).'                          
                    
                            '.$this->getInput("text", "tx_buscar", "Buscar Servidor", "CPF do Administrador" ,"col-sm-6", true, null, false, "999.999.999-99" ).'
                                
                            '.$hi_cadastro.'

                                <div class="line"></div>
                            '.$this->getInputButtonSubmit("btn_buscar_servidor", "Buscar Servidor", "btn-primary").' 
                       
                    '.$this->endForm().'
                '.$this->endCard().'                    
                ';
    }       
 
    public function getTabelaBasicaServidor(Servidor $item){
        $content_ = '';        
        $idModal = 'myModalExcluir';        
//        
        
        $unidade = new Unidade();
        $distrito = new Distrito();
        $lista = $item->getDadosServidorMovimentacaoPorCpf($item->getCpf_servidor());
             
        $linhas = "";
        foreach ($lista as $row){
            
            $button_inserir = '<button type="button" data-toggle="modal" data-target="#'.$idModal.$row->id_servidor.'" class="btn btn-success btn-sm">Adicionar </button>';
            
            $unidade = $unidade->selectObj($row->id_unidade_destino);
          
            $linhas .= '<tr>
                              <th scope="row">'.$row->id_servidor.'</th>
                              <td>'.$row->nome_servidor.'</td>
                              <td>'.$row->cpf_servidor.'</td>
                              <td>'.$row->nome_funcao.'</td>                              
                              <td>'.$unidade->getNome_unidade().'</td>                              
                              <td>'.$distrito->selectObj($unidade->getId_distrito())->getNome_distrito().'</td>        
                              <td>'.$button_inserir.'</td>
                            </tr>
                        ';
            
            $buttonsModal = array('<button type="button" data-dismiss="modal" class="btn btn-secondary">Cancelar</button>'
                         ,'<a href="../controller/AdministradoresController.php?inserir='.$row->id_servidor.'"><button type="button" class="btn btn-success">Adicionar</button></a>');
            $content_ .= $this->getModal($idModal.$row->id_servidor, "Inserir Administrador", "Tem Certeza que deseja Inserir o Servidor como Administrador?", $buttonsModal);  
        }
//        
        $content_ .= '
                    <div class="col-lg-12">
                  <div class="card">                    
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Servidor</h3>
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
                              <th></th>
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
        $idModalExcluir = 'myModalExcluir';        
        
        $myObj = new Administrador();
        $lista = $myObj->getListObjActive();
        
        $unidade = new Unidade();
        $distrito = new Distrito();
        $servidor = new Servidor();
        
        $linhas = "";
        foreach ($lista as $item){
            
            $servidor = $servidor->selectObj($item->getId_servidor());
            $button_delete = '<button type="button" data-toggle="modal" data-target="#'.$idModalExcluir.$item->getId_administrador().'" class="btn btn-danger btn-sm">Remover </button>';

            $linhas .= '<tr>
                              <th scope="row">'.$item->getId_administrador().'</th>
                              <td>'.$servidor->getNome_servidor().'</td>
                              <td>'.$servidor->getCpf_servidor().'</td>                                                         
                              <td>'.$button_delete.'</td>                                                                                       
                            </tr>
                        ';

            $buttonsModal = array('<button type="button" data-dismiss="modal" class="btn btn-secondary">Cancelar</button>'
                         ,'<a href="../controller/AdministradoresController.php?remover='.$item->getId_administrador().'"><button type="button" class="btn btn-danger">Remover Administrador</button></a>');
            $content_ .= $this->getModal($idModalExcluir.$item->getId_administrador(), "Remover Administrador", "Tem Certeza que deseja Remover Administrador?", $buttonsModal);     
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
                              <th>ADMINISTRADOR</th>                              
                              <th>CPF</th>                              
                                                       
                              <th></th>
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
