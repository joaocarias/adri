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
    
     public function getListObjActive(){
        $sql = " SELECT * FROM tb_administrador WHERE id_status = '1' ORDER BY id_servidor ASC ";
        
        $dados = array();
        $dados = $this->select($sql);
        
        $array = array();
        
        foreach ($dados as $row){
            
            $obj = new Administrador();
            
            $obj->setCriado_por($row->criado_por);
            $obj->setData_da_modificacao($row->data_da_modificacao);
            $obj->setData_do_cadastro($row->data_do_cadastro);
            $obj->setId_administrador($row->id_administrador);
            $obj->setId_servidor($row->id_servidor);
            $obj->setId_status($row->id_status);            
            $obj->setModificado_por($row->modificado_por);
            
            array_push($array, $obj);
        }        
        
        return $array;
    }
    
    public function deleteObj($id){
        $sql =  " UPDATE tb_administrador SET id_status = '0', modificado_por = '{$_SESSION['id_servidor']}', data_da_modificacao = NOW() WHERE id_administrador = '{$id}'; ";
        $retorno = $this->inativar($sql);
        return $retorno;
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
