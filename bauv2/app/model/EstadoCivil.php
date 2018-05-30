<?php

namespace App\model;
use Lib\Model;

/**
 * Description of EstadoCivil
 *
 * @author joao.franca
 */
class EstadoCivil extends Model {
    private $id_estado_civil;
    private $estado_civil;    
    private $criado_por;
    private $data_da_criacao;
    private $modificado_por;
    private $data_da_modificacao;
    private $ativo;
    
    public function selectObj($id){
        $sql = " SELECT * FROM tb_estado_civil WHERE ativo = '1' AND id_estado_civil = '{$id}' ORDER BY estado_civil ASC ";
                
        $dados = $this->select($sql);        
        $obj = new EstadoCivil();
        
        foreach ($dados as $row){                        
            $obj->setAtivo($row->ativo);            
            $obj->setCriado_por($row->criado_por);
            $obj->setData_da_criacao($row->data_do_cadastro);
            $obj->setData_da_modificacao($row->data_da_modificacao);            
            $obj->setId_estado_civil($row->id_estado_civil);            
            $obj->setModificado_por($row->modificado_por);
            $obj->setEstado_civil($row->estado_civil);                        
        }                
        return $obj;
    }
    
    public function deleteObj($id){
        $sql =  " UPDATE tb_estado_civil SET ativo = '0', modificado_por = '{$_SESSION['id_estado_civil']}', data_da_modificacao = NOW() WHERE id_estado_civil = '{$id}'; ";
        $retorno = $this->inativar($sql);
        return $retorno;
    }
    
    public function getArrayBasicEstadoCivil(){
        $list = $this->getListObjActive();
        
        $array = array();
        
        $i = 0;
        foreach ($list as $item){
            $array[$i]['id'] = $item->getId_estado_civil();
            $array[$i]['value'] = $item->getEstado_civil();
            $i++;
        }
        
        return $array;
    }
    
    public function getListObjActive(){
        $sql = " SELECT * FROM tb_estado_civil WHERE ativo = '1' ORDER BY estado_civil ASC ";
        
        $dados = array();
        $dados = $this->select($sql);
        
        $array = array();
        
        foreach ($dados as $row){
            
            $obj = new EstadoCivil();
            
            $obj->setAtivo($row->ativo);            
            $obj->setCriado_por($row->criado_por);
            $obj->setData_da_criacao($row->data_do_cadastro);
            $obj->setData_da_modificacao($row->data_da_modificacao);            
            $obj->setId_estado_civil($row->id_estado_civil);            
            $obj->setModificado_por($row->modificado_por);
            $obj->setEstado_civil($row->estado_civil);           
            
            array_push($array, $obj);
        }        
        
        return $array;
    }
    
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
    
    public function updateObj($tabela, array $paramsSet, array $paramsWhere){
        $i = 0;
        
        $sets = "";        
        $wheres = "";
        foreach ($paramsSet as $coluna => $valor){
            if($i == 0){
                $sets .= " {$coluna}='{$valor}' ";
            }else{
                $sets .= ", {$coluna}='{$valor}' ";
            }
            $i++;
        }
        
        $t = 0;
        foreach ($paramsWhere as $coluna => $valor){
            if($t == 0){
                $wheres .= " {$coluna}='{$valor}' ";
            }else{
                $wheres .= " AND {$coluna}='{$valor}' ";
            }
            $t++;
        }
        
        
        $sql = " UPDATE {$tabela} SET {$sets} , data_da_modificacao=NOW() "
        . " WHERE {$wheres}; ";
                                   
        $arrayRetorno = $this->update($sql);
        return $arrayRetorno;      
    }
    
    function getId_estado_civil() {
        return $this->id_estado_civil;
    }

    function getEstado_civil() {
        return $this->estado_civil;
    }

    function getCriado_por() {
        return $this->criado_por;
    }

    function getData_da_criacao() {
        return $this->data_da_criacao;
    }

    function getModificado_por() {
        return $this->modificado_por;
    }

    function getData_da_modificacao() {
        return $this->data_da_modificacao;
    }

    function getAtivo() {
        return $this->ativo;
    }

    function setId_estado_civil($id_estado_civil) {
        $this->id_estado_civil = $id_estado_civil;
    }

    function setEstado_civil($estado_civil) {
        $this->estado_civil = $estado_civil;
    }

    function setCriado_por($criado_por) {
        $this->criado_por = $criado_por;
    }

    function setData_da_criacao($data_da_criacao) {
        $this->data_da_criacao = $data_da_criacao;
    }

    function setModificado_por($modificado_por) {
        $this->modificado_por = $modificado_por;
    }

    function setData_da_modificacao($data_da_modificacao) {
        $this->data_da_modificacao = $data_da_modificacao;
    }

    function setAtivo($ativo) {
        $this->ativo = $ativo;
    }
}
