<?php

namespace Lib;

use Lib\Sistema;
/**
 * Description of View
 *
 * @author joao.franca
 */
class View {
    private $sistema;
    private $title_page;
    
    function __construct($title_page = null, $sistema = null) {
        $this->title_page = is_null($title_page) ? "" : $title_page;
        $this->sistema = is_null($sistema) ? new Sistema() : $sistema;
    }
    
    public function getHeader(){
        return '<head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <title>'.$this->sistema->getName().'</title>
                    <meta name="description" content="'.$this->sistema->getDescription().'">
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    <meta name="robots" content="all,follow">

                   <!-- Bootstrap CSS-->
                    <link rel="stylesheet" href="/layout/vendor/bootstrap/css/bootstrap.min.css">
                    <!-- Font Awesome CSS-->
                    <link rel="stylesheet" href="/layout/vendor/font-awesome/css/font-awesome.min.css">
                    <!-- Fontastic Custom icon font-->
                    <link rel="stylesheet" href="/layout/css/fontastic.css">
                    <!-- Google fonts - Poppins -->
                    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
                    <!-- theme stylesheet-->
                    <link rel="stylesheet" href="/layout/css/style.default.css" id="theme-stylesheet">
                    <!-- Custom stylesheet - for your changes-->
                    <link rel="stylesheet" href="/layout/css/custom.css">
                    <!-- Favicon-->
                    <link rel="shortcut icon" href="/layout/img/favicon.ico">
                    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
                        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
                        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->                                             
   
                </head>';
    }
    
    public function getScritpCorreiosEndereco(){
        return ' <!-- Adicionando Javascript -->
    <script type="text/javascript" >
    
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById("tx_logradouro").value=("");            
            document.getElementById("tx_bairro").value=("");
            document.getElementById("tx_cidade").value=("");
            document.getElementById("tx_uf").value=("");
           
    }
    
    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById("tx_logradouro").value=(conteudo.logradouro);            
            document.getElementById("tx_bairro").value=(conteudo.bairro);
            document.getElementById("tx_cidade").value=(conteudo.localidade);
            document.getElementById("tx_uf").value=(conteudo.uf);
            
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, "");

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById("tx_logradouro").value=("");                
                document.getElementById("tx_bairro").value=("");
                document.getElementById("tx_cidade").value=("");
                document.getElementById("tx_uf").value=("");
               
                //Cria um elemento javascript.
                var script = document.createElement("script");

                //Sincroniza com o callback.
                script.src = "https://viacep.com.br/ws/"+ cep + "/json/?callback=meu_callback";

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();              
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

    </script>';
    }
    
    private function getSearch(){
        $search = '<li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="icon-search"></i></a></li>';
        return "";
    }
    
    private function getNotifications(){
        $notifications = '<li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell-o"></i><span class="badge bg-red badge-corner">12</span></a>
                                      <ul aria-labelledby="notifications" class="dropdown-menu">
                                        <li><a rel="nofollow" href="#" class="dropdown-item"> 
                                            <div class="notification">
                                              <div class="notification-content"><i class="fa fa-envelope bg-green"></i>You have 6 new messages </div>
                                              <div class="notification-time"><small>4 minutes ago</small></div>
                                            </div></a></li>
                                        <li><a rel="nofollow" href="#" class="dropdown-item"> 
                                            <div class="notification">
                                              <div class="notification-content"><i class="fa fa-twitter bg-blue"></i>You have 2 followers</div>
                                              <div class="notification-time"><small>4 minutes ago</small></div>
                                            </div></a></li>
                                        <li><a rel="nofollow" href="#" class="dropdown-item"> 
                                            <div class="notification">
                                              <div class="notification-content"><i class="fa fa-upload bg-orange"></i>Server Rebooted</div>
                                              <div class="notification-time"><small>4 minutes ago</small></div>
                                            </div></a></li>
                                        <li><a rel="nofollow" href="#" class="dropdown-item"> 
                                            <div class="notification">
                                              <div class="notification-content"><i class="fa fa-twitter bg-blue"></i>You have 2 followers</div>
                                              <div class="notification-time"><small>10 minutes ago</small></div>
                                            </div></a></li>
                                        <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong>view all notifications                                            </strong></a></li>
                                      </ul>
                                    </li>';
        
        return '';
    }
    
    private function getMessage(){
        $message = '<li class="nav-item dropdown"> <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-envelope-o"></i><span class="badge bg-orange badge-corner">10</span></a>
                                      <ul aria-labelledby="notifications" class="dropdown-menu">
                                        <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                                            <div class="msg-profile"> <img src="img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
                                            <div class="msg-body">
                                              <h3 class="h5">Jason Doe</h3><span>Sent You Message</span>
                                            </div></a></li>
                                        <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                                            <div class="msg-profile"> <img src="img/avatar-2.jpg" alt="..." class="img-fluid rounded-circle"></div>
                                            <div class="msg-body">
                                              <h3 class="h5">Frank Williams</h3><span>Sent You Message</span>
                                            </div></a></li>
                                        <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                                            <div class="msg-profile"> <img src="img/avatar-3.jpg" alt="..." class="img-fluid rounded-circle"></div>
                                            <div class="msg-body">
                                              <h3 class="h5">Ashley Wood</h3><span>Sent You Message</span>
                                            </div></a></li>
                                        <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong>Read all messages   </strong></a></li>
                                      </ul>
                                    </li>';
        
        return '';
    }
    
    private function getLangueges(){
        $langueges = '<li class="nav-item dropdown"><a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle"><img src="img/flags/16/GB.png" alt="English"><span class="d-none d-sm-inline-block">English</span></a>
                                      <ul aria-labelledby="languages" class="dropdown-menu">
                                        <li><a rel="nofollow" href="#" class="dropdown-item"> <img src="img/flags/16/DE.png" alt="English" class="mr-2">German</a></li>
                                        <li><a rel="nofollow" href="#" class="dropdown-item"> <img src="img/flags/16/FR.png" alt="English" class="mr-2">French                                         </a></li>
                                      </ul>
                                    </li>';
        return '';
    }
    
    public function getNavBar(){
        $explode = explode(" ", $this->sistema->getName());
        
        return ' <!-- Main Navbar-->
                          <header class="header">
                            <nav class="navbar">
                              <!-- Search Box-->
                              <div class="search-box">
                                <button class="dismiss"><i class="icon-close"></i></button>
                                <form id="searchForm" action="#" role="search">
                                  <input type="search" placeholder="What are you looking for..." class="form-control">
                                </form>
                              </div>
                              <div class="container-fluid">
                                <div class="navbar-holder d-flex align-items-center justify-content-between">
                                  <!-- Navbar Header-->
                                  <div class="navbar-header">
                                    <!-- Navbar Brand --><a href="/home" class="navbar-brand">
                                      <div class="brand-text brand-big"><span>'.$explode[0].' </span><strong>'.$explode[2].'</strong></div>
                                      <div class="brand-text brand-small"><strong>'.$this->sistema->getSigla().'</strong></div></a>
                                    <!-- Toggle Button-->
                                    <a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
                                  </div>
                                  <!-- Navbar Menu -->
                                  <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                                    <!-- Search-->
                                    '.$this->getSearch().'
                                    <!-- Notifications-->
                                    '.$this->getNotifications().'
                                    <!-- Messages                        -->
                                    '.$this->getMessage().'
                                    <!-- Languages dropdown    -->
                                    '.$this->getLangueges().'
                                    <!-- Logout    -->
                                    <li class="nav-item"><a href="/logout" class="nav-link logout">Sair<i class="fa fa-sign-out"></i></a></li>
                                  </ul>
                                </div>
                              </div>
                            </nav>
                          </header>';
    }
    
    private function getSidbarMenu(){
        
       // $img = '<div class="avatar"><img src="img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>';
        $img = "";
     //   $cargo = '<p>Web Designer</p>';
        $cargo = "";
        $nome = explode(" ", $_SESSION['nome']);
        $cpf = '<p>'.$_SESSION['cpf'].'</p>';
        $user_name = '<h1 class="h4">'.$nome[0].'</h1>';
      
        $sidbar = '<div class="sidebar-header d-flex align-items-center">
                                '.$img.'
                                <div class="title">
                                     '.$user_name.'
                                    '.$cpf.'
                                </div>
                              </div>';
        
        return $sidbar;
    }
       
    
    private function itemMenu($controller, $icon, $text){
        
        if($this->title_page==$text){
            $select = 'class="active"';
        }else{
            $select = "";
        }        
        return '<li '.$select.' ><a href="'.$controller.'"> <i class="'.$icon.'"></i>'.$text.' </a></li>';
    }

    private function itemMenuDown($controller, $icon, $text, $arrayActions){
        
        if($this->title_page==$text){
            $select = 'class="active"';
        }else{
            $select = "";
        }        
        
        $itens = "";        
        foreach ($arrayActions as $i => $v ){
            $itens .= '<li><a href="'.$controller.'/'.$v.'">'.$i.'</a></li>';
        }
               
        return ' <li '.$select.'><a href="#down'.$text.'" aria-expanded="false" data-toggle="collapse"> <i class="'.$icon.'"></i>'.$text.' </a>
                      <ul id="down'.$text.'" class="collapse list-unstyled ">                      
                        '.$itens.'
                      </ul>
                    </li>                      
              ';
    }

    public function getMenu(){
        
        $arrayUsuario = array("Cadastro" => "novo", "Listar" => "lista", "Resetar Senha" => "lista" );
        $arrayPaciente = array("Cadastro" => "novo", "Listar" => "lista", "Buscar" => "buscar" );
        $arrayConfiguracoes = array("Impressão do BAU" => "impressaobau", "Tipo de Atendimento" => "tipoatendimento" );
        $arrayProfissoes = array("Cadastro" => "novo", "Listar" => "lista" );
        $arrayAtendimento = array("Cadastro" => "novo", "Listar" => "lista" );
        
        return '<nav class="side-navbar">
                              <!-- Sidebar Header-->
                              '.$this->getSidbarMenu().'
                              <!-- Sidebar Navidation Menus--><span class="heading">Principal</span>
                              <ul class="list-unstyled">
                                    '.$this->itemMenu("/home", "icon-home", "Dashboard").'
                                    '.$this->itemMenuDown("/paciente", "icon-user", "Paciente",$arrayPaciente).'
                                    '.$this->itemMenuDown("/atendimento", "icon-check", "Antendimento",$arrayAtendimento).'   
                              </ul>
                              
                              <!-- Sidebar Navidation Menus--><span class="heading">Administrativo</span>
                              <ul class="list-unstyled">   
                                 '.$this->itemMenuDown("/user", "icon-interface-windows", "Usuário",$arrayUsuario).'     
                                 '.$this->itemMenuDown("/profissoes", "icon-presentation", "Profissão",$arrayProfissoes).'   
                                 
                                 '.$this->itemMenu("/home", "icon-list", "Permissão").'
                                 '.$this->itemMenuDown("/config", "icon-bill", "Configurações",$arrayConfiguracoes).'                                                                      
                                                                                                   
                                     
                              </ul>
                              
                                <span class="heading">Extras</span>                              
                              <ul class="list-unstyled">
                                '.$this->itemMenu("/sobre", "icon-website", "Sobre" ).'                                
                              </ul>
                            </nav>';
    }
    
    public function getPagHeader(){
        
        return '<header class="page-header">
                                <div class="container-fluid">
                                  <h2 class="no-margin-bottom">'.$this->title_page.'</h2>
                                </div>
                              </header>';
    }
    
    public function getFooter(){
        return '<footer class="main-footer">
                                <div class="container-fluid">
                                  <div class="row">
                                    <div class="col-sm-6">
                                      <p>Secretaria Municipal de Saúde &copy; 2018</p>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                      <p>Desenvolvido por SGTIC</p>                                      
                                    </div>
                                  </div>
                                </div>
                              </footer>
                            </div>
                          </div>
                        </div>
                        <!-- JavaScript files-->
                        
                        <script src="/layout/vendor/jquery/jquery.min.js"></script>
                        <script src="/layout/vendor/popper.js/umd/popper.min.js"> </script>
                        <script src="/layout/vendor/bootstrap/js/bootstrap.min.js"></script>
                        <script src="/layout/vendor/jquery.cookie/jquery.cookie.js"> </script>
                        <script src="/layout/vendor/chart.js/Chart.min.js"></script>
                        <script src="/layout/vendor/jquery-validation/jquery.validate.min.js"></script>
                        <script src="/layout/vendor/jquery/jquery.mask.js"></script>
                        <script src="/layout/js/charts-home.js"></script>
                        
                        <script>
                        
                            var masks = ["(00) 00000-0000", "(00) 0000-00009"];
                            $(".tx_telefone").mask(masks[1], {onKeyPress: 
                                function(val, e, field, options) {
                            field.mask(val.length > 14 ? masks[0] : masks[1], options) ;
                            }
                            });

                                </script>

                        <!-- Main File-->
                        
                        <script src="/layout/js/front.js"></script>
                        ';
    }
    
    public function getInput($type, $name, $label, $placeholder, $tamanho, $required, $value = null, $bloaquear = null, $mask = null, $maxlength = null, $outro = null){
        if($required){
            $obrigatorio = "required=required";
            $descricao = "* Campo Obrigatório";
        } else {
            $obrigatorio = "";
            $descricao = "";
        }
        
        if(($bloaquear) && (!is_null($bloaquear))){
            $disabled = 'disabled=""';
        }else{
            $disabled = '';
        }
        
        if(is_null($value)){
            $value = "";
        }else{
            $value = "value='{$value}'";
        }
        
        if(($mask) && !is_null($mask)){
            $mask_ = 'data-mask="'.$mask.'"';
        }else{
            $mask_ = '';
        }
        
        if(($maxlength) && !(is_null($maxlength))){
            $maxlength_ = 'maxlength="'.$maxlength.'"';
        }else{
            $maxlength_ = "";
        }
        
        return '<div class="form-group row">
                          <label class="col-sm-3 form-control-label">'.$label.'</label>
                          <div class="'.$tamanho.'">
                            <input  id="'.$name.'" name="'.$name.'" type="'.$type.'" '.$value.' '
                                . ' placeholder="'.$placeholder.'" class="form-control input-sm form-control-success" '.$obrigatorio.' '.$disabled.'
                                    '.$mask_.' '.$maxlength_.' '.$outro.'  >
                                <small class="form-text">'.$descricao.'</small>
                          </div>
                        </div>';
        
    }     
     
    public function getSelect($array, $nome, $label, $tamanho, $required, $id_select = null){
        $selecione = '';
        
        if($required){
            $obrigatorio = "required=required";
            $descricao = "* Campo Obrigatório";
        } else {
            $obrigatorio = "";
            $descricao = "";
        }
                        
        if(is_null($id_select) OR $id_select == "" ){
            $selecione = 'selected="selected"';
        }
        
        $options = "";
        
        foreach ($array as $row){
            if($row['id'] == $id_select){
                $option_selected_ = 'selected="selected"';
            }else{
                $option_selected_ = "";
            }
            
            $options = $options . '<option value="'.$row['id'].'" '.$option_selected_.'>'.$row['value'].'</option>';
        }
        
        return '<div class="form-group row">
                        <label class="col-sm-3 form-control-label">'.$label.'</label>
                        <div class="'.$tamanho.'">
                            <select class="form-control" name="'.$nome.'" id="'.$nome.'" '.$obrigatorio.'>                                
                                  <option valeu="" '.$selecione.' disabled="disabled" >SELECIONE</option>
                                  '.$options.'
                            </select>   
                            <small class="form-text">'.$descricao.'</small>
                        </div>
                    </div>';
        
    }
    
    public function getSelectUF($nome, $label, $tamanho, $required, $value){
         if($required){
            $obrigatorio = "required=required";
            $descricao = "* Campo Obrigatório";
        } else {
            $obrigatorio = "";
            $descricao = "";
        }
        
        if($value=="" OR is_null($value)){
            $value="RN";
        }
                
        return '<div class="form-group row">
                        <label class="col-sm-3 form-control-label">'.$label.'</label>
                        <div class="'.$tamanho.'">
                               <select class="form-control" name="'.$nome.'" id="'.$nome.'" '.$obrigatorio.'>    
                                    <option value="AC" '. ($value==("AC") ? "selected" : "") .'>Acre</option>
                                    <option value="AL" '. ($value==("AL") ? "selected" : "") .'>Alagoas</option>
                                    <option value="AP" '. ($value==("AP") ? "selected" : "") .'>Amapá</option>
                                    <option value="AM" '. ($value==("AM") ? "selected" : "") .'>Amazonas</option>
                                    <option value="BA" '. ($value==("BA") ? "selected" : "") .'>Bahia</option>
                                    <option value="CE" '. ($value==("CE") ? "selected" : "") .'>Ceará</option>
                                    <option value="DF" '. ($value==("DF") ? "selected" : "") .'>Distrito Federal</option>
                                    <option value="ES" '. ($value==("ES") ? "selected" : "") .'>Espírito Santo</option>
                                    <option value="GO" '. ($value==("GO") ? "selected" : "") .'>Goiás</option>
                                    <option value="MA" '. ($value==("MA") ? "selected" : "") .'>Maranhão</option>
                                    <option value="MT" '. ($value==("MT") ? "selected" : "") .'>Mato Grosso</option>
                                    <option value="MS" '. ($value==("MS") ? "selected" : "") .'>Mato Grosso do Sul</option>
                                    <option value="MG" '. ($value==("MG") ? "selected" : "") .'>Minas Gerais</option>
                                    <option value="PA" '. ($value==("PA") ? "selected" : "") .'>Pará</option>
                                    <option value="PB" '. ($value==("PB") ? "selected" : "") .'>Paraíba</option>
                                    <option value="PR" '. ($value==("PR") ? "selected" : "") .'>Paraná</option>
                                    <option value="PE" '. ($value==("PE") ? "selected" : "") .'>Pernambuco</option>
                                    <option value="PI" '. ($value==("PI") ? "selected" : "") .'>Piauí</option>
                                    <option value="RJ" '. ($value==("RJ") ? "selected" : "") .'>Rio de Janeiro</option>
                                    <option value="RN" '. ($value==("RN") ? "selected" : "") .'>Rio Grande do Norte</option>
                                    <option value="RS" '. ($value==("RS") ? "selected" : "") .'>Rio Grande do Sul</option>
                                    <option value="RO" '. ($value==("RO") ? "selected" : "") .'>Rondônia</option>
                                    <option value="RR" '. ($value==("RR") ? "selected" : "") .'>Roraima</option>
                                    <option value="SC" '. ($value==("SC") ? "selected" : "") .'>Santa Catarina</option>
                                    <option value="SP" '. ($value==("SP") ? "selected" : "") .'>São Paulo</option>
                                    <option value="SE" '. ($value==("SE") ? "selected" : "") .'>Sergipe</option>
                                    <option value="TO" '. ($value==("TO") ? "selected" : "") .'>Tocantins</option>                                                        
                            </select>
                            <small class="form-text">'.$descricao.'</small>
                        </div>
                    </div>';
        
    }    
    
    public function getSelectGenero($nome, $label, $tamanho, $required, $value){
         if($required){
            $obrigatorio = "required=required";
            $descricao = "* Campo Obrigatório";
        } else {
            $obrigatorio = "";
            $descricao = "";
        }
        
        $selectFemeninio = "";
        if($value == "FEMININO"){
            $selectFemeninio = "selected=";
        }
        
        return '<div class="form-group row">
                        <label class="col-sm-3 form-control-label">'.$label.'</label>
                        <div class="'.$tamanho.'">
                            <select class="form-control" name="'.$nome.'" id="'.$nome.'">                                
                                  <option value="MASCULINO">MASCULINO</option>
                                  <option value="FEMININO" '.$selectFemeninio.'>FEMININO</option>
                            </select>   
                            <small class="form-text">'.$descricao.'</small>
                        </div>
                    </div>';
        
    }
    
    public function getSelectProfissao($nome, $label, $tamanho, $required, $value){
         if($required){
            $obrigatorio = "required=required";
            $descricao = "* Campo Obrigatório";
        } else {
            $obrigatorio = "";
            $descricao = "";
        }
        
        $selectFemeninio = "";
        if($value == "FEMININO"){
            $selectFemeninio = "selected=";
        }
        
        return '<div class="form-group row">
                        <label class="col-sm-3 form-control-label">'.$label.'</label>
                        <div class="'.$tamanho.'">
                            <select class="form-control" name="'.$nome.'" id="'.$nome.'">                                
                                  <option value="MASCULINO">MASCULINO</option>
                                  <option value="FEMININO" '.$selectFemeninio.'>FEMININO</option>
                            </select>   
                            <small class="form-text">'.$descricao.'</small>
                        </div>
                    </div>';
        
    }
    
    
    
    public function getInputButtonSubmit($name, $valeu, $class){
        return '<div class="form-group row">       
                          <div class="col-sm-9 offset-sm-3">
                            <input type="submit" value="'.$valeu.'" id="'.$name.'" name="'.$name.'" class="btn '.$class.'">
                          </div>
                        </div>';
    }
    
    public function beginCard($tamanho, $titulo){
        return ' <div class="'.$tamanho.'">
                  <div class="card">
                    
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">'.$titulo.'</h3>
                    </div>
                    <div class="card-body">';
    }
    
    public function endCard(){
        return '</div>
                    </div>
                    </div>';
    }
    
    public function beginForm($tamanho, $method, $action){
        return '<form class="form-horizontal"  method="'.$method.'" action="'.$action.'">                                                     
                          <div class="'.$tamanho.'"> ';        
    }
    
    public function endForm(){
        return '</div>
                    </form>';
    }
    
    public function getModal($idModal, $tituo, $mensagem, array $buttons, $form = null){
        if(is_null($form)){
            $form = "";
        }
        
        $listButtons = "";
        foreach ($buttons as $buttons){
            $listButtons .= $buttons;
        }
      
        return '<!-- Modal-->
                      <div id="'.$idModal.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                        <div role="document" class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 id="exampleModalLabel" class="modal-title">'.$tituo.'</h4>
                              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                              <p>'.$mensagem.'</p>
                                '.$form.'
                            </div>
                            <div class="modal-footer">
                                '.$listButtons.'
                            </div>
                          </div>
                        </div>
                      </div>';        
    }
    
    public function getHidden($name, $value){
        return '<input type="hidden" name="'.$name.'" value="'.$value.'">';
    }
    
    public function getAviso(){
        if(isset($_SESSION['retorno']) AND !(is_null($_SESSION['retorno']))  ) {
            $params = $_SESSION['retorno'];
            unset($_SESSION['retorno']);
            
            if(is_array($params)){
                
                return '
                        <div class="col-lg-12">
                            <div class="card">  
                                <div class="card-close">
                                    <div class="dropdown">
                                        <button type="button" id="closeCard7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                                        <div aria-labelledby="closeCard7" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a></div>
                                    </div>
                                </div>
                                <div class="card-header d-flex align-items-center">
                                    <h3 class="h4">Aviso</h3>
                                </div>
                                <div class="card-body">                                                     
                                    <p>'.$params['msg'].'</p>
                                </div>
                            </div>
                       </div>
                      ';       
            }            
        }
    }
}

