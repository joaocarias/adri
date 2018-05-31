<?php

namespace App\view;

use Lib\View;
use App\model\TipoAtendimento;
use Lib\Auxiliar;

/**
 * Description of TipoAtendimento
 *
 * @author joao.franca
 */
class TipoAtendimentoView extends View{
    
    function __construct($title_page = null, $sistema = null) {
        parent::__construct($title_page, $sistema);        
    }
    
    private function getContent($action = null, $params = null){
        if(is_null($action) OR $action == "lista"){              
            return  '<section>' . $this->getAviso() . $this->getLista() . '</section>';
        }else if($action == "novo"){
            return  '<section>' . $this->getForm() . '</section>';
        }else if($action == "editar"){
            return  '<section>' . $this->getAviso() . $this->getForm($action, $params) . '</section>';
        }else{
            return $this->getLista();
        }
    }
            
    public function get($action = null, $params = null, $outro = null){
                   
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
        
        $myObj__ = new TipoAtendimento();
        $lista = $myObj__->getListObjActive();
        
        $button_new = $button_edit = "<a id='btn_edit' name='btn-edit' href='/config/novotipoatendimento' class='btn btn-info btn-sm'>Novo Tipo de Atendimento</a>";
        
        $linhas = "";
        foreach ($lista as $item){
            
            $button_edit = "<a id='btn_edit' name='btn-edit' href='/config/edittipoatendimento/{$item->getId_tipo_atendimento()}' class='btn btn-primary btn-sm'>Editar</a>";
            $button_delete = '<button type="button" data-toggle="modal" data-target="#'.$idModalExcluir.$item->getId_tipo_atendimento().'" class="btn btn-danger btn-sm">Excluir </button>';
                         
            $buttons = $button_edit." ".$button_delete ;
            
            $linhas .= '<tr>
                              <th scope="row">'.$item->getId_tipo_atendimento().'</th>
                              <td>'.$item->getTipo_atendimento().'</td>
                              <td>'. Auxiliar::getStatus($item->getAtivo()).'</td>
                              <td>'.$buttons.'</td>                              
                            </tr>
                        ';
            
            $buttonsModal = array('<button type="button" data-dismiss="modal" class="btn btn-secondary">Cancelar</button>'
                         ,'<a href="/config/deletetipoatendimento/'.$item->getId_tipo_atendimento().'"><button type="button" class="btn btn-danger">Excluir Cadastro</button></a>');
            $content_ .= $this->getModal($idModalExcluir.$item->getId_tipo_atendimento(), "Excluir Profissão", "Tem Certeza que deseja Excluir o Cadastro?", $buttonsModal);     
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
                              <th>TIPO DE ATENDIMENTO</th>                              
                              <th>STATUS</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                               '.$linhas.'            
                          </tbody>
                        </table>
                        <p>'.$button_new.'</p>
                      </div>
                    </div>
                  </div>
                </div>
              ';
                                  
        return $content_;        
    }
    
    private function getForm($action = null, $param = null){
        $tituloForm = "Configurações - Tipo de Atendimento";
        $actionForm = "/config/addtipoatendimento";
        
        $vTipoAtendimento = null;        
       
        $hi_id_obj = "";
        
        if($action == "editar"){
            $tituloForm .= " - ".ucfirst($action);
            $actionForm = "/config/updatetipoatendimento";
            
            $obj = new TipoAtendimento();
            $obj = $obj->selectObj($param[0]);
            $vTipoAtendimento = $obj->getTipo_atendimento();            
            $hi_id_obj = $this->getHidden("hi_id_obj", $obj->getId_tipo_atendimento());
        }   
                                       
        return ' 
                '.$this->beginCard("col-lg-12", $tituloForm).'             
                    '.$this->beginForm("col-lg-12" , "POST", $actionForm).'                          
                      
                            '.$this->getInput("text", "tx_tipo_atendimento", "Tipo de Atendimento", "Tipo de Atendimento" ,"col-sm-6",true, $vTipoAtendimento).'
                                
                            '.$hi_id_obj.'

                                <div class="line"></div>
                            '.$this->getInputButtonSubmit("btn_salvar", "Salvar", "btn-primary").' 
                       
                    '.$this->endForm().'
                '.$this->endCard().'                    
                ';
    }
    
   
}
