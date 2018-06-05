<?php


include_once '../lib/ModelBasico.php';

/**
 * Description of Administrador
 *
 * @author joao.franca
 */
class Administrador extends ModelBasico {
    private $id_administrador;
    private $id_servidor;    
    private $criado_por;
    private $data_do_cadastro;
    private $modificado_por;
    private $data_da_modificacao;
    private $id_status;
    
     public function insertObj($tabela, array $params){       
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
        . " VALUES ({$valores}); ";         
               
        return $this->insert($sql);
    }
    
    function getId_administrador() {
        return $this->id_administrador;
    }

    function getId_servidor() {
        return $this->id_servidor;
    }

    function getCriado_por() {
        return $this->criado_por;
    }

    function getData_do_cadastro() {
        return $this->data_do_cadastro;
    }

    function getModificado_por() {
        return $this->modificado_por;
    }

    function getData_da_modificacao() {
        return $this->data_da_modificacao;
    }

    function getId_status() {
        return $this->id_status;
    }

    function setId_administrador($id_administrador) {
        $this->id_administrador = $id_administrador;
    }

    function setId_servidor($id_servidor) {
        $this->id_servidor = $id_servidor;
    }

    function setCriado_por($criado_por) {
        $this->criado_por = $criado_por;
    }

    function setData_do_cadastro($data_do_cadastro) {
        $this->data_do_cadastro = $data_do_cadastro;
    }

    function setModificado_por($modificado_por) {
        $this->modificado_por = $modificado_por;
    }

    function setData_da_modificacao($data_da_modificacao) {
        $this->data_da_modificacao = $data_da_modificacao;
    }

    function setId_status($id_status) {
        $this->id_status = $id_status;
    }


}
