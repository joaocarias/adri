<?php

include_once '../lib/ModelBasico.php';

/**
 * Description of Avaliador
 *
 * @author joao.franca
 */
class Avaliador extends ModelBasico {
    private $id_avaliador;
    private $id_servidor;
    private $id_unidade;
    private $criador_por;
    private $data_do_cadastro;
    private $modificador_por;
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
    
    public function is_avaliador($id_servidor){
        $sql = " SELECT count(id_avaliador) as cont FROM tb_avaliador WHERE id_servidor = '{$id_servidor}' AND id_status = '1' ";
        
        $dados = $this->select($sql);        
        $cont = 0;    
        
        foreach ($dados as $row){                        
            $cont = $row->cont;            
        }       
        
        if($cont > 0) return true;
        else return false;
    }
    
    public function getListObjActive(){
        $sql = " SELECT * FROM tb_avaliador WHERE id_status = '1' ORDER BY id_servidor ASC ";
        
        $dados = array();
        $dados = $this->select($sql);
        
        $array = array();
        
        foreach ($dados as $row){
            
            $obj = new Avaliador();
            
            $obj->setCriador_por($row->criado_por);
            $obj->setData_da_modificacao($row->data_da_modificacao);
            $obj->setData_do_cadastro($row->data_do_cadastro);
            $obj->setId_avaliador($row->id_avaliador);
            $obj->setId_servidor($row->id_servidor);
            $obj->setId_status($row->id_status);
            $obj->setId_unidade($row->id_unidade);
            $obj->setModificador_por($row->modificador_por);
            
            array_push($array, $obj);
        }        
        
        return $array;
    }
    
    public function deleteObj($id){
        $sql =  " UPDATE tb_avaliador SET id_status = '0', modificador_por = '{$_SESSION['id_servidor']}', data_da_modificacao = NOW() WHERE id_avaliador = '{$id}'; ";
        $retorno = $this->inativar($sql);
        return $retorno;
    }
        
    function getId_avaliador() {
        return $this->id_avaliador;
    }

    function getId_servidor() {
        return $this->id_servidor;
    }

    function getId_unidade() {
        return $this->id_unidade;
    }

    function getCriador_por() {
        return $this->criador_por;
    }

    function getData_do_cadastro() {
        return $this->data_do_cadastro;
    }

    function getModificador_por() {
        return $this->modificador_por;
    }

    function getData_da_modificacao() {
        return $this->data_da_modificacao;
    }

    function getId_status() {
        return $this->id_status;
    }

    function setId_avaliador($id_avaliador) {
        $this->id_avaliador = $id_avaliador;
    }

    function setId_servidor($id_servidor) {
        $this->id_servidor = $id_servidor;
    }

    function setId_unidade($id_unidade) {
        $this->id_unidade = $id_unidade;
    }

    function setCriador_por($criador_por) {
        $this->criador_por = $criador_por;
    }

    function setData_do_cadastro($data_do_cadastro) {
        $this->data_do_cadastro = $data_do_cadastro;
    }

    function setModificador_por($modificador_por) {
        $this->modificador_por = $modificador_por;
    }

    function setData_da_modificacao($data_da_modificacao) {
        $this->data_da_modificacao = $data_da_modificacao;
    }

    function setId_status($id_status) {
        $this->id_status = $id_status;
    }


}
