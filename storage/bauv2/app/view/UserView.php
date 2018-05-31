<?php

namespace App\view;
use Lib\View;
use Lib\Auxiliar;
use App\model\Usuario;

/**
 * Description of User
 *
 * @author joao.franca
 */
class UserView extends View{
    
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
        
    private function getForm($action = null, $param = null){
        $tituloForm = "Cadastro";
        $actionForm = "/user/adduser";
        
        $vNome = null;        
        $vCpf = null;
        $vDataNasscimento = null;
        $vGenero = null;
        $vTelefone = null;
        $vEmail = null;        
       
        $hi_id_obj = "";
        
        if($action == "editar"){
            $tituloForm .= " - ".ucfirst($action);
            $actionForm = "/user/updateuser";
            
            $obj = new Usuario();
            $obj = $obj->selectObj($param[0]);
            $vNome = $obj->getNome();            
            $vCpf = $obj->getCpf();            
            $vDataNasscimento = $obj->getData_de_nascimento();
            $vGenero = $obj->getGenero();
            $vTelefone = $obj->getTelefone();
            $vEmail = $obj->getEmail();
            
            $hi_id_obj = $this->getHidden("hi_id_obj", $obj->getId_usuario());
            
        }   
                                       
        return ' 
                '.$this->beginCard("col-lg-12", $tituloForm).'             
                    '.$this->beginForm("col-lg-12" , "POST", $actionForm).'                          
                      
                            '.$this->getInput("text", "tx_nome", "Nome", "Nome" ,"col-sm-6",true, $vNome).'
                            '.$this->getInput("text", "tx_cpf", "CPF", "___.___.___-__", "col-sm-3",true, $vCpf, false, "data-mask='000.000.000-00'").'
                            '.$this->getInput("date", "tx_data_de_nascimento", "Data de Nascimento", "__/__/____", "col-sm-3" , false, $vDataNasscimento).'                                
                            '.$this->getSelectGenero("tx_genero", "Gênero","col-sm-3",false, $vGenero).'   
                            '.$this->getInput("text", "tx_telefone", "Telefone", "(__) ____-____", "col-sm-3" , false, $vTelefone).'
                            '.$this->getInput("email", "tx_email", "E-Mail", "user@email.com", "col-sm-6" , false, $vEmail).'   
                                
                            '.$hi_id_obj.'

                                <div class="line"></div>
                            '.$this->getInputButtonSubmit("btn_salvar", "Salvar", "btn-primary").' 
                       
                    '.$this->endForm().'
                '.$this->endCard().'                    
                ';
    }


    private function getLista(){
        
        
        $content_ = '';
        
        $idModalExcluir = 'myModalExcluir';        
        
        $user = new Usuario();
        $lista = $user->getListObjActive();
        
        $linhas = "";
        foreach ($lista as $item){
            
            $button_edit = "<a id='btn_edit' name='btn-edit' href='/user/edituser/{$item->getId_usuario()}' class='btn btn-primary btn-sm'>Editar</a>";
    //          $button_edit = "<a id='btn_edit' name='btn-edit' href='/user/edituser' class='btn btn-primary btn-sm'>Editar</a>";
            $button_delete = '<button type="button" data-toggle="modal" data-target="#'.$idModalExcluir.$item->getId_usuario().'" class="btn btn-danger btn-sm">Excluir </button>';
                         
            $buttons = $button_edit." ".$button_delete ;
            
            $linhas .= '<tr>
                              <th scope="row">'.$item->getId_usuario().'</th>
                              <td>'.$item->getNome().'</td>
                              <td>'.$item->getCpf().'</td>
                              <td>'.Auxiliar::dateToBR($item->getData_de_nascimento()).'</td>
                              <td>'.$item->getGenero().'</td>
                              <td>'.$item->getEmail().'</td>
                              <td>'.$item->getTelefone().'</td>
                              <td>'. Auxiliar::getStatus($item->getAtivo()).'</td>
                              <td>'.$buttons.'</td>                              
                            </tr>
                        ';
            
            $buttonsModal = array('<button type="button" data-dismiss="modal" class="btn btn-secondary">Cancelar</button>'
                         ,'<a href="/user/deleteuser/'.$item->getId_usuario().'"><button type="button" class="btn btn-danger">Excluir Cadastro</button></a>');
            $content_ .= $this->getModal($idModalExcluir.$item->getId_usuario(), "Excluir Usuário", "Tem Certeza que deseja Excluir o Cadastro?", $buttonsModal);     
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
                              <th>NOME</th>
                              <th>CPF</th>
                              <th>DATA DE NASCIMENTO</th>
                              <th>GÊNERO</th>
                              <th>E-MAIL</th>
                              <th>TELEFONE</th>                             
                              <th>STATUS</th>
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
