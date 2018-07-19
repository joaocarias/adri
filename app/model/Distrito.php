<?php

include_once '../lib/ModelDimenisionamento.php';

/**
 * Description of Distrito
 *
 * @author joao
 */
class Distrito extends ModelDimenisionamento{
    private $id_distrito;
    private $nome_distrito;
  
    public function selectObj($id){
        $sql = " SELECT * FROM distrito WHERE id_distrito = '{$id}' ORDER BY nome_distrito ASC ";
                
        $dados = $this->select($sql);        
        $obj = new Distrito();
        
        foreach ($dados as $row){                        
            $obj->setId_distrito($row->id_distrito);            
            $obj->setNome_distrito($row->nome_distrito);            
        }                
        return $obj;
    }
  
  function getId_distrito() {
      return $this->id_distrito;
  }

  function getNome_distrito() {
      return utf8_encode($this->nome_distrito);
  }

  function setId_distrito($id_distrito) {
      $this->id_distrito = $id_distrito;
  }

  function setNome_distrito($nome_distrito) {
      $this->nome_distrito = $nome_distrito;
  }
}
