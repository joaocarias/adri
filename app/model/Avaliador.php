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
