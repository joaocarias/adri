<?php


namespace App\model;

use Lib\Model;

/**
 * Description of Profissao
 *
 * @author joao.franca
 */
class Profissao extends Model{
    private $id_profissao;
    private $profissao;    
    private $criado_por;
    private $data_da_criacao;
    private $modificado_por;
    private $data_da_modificacao;
    private $ativo;
    
    public function selectObj($id){
        $sql = " SELECT * FROM tb_profissao WHERE ativo = '1' AND id_profissao = '{$id}' ORDER BY profissao ASC ";
                
        $dados = $this->select($sql);        
        $obj = new Profissao();
        
        foreach ($dados as $row){                        
            $obj->setAtivo($row->ativo);            
            $obj->setCriado_por($row->criado_por);
            $obj->setData_da_criacao($row->data_da_criacao);
            $obj->setData_da_modificacao($row->data_da_modificacao);            
            $obj->setId_profissao($row->id_profissao);            
            $obj->setModificado_por($row->modificado_por);
            $obj->setProfissao($row->profissao);                        
        }                
        return $obj;
    }
    
    public function deleteObj($id){
        $sql =  " UPDATE tb_profissao SET ativo = '0', modificado_por = '{$_SESSION['id_usuario']}', data_da_modificacao = NOW() WHERE id_profissao = '{$id}'; ";
        $retorno = $this->inativar($sql);
        return $retorno;
    }
    
    public function getArrayBasicProfissoes(){
        $list = $this->getListObjActive();
        
        $array = array();
        
        $i = 0;
        foreach ($list as $item){
            $array[$i]['id'] = $item->getId_profissao();
            $array[$i]['value'] = $item->getProfissao();
            $i++;
        }
        
        return $array;
    }
    
    public function getListObjActive(){
        $sql = " SELECT * FROM tb_profissao WHERE ativo = '1' ORDER BY profissao ASC ";
        
        $dados = array();
        $dados = $this->select($sql);
        
        $array = array();
        
        foreach ($dados as $row){
            
            $obj = new Profissao();
            
            $obj->setAtivo($row->ativo);            
            $obj->setCriado_por($row->criado_por);
            $obj->setData_da_criacao($row->data_da_criacao);
            $obj->setData_da_modificacao($row->data_da_modificacao);            
            $obj->setId_profissao($row->id_profissao);            
            $obj->setModificado_por($row->modificado_por);
            $obj->setProfissao($row->profissao);           
            
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
    
    function getId_profissao() {
        return $this->id_profissao;
    }

    function getProfissao() {
        return $this->profissao;
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

    function setId_profissao($id_profissao) {
        $this->id_profissao = $id_profissao;
    }

    function setProfissao($profissao) {
        $this->profissao = $profissao;
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
