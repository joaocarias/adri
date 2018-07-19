<?php


include_once '../lib/ModelBasico.php';

/**
 * Description of CargosSelecao
 *
 * @author joao.franca
 */
class CargosSelecao extends ModelBasico {
    private $id_cargo_selecao;    
    private $id_cargo;   
    private $criador_por;
    private $data_do_cadastro;
    private $modificador_por;
    private $data_da_modificacao;
    private $id_status;
    
     public function getListObjActive(){
        $sql = " SELECT * FROM tb_cargo_selecao WHERE id_status = '1' ORDER BY id_cargo ASC ";
        
        $dados = array();
        $dados = $this->select($sql);
        
        $array = array();
        
        foreach ($dados as $row){
            
            $obj = new CargosSelecao();
            
            $obj->setCriador_por($row->criado_por);
            $obj->setData_da_modificacao($row->data_da_modificacao);
            $obj->setData_do_cadastro($row->data_do_cadastro);
            $obj->setId_cargo_selecao($row->id_cargo_selecao);
            $obj->setId_cargo($row->id_cargo);
            $obj->setId_status($row->id_status);            
            $obj->setModificador_por($row->modificador_por);
            
            array_push($array, $obj);
        }        
        
        return $array;
    }
    
    public function possui_cargo_selecao($id_cargo){
      $sql = "SELECT * FROM `tb_cargo_selecao`                            
                        WHERE id_status = '1' and id_cargo = '{$id_cargo}' "
                . "ORDER BY `id_cargo` DESC";
        
        $dados = $this->select($sql); 
        
        $res = false;
        foreach($dados as $valor){        
                $res = true;               
        }
        return $res;
    }
    
    function getId_cargo() {
        return $this->id_cargo;
    }

    function setId_cargo($id_cargo) {
        $this->id_cargo = $id_cargo;
    }
        
    function getId_cargo_selecao() {
        return $this->id_cargo_selecao;
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

    function setId_cargo_selecao($id_cargo_selecao) {
        $this->id_cargo_selecao = $id_cargo_selecao;
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
