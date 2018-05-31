<?php

namespace App\model;

use Lib\Model;


/**
 * Description of Paciente
 *
 * @author joao.franca
 */
class Paciente extends Model {
    private $id_paciente;
    private $nome;
    private $cpf;
    private $cartao_sus;
    private $genero;
    private $rg;
    private $data_de_nascimento;
    private $id_estado_civil;
    private $responsavel;
    private $telefone;
    private $id_profissao;
    private $cep;
    private $logradouro;
    private $numero;
    private $bairro;
    private $cidade;
    private $uf;
    private $criado_por;
    private $data_da_criacao;
    private $modificado_por;
    private $data_da_modificacao;
    private $ativo;
    
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
    
    public function getListObjActive($params = null){
        if(is_null($params)){
            $sql = " SELECT * FROM tb_paciente WHERE ativo = '1' ORDER BY nome ASC ";
        }else{       
            $wheres = null;
            $t=0;            
            foreach ($params as $coluna => $valor){                
                if($t == 0){
                    $wheres .= " {$coluna} like '%{$valor}%' ";
                } else {
                    $wheres .= " OR {$coluna} like '%{$valor}%' ";                
                }
                $t++;
            }
                        
            $sql = " SELECT * FROM tb_paciente WHERE ativo = '1' AND ( {$wheres} ) ORDER BY nome ASC ";          
        }        
        
        $dados = array();
        $dados = $this->select($sql);
        
        $array = array();
        
        foreach ($dados as $row){
            
            $obj = new Paciente();
            
            $obj->setAtivo($row->ativo);            
            $obj->setCpf($row->cpf);
            $obj->setBairro($row->bairro);
            $obj->setCep($row->cep);
            $obj->setCidade($row->cidade);  
            $obj->setCartao_sus($row->cartao_sus);
            $obj->setCriado_por($row->criado_por);
            $obj->setData_da_criacao($row->data_do_cadastro);
            $obj->setData_da_modificacao($row->data_da_modificacao);
            $obj->setData_de_nascimento($row->data_de_nascimento);
            $obj->setId_estado_civil($row->id_estado_civil);
            $obj->setGenero($row->genero);
            $obj->setUf($row->uf);
            $obj->setId_paciente($row->id_paciente);
            $obj->setId_profissao($row->id_profissao);
            $obj->setLogradouro($row->logradouro);           
            $obj->setModificado_por($row->modificado_por);
            $obj->setNome($row->nome);           
            $obj->setTelefone($row->telefone);
            
            array_push($array, $obj);
        }        
        
        return $array;
    }
    
    public function selectObj($id){
        $sql = " SELECT * FROM tb_paciente WHERE ativo = '1' AND id_paciente = '{$id}' ORDER BY nome ASC ";
                
        $dados = $this->select($sql);        
        $obj = new Paciente();
        
        foreach ($dados as $row){                        
            $obj->setAtivo($row->ativo);            
            $obj->setCpf($row->cpf);
            $obj->setBairro($row->bairro);
            $obj->setCep($row->cep);
            $obj->setCidade($row->cidade);  
            $obj->setCartao_sus($row->cartao_sus);
            $obj->setCriado_por($row->criado_por);
            $obj->setData_da_criacao($row->data_do_cadastro);
            $obj->setData_da_modificacao($row->data_da_modificacao);
            $obj->setData_de_nascimento($row->data_de_nascimento);
            $obj->setId_estado_civil($row->id_estado_civil);
            $obj->setGenero($row->genero);
            $obj->setUf($row->uf);
            $obj->setId_paciente($row->id_paciente);
            $obj->setId_profissao($row->id_profissao);
            $obj->setLogradouro($row->logradouro);           
            $obj->setModificado_por($row->modificado_por);
            $obj->setNome($row->nome);           
            $obj->setTelefone($row->telefone);
        }                
        return $obj;
    }
    
    function getId_paciente() {
        return $this->id_paciente;
    }

    function getNome() {
        return $this->nome;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getCartao_sus() {
        return $this->cartao_sus;
    }

    function getGenero() {
        return $this->genero;
    }

    function getRg() {
        return $this->rg;
    }

    function getData_de_nascimento() {
        return $this->data_de_nascimento;
    }

    function getId_estado_civil() {
        return $this->id_estado_civil;
    }

    function getResponsavel() {
        return $this->responsavel;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getId_profissao() {
        return $this->id_profissao;
    }

    function getCep() {
        return $this->cep;
    }

    function getLogradouro() {
        return $this->logradouro;
    }

    function getNumero() {
        return $this->numero;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getUf() {
        return $this->uf;
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

    function setId_paciente($id_paciente) {
        $this->id_paciente = $id_paciente;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setCartao_sus($cartao_sus) {
        $this->cartao_sus = $cartao_sus;
    }

    function setGenero($genero) {
        $this->genero = $genero;
    }

    function setRg($rg) {
        $this->rg = $rg;
    }

    function setData_de_nascimento($data_de_nascimento) {
        $this->data_de_nascimento = $data_de_nascimento;
    }

    function setId_estado_civil($id_estado_civil) {
        $this->id_estado_civil = $id_estado_civil;
    }

    function setResponsavel($responsavel) {
        $this->responsavel = $responsavel;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setId_profissao($id_profissao) {
        $this->id_profissao = $id_profissao;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setUf($uf) {
        $this->uf = $uf;
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
