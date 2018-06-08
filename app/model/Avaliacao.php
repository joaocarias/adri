<?php

include_once '../lib/ModelBasico.php';

/**
 * Description of Avaliacao
 *
 * @author joao.franca
 */
class Avaliacao extends ModelBasico{
    private $id_avaliacao;
    private $id_inscricao;
    private $nota1;
    private $nota2;
    private $nota3;
    private $nota4;
    private $nota5;
    private $pergunta6;
    private $pergunta7;
    private $pergunta8;
    private $pergunta9;
    private $id_avaliador;
    private $data_da_avaliacao;
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
    
    function getId_avaliacao() {
        return $this->id_avaliacao;
    }

    function getId_inscricao() {
        return $this->id_inscricao;
    }

    function getNota1() {
        return $this->nota1;
    }

    function getNota2() {
        return $this->nota2;
    }

    function getNota3() {
        return $this->nota3;
    }

    function getNota4() {
        return $this->nota4;
    }

    function getNota5() {
        return $this->nota5;
    }

    function getPergunta6() {
        return $this->pergunta6;
    }

    function getPergunta7() {
        return $this->pergunta7;
    }

    function getPergunta8() {
        return $this->pergunta8;
    }

    function getPergunta9() {
        return $this->pergunta9;
    }

    function getId_avaliador() {
        return $this->id_avaliador;
    }

    function getData_da_avaliacao() {
        return $this->data_da_avaliacao;
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

    function setId_avaliacao($id_avaliacao) {
        $this->id_avaliacao = $id_avaliacao;
    }

    function setId_inscricao($id_inscricao) {
        $this->id_inscricao = $id_inscricao;
    }

    function setNota1($nota1) {
        $this->nota1 = $nota1;
    }

    function setNota2($nota2) {
        $this->nota2 = $nota2;
    }

    function setNota3($nota3) {
        $this->nota3 = $nota3;
    }

    function setNota4($nota4) {
        $this->nota4 = $nota4;
    }

    function setNota5($nota5) {
        $this->nota5 = $nota5;
    }

    function setPergunta6($pergunta6) {
        $this->pergunta6 = $pergunta6;
    }

    function setPergunta7($pergunta7) {
        $this->pergunta7 = $pergunta7;
    }

    function setPergunta8($pergunta8) {
        $this->pergunta8 = $pergunta8;
    }

    function setPergunta9($pergunta9) {
        $this->pergunta9 = $pergunta9;
    }

    function setId_avaliador($id_avaliador) {
        $this->id_avaliador = $id_avaliador;
    }

    function setData_da_avaliacao($data_da_avaliacao) {
        $this->data_da_avaliacao = $data_da_avaliacao;
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
