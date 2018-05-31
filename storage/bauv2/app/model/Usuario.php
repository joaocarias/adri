<?php

namespace App\model;

use Lib\Model;


/**
 * Description of Usuario
 *
 * @author joao.franca
 */
class Usuario extends Model{
    private $id_usuario;
    private $nome;
    private $cpf;
    private $data_de_nascimento;
    private $genero;
    private $email;
    private $telefone;
    private $login;
    private $senha;
    private $criado_por;
    private $data_da_criacao;
    private $modificado_por;
    private $data_da_modificacao;
    private $ativo;
                
    public function getObjPorLogin($login){
        $sql = " SELECT * FROM tb_usuario WHERE login = '{$login}' AND ativo = '1' ";
        
        $dados = array();                
        $dados = $this->select($sql);
        
        return $dados;                
    }
    
    public function selectObj($id){
        $sql = " SELECT * FROM tb_usuario WHERE ativo = '1' AND id_usuario = '{$id}' ORDER BY nome ASC ";
                
        $dados = $this->select($sql);        
        $obj = new Usuario();
        
        foreach ($dados as $row){                        
            $obj->setAtivo($row->ativo);
            $obj->setCpf($row->cpf);
            $obj->setCriado_por($row->criado_por);
            $obj->setData_da_criacao($row->data_da_criacao);
            $obj->setData_da_modificacao($row->data_da_modificacao);
            $obj->setData_de_nascimento($row->data_de_nascimento);
            $obj->setEmail($row->email);
            $obj->setGenero($row->genero);
            $obj->setId_usuario($row->id_usuario);
            $obj->setLogin($row->login);
            $obj->setModificado_por($row->modificado_por);
            $obj->setNome($row->nome);
            $obj->setSenha($row->senha);
            $obj->setTelefone($row->telefone);
        }                
        return $obj;
    }
    
    public function deleteObj($id){
        $sql =  " UPDATE tb_usuario SET ativo = '0', modificado_por = '{$_SESSION['id_usuario']}', data_da_modificacao = NOW() WHERE id_usuario = '{$id}'; ";
        $retorno = $this->inativar($sql);
        
        return $retorno;
    }
    
    public function getListObjActive(){
        $sql = " SELECT * FROM tb_usuario WHERE ativo = '1' ORDER BY nome ASC ";
        
        $dados = array();
        $dados = $this->select($sql);
        
        $array = array();
        
        foreach ($dados as $row){
            
            $obj = new Usuario();
            
            $obj->setAtivo($row->ativo);
            $obj->setCpf($row->cpf);
            $obj->setCriado_por($row->criado_por);
            $obj->setData_da_criacao($row->data_da_criacao);
            $obj->setData_da_modificacao($row->data_da_modificacao);
            $obj->setData_de_nascimento($row->data_de_nascimento);
            $obj->setEmail($row->email);
            $obj->setGenero($row->genero);
            $obj->setId_usuario($row->id_usuario);
            $obj->setLogin($row->login);
            $obj->setModificado_por($row->modificado_por);
            $obj->setNome($row->nome);
            $obj->setSenha($row->senha);
            $obj->setTelefone($row->telefone);
            
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
        
        //var_dump($sql);        
               
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
                        
      //  var_dump($sql);        
        
        $arrayRetorno = $this->update($sql);
        return $arrayRetorno;      
    }
    
    function getId_usuario() {
        return $this->id_usuario;
    }

    function getNome() {
        return $this->nome;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getData_de_nascimento() {
        return $this->data_de_nascimento;
    }

    function getGenero() {
        return $this->genero;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
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

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setData_de_nascimento($data_de_nascimento) {
        $this->data_de_nascimento = $data_de_nascimento;
    }

    function setGenero($genero) {
        $this->genero = $genero;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
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
