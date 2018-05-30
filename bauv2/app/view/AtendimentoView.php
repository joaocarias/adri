<?php

namespace App\view;

use Lib\View;
use App\model\TipoAtendimento;
use App\model\Paciente;
use Lib\Auxiliar;

/**
 * Description of AtendimentoView
 *
 * @author joao.franca
 */
class AtendimentoView extends View {
    function __construct($title_page = null, $sistema = null) {
        parent::__construct($title_page, $sistema);        
    }
    
    private function getContent($action = null, $params = null){
        if(is_null($action) OR $action == "lista"){              
          //  return  '<section>' . $this->getAviso() . $this->getLista() . '</section>';
        }else if($action == "novo"){
            return  '<section>' . $this->getForm( $action, $params) . '</section>';
//        }else if($action == "editar"){
//            return  '<section>' . $this->getAviso() . $this->getForm($action, $params) . '</section>';
        }else{
          //  return $this->getLista();
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
        $tituloForm = "Novo Atendimento";
        $actionForm = "/atendimento/addatendimento";
        
        $vIdPaciente = "";
        $vNomePaciente = "";                
       
        $vTipoAtendimento = null;
        $hi_id_obj = "";
        if($action == "novo"){
            $obj = new Paciente();
            $obj = $obj->selectObj($param[0]);
            $vIdPaciente = $obj->getId_paciente();
            $vNomePaciente = $obj->getNome();
        }else if($action == "editar"){
            $tituloForm .= " - ".ucfirst($action);
            $actionForm = "/profissoes/updateprofissao";
                            
            $hi_id_obj = $this->getHidden("hi_id_obj", $obj->getId_profissao());
        }                    
        
        $tipo = new TipoAtendimento();
        $arrayBasicTipoAtendimento = $tipo->getArrayBasic();
                
        return ' 
                '.$this->beginCard("col-lg-12", $tituloForm).'             
                    '.$this->beginForm("col-lg-12" , "POST", $actionForm).'                          
                      
                            '.$this->getInput("text", "tx_nome_paciente", "Paciente", "Nome do Paciente" ,"col-sm-6",true, $vNomePaciente, TRUE).'
                            '.$this->getSelect($arrayBasicTipoAtendimento, "tx_tipo_atendimento", "Tipo de Atendimento", "col-sm-4" , true, $vTipoAtendimento).'
                            '. $hi_id_paciente = $this->getHidden("hi_id_paciente", $vIdPaciente).'
                            '.$hi_id_obj.'
                                <div class="line"></div>
                            '.$this->getInputButtonSubmit("btn_salvar", "Salvar", "btn-primary").' 
                       
                    '.$this->endForm().'
                '.$this->endCard().'                    
                ';
    }
}
