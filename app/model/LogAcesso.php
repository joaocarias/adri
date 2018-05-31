<?php

include_once '../../lib/ModelBasico.php';

/**
 * Description of LogAcesso
 *
 * @author joao
 */
class LogAcesso extends ModelBasico{
    private $id_log;
    private $id_servidor;
    private $login;
    private $acesso;
    private $dada_do_cadastro;
    private $id_status;
    
     public function insertObj($id_servidor, $login, $situacao){
        $tabela = "tb_log_acesso";
        if(is_null($id_servidor)){
            $params = array(
                    "login" => $login
                    , "acesso" => $situacao
                );
        }else{
            $params = array("id_servidor" => $id_servidor
                    , "login" => $login
                    , "acesso" => $situacao
                );
        }
        
        $i = 0;
        
        $colunas = "";        
        $valores = "";
        foreach ($params as $coluna => $valor){
            if($i == 0){
                $colunas .= "{$coluna}";
                $valores .= "'{$valor}'";
            }else{
                $colunas .= ", {$coluna}";
                $valores .= ", '{$valor}'";
            }
            $i++;
        }
        
        $sql = " INSERT INTO {$tabela} ( {$colunas} ) "
        . "VALUES ({$valores}); ";
        
        $arrayRetorno = $this->insert($sql);
        return $arrayRetorno;
    }
    
    function getId_log() {
        return $this->id_log;
    }

    function getId_servidor() {
        return $this->id_servidor;
    }

    function getLogin() {
        return $this->login;
    }

    function getAcesso() {
        return $this->acesso;
    }

    function getDada_do_cadastro() {
        return $this->dada_do_cadastro;
    }

    function getId_status() {
        return $this->id_status;
    }

    function setId_log($id_log) {
        $this->id_log = $id_log;
    }

    function setId_servidor($id_servidor) {
        $this->id_servidor = $id_servidor;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setAcesso($acesso) {
        $this->acesso = $acesso;
    }

    function setDada_do_cadastro($dada_do_cadastro) {
        $this->dada_do_cadastro = $dada_do_cadastro;
    }

    function setId_status($id_status) {
        $this->id_status = $id_status;
    }
}
