<?php

$route[] = ['/','HomeController@index'];
$route[] = ['/home/','HomeController@index'];
$route[] = ['/home','HomeController@index'];
$route[] = ['/admin/','HomeController@index'];
$route[] = ['/logout/','LogoutController@logout'];
$route[] = ['/logout','LogoutController@logout'];
$route[] = ['/login/','LoginController@login'];
$route[] = ['/login','LoginController@login'];

$route[] = ['/user/','UserController@lista'];
$route[] = ['/user','UserController@lista'];
$route[] = ['/user/lista','UserController@lista'];
$route[] = ['/user/novo','UserController@novo'];
$route[] = ['/user/adduser/','UserController@adduser'];
$route[] = ['/user/adduser','UserController@adduser'];
$route[] = ['/user/edituser/','UserController@edituser'];
$route[] = ['/user/edituser','UserController@edituser'];
$route[] = ['/user/updateuser/','UserController@updateuser'];
$route[] = ['/user/updateuser','UserController@updateuser'];
$route[] = ['/user/deleteeuser/','UserController@deleteuser'];
$route[] = ['/user/deleteuser','UserController@deleteuser'];

$route[] = ['/sobre/','SobreController@sobre'];
$route[] = ['/sobre','SobreController@sobre'];

$route[] = ['/paciente/novo','PacienteController@novo'];
$route[] = ['/paciente/novo/','PacienteController@novo'];
$route[] = ['/paciente/addpaciente','PacienteController@addpaciente'];
$route[] = ['/paciente/addpaciente/','PacienteController@addpaciente'];
$route[] = ['/paciente/lista','PacienteController@lista'];
$route[] = ['/paciente/lista/','PacienteController@lista'];
$route[] = ['/paciente/buscar','PacienteController@buscar'];
$route[] = ['/paciente/buscar/','PacienteController@buscar'];

$route[] = ['/profissoes/novo','ProfissoesController@novo'];
$route[] = ['/profissoes/novo/','ProfissoesController@novo'];
$route[] = ['/profissoes/lista','ProfissoesController@lista'];
$route[] = ['/profissoes/lista/','ProfissoesController@lista'];
$route[] = ['/profissoes/addprofissao','ProfissoesController@addprofissao'];
$route[] = ['/profissoes/addprofissao/','ProfissoesController@addprofissao'];
$route[] = ['/profissoes/editprofissao','ProfissoesController@editprofissao'];
$route[] = ['/profissoes/editprofissao/','ProfissoesController@editprofissao'];
$route[] = ['/profissoes/updateprofissao/','ProfissoesController@updateprofissao'];
$route[] = ['/profissoes/updateprofissao','ProfissoesController@updateprofissao'];
$route[] = ['/profissoes/deleteprofissao/','ProfissoesController@deleteprofissao'];
$route[] = ['/profissoes/deleteprofissao','ProfissoesController@deleteprofissao'];

$route[] = ['/config/tipoatendimento/','ConfigController@tipoatendimento'];
$route[] = ['/config/tipoatendimento','ConfigController@tipoatendimento'];
$route[] = ['/config/novotipoatendimento/','ConfigController@novotipoatendimento'];
$route[] = ['/config/novotipoatendimento','ConfigController@novotipoatendimento'];
$route[] = ['/config/addtipoatendimento/','ConfigController@addtipoatendimento'];
$route[] = ['/config/addtipoatendimento','ConfigController@addtipoatendimento'];
$route[] = ['/config/edittipoatendimento','ConfigController@edittipoatendimento'];
$route[] = ['/config/edittipoatendimento/','ConfigController@edittipoatendimento'];
$route[] = ['/config/updatetipoatendimento/','ConfigController@updatetipoatendimento'];
$route[] = ['/config/updatetipoatendimento','ConfigController@updatetipoatendimento'];
$route[] = ['/config/deletetipoatendimento/','ConfigController@deletetipoatendimento'];
$route[] = ['/config/deletetipoatendimento','ConfigController@deletetipoatendimento'];

$route[] = ['/atendimento/novo','PacienteController@buscar'];
$route[] = ['/atendimento/novo/','PacienteController@buscar'];
$route[] = ['/atendimento/paciente','AtendimentoController@paciente'];
$route[] = ['/atendimento/paceiten/','AtendimentoController@paciente'];


//$route[] = ['/bauv2/','HomeController@index'];
//$route[] = ['/bauv2/home/','HomeController@index'];
//$route[] = ['/bauv2/home','HomeController@index'];
//$route[] = ['/bauv2/admin/','HomeController@index'];
//$route[] = ['/bauv2/logout/','LogoutController@logout'];
//$route[] = ['/bauv2/logout','LogoutController@logout'];
//$route[] = ['/bauv2/login/','LoginController@login'];
//$route[] = ['/bauv2/login','LoginController@login'];
//$route[] = ['/bauv2/user/','UserController@lista'];
//$route[] = ['/bauv2/user','UserController@lista'];
//$route[] = ['/bauv2/user/lista','UserController@lista'];
//$route[] = ['/bauv2/user/novo','UserController@novo'];
//$route[] = ['/bauv2/sobre/','SobreController@sobre'];
//$route[] = ['/bauv2/sobre','SobreController@sobre'];

return $route;
