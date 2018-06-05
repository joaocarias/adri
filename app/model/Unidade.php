<?php

include_once '../lib/ModelDimenisionamento.php';

/**
 * Description of Unidade
 *
 * @author joao
 */
class Unidade extends ModelDimenisionamento{
    private $id_unidade;
    private $nome_unidade;
    private $id_distrito;
    private $sigla_unidade;
    
    public function selectObj($id){
        $sql = " SELECT * FROM unidade WHERE status_unidade = '1' AND id_unidade = '{$id}' ORDER BY nome_unidade ASC ";
                
        $dados = $this->select($sql);        
        $obj = new Unidade();
        
        foreach ($dados as $row){                        
            $obj->setId_distrito($row->id_distrito);
            $obj->setId_unidade($row->id_unidade);
            $obj->setNome_unidade($row->nome_unidade);
            $obj->setSigla_unidade($row->sigla_unidade);
        }                
        return $obj;
    }
    
     public function getArrayBasic(){
        $list = $this->getListObjActive();
        
        $array = array();
        
        $i = 0;
        foreach ($list as $item){
            $array[$i]['id'] = $item->getId_unidade();
            $array[$i]['value'] = $item->getNome_unidade();
            $i++;
        }
        
        return $array;
    }
    
    public function getListObjActive(){
        $sql = " SELECT * FROM unidade WHERE status_unidade = '1' ORDER BY nome_unidade ASC ";
        
        $dados = array();
        $dados = $this->select($sql);
        
        $array = array();
        
        foreach ($dados as $row){
            
            $obj = new Unidade();
            
            $obj->setId_distrito($row->id_distrito);
            $obj->setId_unidade($row->id_unidade);
            $obj->setNome_unidade($row->nome_unidade);
            $obj->setSigla_unidade($row->sigla_unidade);
            
            array_push($array, $obj);
        }        
        
        return $array;
    }
    
    function getId_unidade() {
        return $this->id_unidade;
    }

    function getNome_unidade() {
        return $this->nome_unidade;
    }

    function getId_distrito() {
        return $this->id_distrito;
    }

    function getSigla_unidade() {
        return $this->sigla_unidade;
    }

    function setId_unidade($id_unidade) {
        $this->id_unidade = $id_unidade;
    }

    function setNome_unidade($nome_unidade) {
        $this->nome_unidade = $nome_unidade;
    }

    function setId_distrito($id_distrito) {
        $this->id_distrito = $id_distrito;
    }

    function setSigla_unidade($sigla_unidade) {
        $this->sigla_unidade = $sigla_unidade;
    }
}
