<?php


include_once '../lib/Sistema.php';

/**
 * Description of LoginView
 *
 * @author joao
 */
class LoginView {
    private $sistema;
    
    function __construct($sistema = null) {
        
        $this->sistema = is_null($sistema) ? new Sistema() : $sistema ;
    }

    private function getHeaderLogin(){
        return '
                      <head>
                        <meta charset="utf-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <title>'.$this->sistema->getName().'</title>
                        <meta name="description" content="'.$this->sistema->getDescription().'">
                        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                        <meta name="robots" content="all,follow">
                        
                        <!-- Bootstrap CSS-->
                        <link rel="stylesheet" href="../layout/vendor/bootstrap/css/bootstrap.min.css">
                        <!-- Font Awesome CSS-->
                        <link rel="stylesheet" href="../layout/vendor/font-awesome/css/font-awesome.min.css">
                        <!-- Fontastic Custom icon font-->
                        <link rel="stylesheet" href="../layout/css/fontastic.css">
                        <!-- Google fonts - Poppins -->
                        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
                        <!-- theme stylesheet-->
                        <link rel="stylesheet" href="../layout/css/style.default.css" id="theme-stylesheet">
                        <!-- Custom stylesheet - for your changes-->
                        <link rel="stylesheet" href="../layout/css/custom.css">
                        <!-- Favicon-->
                        <link rel="shortcut icon" href="../layout/img/favicon.ico">
                        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
                            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
                            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
                      </head>';
        
    }
   
      private function getContent(){
        $action_form = "../controller/LoginController.php";
        
        return ' <div class="page login-page">
                          <div class="container d-flex align-items-center">
                            <div class="form-holder">
                              <div class="row">
                                
                                <!-- Form Panel    -->
                                <div class="col-lg-6 bg-white"> 
                                  <div class="form d-flex align-items-center">
                                    <div class="content">
                                    '.$this->erroLogin().'
                                      <form method="post" class="form-validate" action="'.$action_form.'">
                                        <div class="form-group">
                                          <input id="login-username" type="text" name="loginUsername" required data-msg="Por favor informe seu CPF" class="input-material" 
                                                        data-mask="000.000.000-00" maxlength="14" >
                                          <label for="login-username" class="label-material">CPF do Usuário</label>
                                        </div>
                                        <div class="form-group">
                                          <input id="login-password" type="password" name="loginPassword" required data-msg="Informe a sua Senha" class="input-material" maxlength="30">
                                          <label for="login-password" class="label-material">Senha do Usuário</label>
                                        </div><input type="submit" id="login" name="btnLogin" class="btn btn-primary" value="Login" />                                        
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          
                 
                ';
    
//    private function getContent(){
//        $action_form = "../controller/LoginController.php";
//        
//        return ' <div class="page login-page">
//                          <div class="container d-flex align-items-center">
//                            <div class="form-holder has-shadow">
//                              <div class="row">
//                                <!-- Logo & Information Panel-->
//                                <div class="col-lg-6">
//                                  <div class="info d-flex align-items-center">
//                                    <div class="content">
//                                      <div class="logo">
//                                        <h1>'.$this->sistema->getSigla().'</h1>
//                                        <h2>'.$this->sistema->getName().' '. $this->sistema->getVersao().'</h2>
//                                      </div>
//                                      <p>'.$this->sistema->getCompany().' - '.$this->sistema->getCity().'/'.$this->sistema->getState().'</p>
//                                    </div>
//                                  </div>
//                                </div>
//                                <!-- Form Panel    -->
//                                <div class="col-lg-6 bg-white">
//                                  <div class="form d-flex align-items-center">
//                                    <div class="content">
//                                    '.$this->erroLogin().'
//                                      <form method="post" class="form-validate" action="'.$action_form.'">
//                                        <div class="form-group">
//                                          <input id="login-username" type="text" name="loginUsername" required data-msg="Por favor informe seu CPF" class="input-material" 
//                                                        data-mask="000.000.000-00" maxlength="14" >
//                                          <label for="login-username" class="label-material">CPF do Usuário</label>
//                                        </div>
//                                        <div class="form-group">
//                                          <input id="login-password" type="password" name="loginPassword" required data-msg="Informe a sua Senha" class="input-material" maxlength="30">
//                                          <label for="login-password" class="label-material">Senha do Usuário</label>
//                                        </div><input type="submit" id="login" name="btnLogin" class="btn btn-primary" value="Login" />                                        
//                                    </div>
//                                  </div>
//                                </div>
//                              </div>
//                            </div>
//                          </div>
//                          
//                 
//                ';
        
    }
    
    public function getFooter(){
        return '<div class="copyrights text-center">
                    <p>Desenvolvido por SGTIC - Setor de Tecnologia da Informação e Comunicação</p>                            
                            </p>
                          </div>
                        </div>
                        <!-- JavaScript files-->
                        <script src="../layout/vendor/jquery/jquery.min.js"></script>
                        <script src="../layout/vendor/popper.js/umd/popper.min.js"> </script>
                        <script src="../layout/vendor/bootstrap/js/bootstrap.min.js"></script>
                        <script src="../layout/vendor/jquery.cookie/jquery.cookie.js"> </script>
                        <script src="../layout/vendor/chart.js/Chart.min.js"></script>
                        <script src="../layout/vendor/jquery-validation/jquery.validate.min.js"></script>
                        <script src="../layout/vendor/jquery/jquery.mask.min.js"></script>
                        <!-- Main File-->
                        <script src="../layout/js/front.js"></script>';
    }
    
    public function erroLogin() {
        if(isset($_GET['msg'])){
            if($_GET['msg'] == 'senha_invalida'){
                return '<div class="alert alert-danger" role="alert">
                        CPF/Senha Inválidos!
                      </div>';
            }
        }
    }

   public function get(){
        return '<!DOCTYPE html>
                    <html>
                    '.$this->getHeaderLogin().'
                      <body>
                       '.$this->getContent().'
                          '.$this->getFooter().'
                      </body>
                    </html>';
    }
}
