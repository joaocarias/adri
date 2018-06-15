<?php

include_once '../lib/ModelDimenisionamento.php';

/**
 * Description of Funcao
 *
 * @author thalysonluiz
 */
class Funcao extends ModelDimenisionamento{
    private $id_funcao;
    private $nome_funcao;
    
    public function selectObj($id){
        $sql = " SELECT * FROM funcao WHERE id_funcao = '{$id}' ORDER BY nome_funcao ASC ";
                
        $dados = $this->select($sql);        
        $obj = new Funcao();
        
        foreach ($dados as $row){                        
            $obj->setId_funcao($row->id_funcao);
            $obj->setNome_funcao($row->nome_funcao);
        }                
        return $obj;
    }

    public function getArrayBasic(){
        $list = $this->getListObjActive();
        
        $array = array();
        
        $i = 0;
        foreach ($list as $item){
            $array[$i]['id'] = $item->getId_funcao();
            $array[$i]['value'] = $item->getNome_funcao();
            $i++;
        }
        
        return $array;
    }
    
    public function getListObjActive(){
        $sql = " SELECT * FROM funcao ORDER BY nome_funcao ASC ";
        
        $dados = array();
        $dados = $this->select($sql);
        
        $array = array();
        
        foreach ($dados as $row){
            
            $obj = new Funcao();
            
            $obj->setId_funcao($row->id_funcao);
            $obj->setNome_funcao($row->nome_funcao);
            
            array_push($array, $obj);
        }        
        
        return $array;
    }
    
    function getId_funcao() {
        return $this->id_funcao;
    }

    function getNome_funcao() {
        return utf8_encode($this->nome_funcao);
    }
    
    function setId_funcao($id_funcao) {
        $this->id_funcao = $id_funcao;
    }

    function setNome_funcao($nome_funcao) {
        $this->nome_funcao = $nome_funcao;
    }
}
