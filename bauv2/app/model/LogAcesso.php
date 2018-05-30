<?php

namespace App\model;
use Lib\Model;

/**
 * Description of LogAcesso
 *
 * @author joao.franca
 */
class LogAcesso extends Model {
    public function insertObj($id_usuario, $login, $situacao){
        $tabela = "tb_log_acesso";
        if(is_null($id_usuario)){
            $params = array(
                    "login" => $login
                    , "acesso" => $situacao
                );
        }else{
            $params = array("id_usuario" => $id_usuario
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
    }
}
