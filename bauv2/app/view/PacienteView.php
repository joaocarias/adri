<?php

namespace App\view;

use Lib\View;
use App\model\Profissao;
use App\model\Paciente;
use App\model\EstadoCivil;
use Lib\Auxiliar;

/**
 * Description of PacienteView
 *
 * @author joao.franca
 */
class PacienteView extends View{
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
        }else if($action == "buscar"){
            return  '<section>' . $this->getBusca() . '</section>';
        }else{
            return $this->getLista();
        }
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
    
    private function getBusca(){
        $tituloForm = "Busca Paciente";
        $actionForm = "/paciente/buscar";
        
        $vBuscar = null;  
        $conteudoTabela = null;
        
        $tx_buscar = filter_input(INPUT_POST, "tx_buscar", FILTER_SANITIZE_STRING);
        $btn_buscar = filter_input(INPUT_POST, "btn_buscar", FILTER_SANITIZE_STRING);
        
        if($btn_buscar){
            $params = array(
                        "nome"=> $tx_buscar
                        , "cpf" => $tx_buscar
                        , "cartao_sus" => $tx_buscar
                        , "rg" => $tx_buscar
                    );
            
            $conteudoTabela .= $this->getLista($params)
                        ;
        }        
        
        return ' 
            '.$this->beginCard("col-lg-12", $tituloForm).'             
                '.$this->beginForm("col-lg-12" , "POST", $actionForm).'   

                    '.$this->getInput("text", "tx_buscar", "Buscar Paciente", "Buscar por Nome, CPF, Cartão do SUS ou RG" , "col-sm-6" , true , $vBuscar, false, null, "199" ).'
                    '.$this->getInputButtonSubmit("btn_buscar", "Buscar Paciente", "btn-primary").'                          

                '.$this->endForm().'
                    
                
            '.$this->endCard().'
                '.$conteudoTabela
            ;
        
    }
    
    private function getForm($action = null, $param = null){
         
        $tituloForm = "Cadastro";
        $actionForm = "/paciente/addpaciente";
        
        $vNome = null;        
        $vCpf = null;
        $vCartaoSUS = null;
        $vProfissao = null;
        $vCep = null;
        $vEndereco = null;
        $vNumero = null;
        $vBairro = null;
        $vUF = null;
        $vCidade = null;        
        $vDataNasscimento = null;
        $vGenero = null;
        $vRG = null;
        $vEstadoCivil = null;
        $vResponsavel = null;
        $vTelefone = null;
       
        $hi_id_obj = "";
        
        if($action == "editar"){
            $tituloForm .= " - ".ucfirst($action);
            $actionForm = "/user/updateuser";
            
//            $obj = new Usuario();
//            $obj = $obj->selectObj($param[0]);
//            $vNome = $obj->getNome();            
//            $vCpf = $obj->getCpf();            
//            $vDataNasscimento = $obj->getData_de_nascimento();
//            $vGenero = $obj->getGenero();
//            $vTelefone = $obj->getTelefone();
//            $vEmail = $obj->getEmail();
//            
//            $hi_id_obj = $this->getHidden("hi_id_obj", $obj->getId_usuario());
//            
        }   
        
        
        //  '.$this->getSelectGenero("tx_genero", "Gênero","col-sm-3",false, $vGenero).'   
        //                    '.$this->getInput("text", "tx_telefone", "Telefone", "(__) ____-____", "col-sm-3" , false, $vTelefone).'
          //                  '.$this->getInput("email", "tx_email", "E-Mail", "user@email.com", "col-sm-6" , false, $vEmail).'   
       
      
        
        
        $prof = new Profissao();
        $arrayBasicProfissoes = $prof->getArrayBasicProfissoes();
        
        $est_civil = new EstadoCivil();
        $arrayBasicEstCivil = $est_civil->getArrayBasicEstadoCivil();
        
        return ' 
                '.$this->beginCard("col-lg-12", $tituloForm).'             
                    '.$this->beginForm("col-lg-12" , "POST", $actionForm).'                          
                                             
 
                            '.$this->getInput("text", "tx_nome", "Nome", "Nome" ,"col-sm-6",true, $vNome, false, null, "199" ).'
                            '.$this->getInput("text", "tx_cpf", "CPF", "___.___.___-__", "col-sm-3",true, $vCpf, false, "000.000.000-00").'
                            '.$this->getInput("text", "tx_cartao_sus", "Cartão do SUS", "", "col-sm-3",false, $vCartaoSUS, false, null, "20").'
                            
                            '.$this->getSelectGenero("tx_genero", "Gênero", "col-sm-3", true, $vGenero).'
                            '.$this->getInput("text", "tx_rg", "RG (Registro Geral)", "Carteira de Identidade", "col-sm-3",false, $vRG, false, null, "20").'
                            '.$this->getInput("date", "tx_data_de_nascimento", "Data de Nascimento", "__/__/____", "col-sm-3" , false, $vDataNasscimento).'  
                            '.$this->getSelect($arrayBasicEstCivil, "tx_estado_civil", "Estado Civil", "col-sm-4" , false, $vEstadoCivil).'
                          
                            '.$this->getInput("text", "tx_responsavel", "Responsável", "Se menor de Idade", "col-sm-3" , false, $vResponsavel, false, null, "199" ).'    
                            '.$this->getInput("text", "tx_telefone", "Telefone", "", "col-sm-3" , false, $vTelefone, false, "(99) 9999-9999", "20").'    
                                
                            '.$this->getSelect($arrayBasicProfissoes, "tx_profissao", "Profissão", "col-sm-4" , false, $vProfissao).'
                            '.$this->getInput("text", "tx_cep", "CEP", "_____-___", "col-sm-3", false, $vCep, null, "99999-999", "9", 'onblur="pesquisacep(this.value);"').'
                            '.$this->getInput("text", "tx_logradouro", "Logradouro", "Logradouro", "col-sm-6", false, $vEndereco).'
                            '.$this->getInput("text", "tx_numero", "Número", "Número", "col-sm-3", false, $vNumero).'
                            '.$this->getInput("text", "tx_bairro", "Bairro", "Bairro", "col-sm-6", false, $vBairro).'                            
                            '.$this->getInput("text", "tx_cidade", "Cidade", "Cidade", "col-sm-3",false, $vCidade).'
                            
                            '.$this->getSelectUF("tx_uf", "UF", "col-sm-6", False, $vUF).'
                                                                                           
                            '.$hi_id_obj.'

                                <div class="line"></div>
                            '.$this->getInputButtonSubmit("btn_salvar", "Salvar", "btn-primary").' 
                       
                    '.$this->endForm().'
                '.$this->endCard().'                    
                ' . $this->getScritpCorreiosEndereco()
                                
                ;
    }
      
    private function getLista($params = null){
               
        $content_ = '';
        
        $idModalExcluir = 'myModalExcluir';        
        
        $obj = new Paciente();
        $lista = $obj->getListObjActive($params);
        
        
        $linhas = "";
        foreach ($lista as $item){
            
            $button_edit = "<a id='btn_edit' name='btn-edit' href='/paciente/editpaciente/{$item->getId_paciente()}' class='btn btn-primary btn-sm'>Editar</a>";
    //          $button_edit = "<a id='btn_edit' name='btn-edit' href='/user/edituser' class='btn btn-primary btn-sm'>Editar</a>";
            $button_delete = '<button type="button" data-toggle="modal" data-target="#'.$idModalExcluir.$item->getId_paciente().'" class="btn btn-danger btn-sm">Excluir </button>';
            $button_atendimento = "<a id='btn_edit' name='btn-edit' href='/atendimento/paciente/{$item->getId_paciente()}' class='btn btn-success btn-sm'>Atendimento</a>";
                         
            $buttons = $button_atendimento ." ". $button_edit." ".$button_delete ;
            
            $linhas .= '<tr>
                              <th scope="row">'.$item->getId_paciente().'</th>
                              <td>'.$item->getNome().'</td>
                              <td>'.$item->getCpf().'</td>
                              <td>'.$item->getCartao_sus().'</td>
                              <td>'.Auxiliar::dateToBR($item->getData_de_nascimento()).'</td>
                              <td>'.$item->getGenero().'</td>                              
                              <td>'.$item->getTelefone().'</td>
                              <td>'.$item->getResponsavel().'</td>                                                    
                              <td>'.$buttons.'</td>                              
                            </tr>
                        ';
            
            $buttonsModal = array('<button type="button" data-dismiss="modal" class="btn btn-secondary">Cancelar</button>'
                         ,'<a href="/paciente/deletepaciente/'.$item->getId_paciente().'"><button type="button" class="btn btn-danger">Excluir Cadastro</button></a>');
            $content_ .= $this->getModal($idModalExcluir.$item->getId_paciente(), "Excluir Paciente", "Tem Certeza que deseja Excluir o Cadastro?", $buttonsModal);     
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
                              <th>CARTÃO DO SUS</th>
                              <th>DATA DE NASCIMENTO</th>
                              <th>GÊNERO</th>                              
                              <th>TELEFONE</th>                             
                              <th>RESPONSÁVEL</th>      
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
