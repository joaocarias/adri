<?php

include_once '../lib/ModelDimenisionamento.php';

/**
 * Description of Servidor
 *
 * @author joao
 */
class Servidor extends ModelDimenisionamento{
   private $id_servidor;
   private $nome_servidor;
   private $senha_servidor;
   private $cpf_servidor;
   private $sexo_servidor;
   private $telefone;
   private $email;
   private $dt_nascimento_servidor;
   private $dt_admissao_servidor;
   private $pis;   
   private $ativo;
   
   public function getObjPorLogin($login){
        $sql = " SELECT * FROM servidor WHERE cpf_servidor = '{$login}' AND ativo = '1' ";
        
        $dados = $this->select($sql);        
        $obj = new Servidor();
        
        foreach ($dados as $row){                        
            $obj->setAtivo($row->ativo);
            $obj->setCpf_servidor($row->cpf_servidor);
            $obj->setDt_admissao_servidor($row->dt_admissao_servidor);
            $obj->setDt_nascimento_servidor($row->dt_nascimento_servidor);
            $obj->setEmail($row->email);
            $obj->setId_servidor($row->id_servidor);
            $obj->setNome_servidor($row->nome_servidor);
            $obj->setPis($row->PIS);
            $obj->setSenha_servidor($row->senha_servidor);
            $obj->setSexo_servidor($row->sexo_servidor);
            $obj->setTelefone($row->telefone);            
        }                
        return $obj;
    }
    
    public function selectObjCPF($cpf){        
        $sql = " SELECT * FROM servidor WHERE cpf_servidor = '{$cpf}' AND ativo = '1' ";
        
        $dados = $this->select($sql);        
        $obj = new Servidor();
        
        foreach ($dados as $row){                        
            $obj->setAtivo($row->ativo);
            $obj->setCpf_servidor($row->cpf_servidor);
            $obj->setDt_admissao_servidor($row->dt_admissao_servidor);
            $obj->setDt_nascimento_servidor($row->dt_nascimento_servidor);
            $obj->setEmail($row->email);
            $obj->setId_servidor($row->id_servidor);
            $obj->setNome_servidor($row->nome_servidor);
            $obj->setPis($row->PIS);
            $obj->setSenha_servidor($row->senha_servidor);
            $obj->setSexo_servidor($row->sexo_servidor);
            $obj->setTelefone($row->telefone);            
        }                
        return $obj;
    }
   
   function getId_servidor() {
       return $this->id_servidor;
   }

   function getNome_servidor() {
       return $this->nome_servidor;
   }

   function getSenha_servidor() {
       return $this->senha_servidor;
   }

   function getCpf_servidor() {
       return $this->cpf_servidor;
   }

   function getSexo_servidor() {
       return $this->sexo_servidor;
   }

   function getTelefone() {
       return $this->telefone;
   }

   function getEmail() {
       return $this->email;
   }

   function getDt_nascimento_servidor() {
       return $this->dt_nascimento_servidor;
   }

   function getDt_admissao_servidor() {
       return $this->dt_admissao_servidor;
   }

   function getPis() {
       return $this->pis;
   }

   function getAtivo() {
       return $this->ativo;
   }

   function setId_servidor($id_servidor) {
       $this->id_servidor = $id_servidor;
   }

   function setNome_servidor($nome_servidor) {
       $this->nome_servidor = $nome_servidor;
   }

   function setSenha_servidor($senha_servidor) {
       $this->senha_servidor = $senha_servidor;
   }

   function setCpf_servidor($cpf_servidor) {
       $this->cpf_servidor = $cpf_servidor;
   }

   function setSexo_servidor($sexo_servidor) {
       $this->sexo_servidor = $sexo_servidor;
   }

   function setTelefone($telefone) {
       $this->telefone = $telefone;
   }

   function setEmail($email) {
       $this->email = $email;
   }

   function setDt_nascimento_servidor($dt_nascimento_servidor) {
       $this->dt_nascimento_servidor = $dt_nascimento_servidor;
   }

   function setDt_admissao_servidor($dt_admissao_servidor) {
       $this->dt_admissao_servidor = $dt_admissao_servidor;
   }

   function setPis($pis) {
       $this->pis = $pis;
   }

   function setAtivo($ativo) {
       $this->ativo = $ativo;
   }


}
