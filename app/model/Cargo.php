<?php

include_once '../lib/ModelDimenisionamento.php';

/**
 * Description of Cargo
 *
 * @author thalysonluiz
 */
class Cargo extends ModelDimenisionamento{
    private $id_cargo;
    private $nome_cargo;
    
    public function selectObj($id){
        $sql = " SELECT * FROM cargo WHERE id_cargo = '{$id}' ORDER BY nome_cargo ASC ";
                
        $dados = $this->select($sql);        
        $obj = new Cargo();
        
        foreach ($dados as $row){                        
            $obj->setId_cargo($row->id_cargo);
            $obj->setNome_cargo($row->nome_cargo);
        }                
        return $obj;
    }
    
    public function getArrayBasic(){
        $list = $this->getListObjActive();
        
        $array = array();
        
        $i = 0;
        foreach ($list as $item){
            $array[$i]['id'] = $item->getId_cargo();
            $array[$i]['value'] = $item->getNome_cargo();
            $i++;
        }
        
        return $array;
    }

    public function getListObjActive(){
        $sql = " SELECT * FROM cargo ORDER BY nome_cargo ASC ";
        
        $dados = array();
        $dados = $this->select($sql);
        
        $array = array();
        
        foreach ($dados as $row){
            
            $obj = new Cargo();
            
            $obj->setId_cargo($row->id_cargo);
            $obj->setNome_cargo($row->nome_cargo);
            
            array_push($array, $obj);
        }        
        
        return $array;
    }
    
    function getId_cargo() {
        return $this->id_cargo;
    }

    function getNome_cargo() {
        return $this->nome_cargo;
    }
    
    function setId_cargo($id_cargo) {
        $this->id_cargo = $id_cargo;
    }

    function setNome_cargo($nome_cargo) {
        $this->nome_cargo = $nome_cargo;
    }
}