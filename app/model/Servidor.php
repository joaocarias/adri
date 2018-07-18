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
    
    public function pussiu_vinculo_ativo($id_servidor){
        $sql = "SELECT * FROM `vinculo`                            
                        WHERE id_servidor = '".$id_servidor."' and ativo = '1' and (id_status_vinculo = '1' OR id_status_vinculo = '2') "
                . "ORDER BY `id_vinculo` DESC";
        
        $dados = $this->select($sql); 
        
        $res = false;
        foreach($dados as $valor){        
                $res = true;               
        }
        return $res;
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
    
    public function selectObj($id){        
        $sql = " SELECT * FROM servidor WHERE id_servidor = '{$id}' AND ativo = '1' ";
        
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
    
    public function getDadosServidorMovimentacaoPorCpf($cpf){
        $sql = "SELECT 
                        s.id_servidor as id_servidor, s.nome_servidor as nome_servidor, s.cpf_servidor as cpf_servidor, f.nome_funcao as nome_funcao, m.* FROM `servidor` as s 
                            INNER JOIN movimentacao as m ON s.id_servidor = m.id_servidor and m.status_movimentacao = '1'
                            INNER JOIN funcao as f ON f.id_funcao = m.id_funcao 
                           
                            WHERE cpf_servidor = '".$cpf."' and s.ativo = '1' ";
        
        $dados = $this->select($sql);        
        return $dados;
    }
    
    public function ehEfetivo($id_servidor){
        $sql = "SELECT * FROM `vinculo`                            
                        WHERE id_servidor = '".$id_servidor."' and ativo = '1' "
                . "ORDER BY `id_vinculo` DESC";
        
        $dados = $this->select($sql); 
        
        $res = false;
        foreach($dados as $valor){
            switch ($valor->id_orgao){
                case 14:
                    $res = true;
                    break;
                case 16:
                    $res = true;
                    break;
                case 17:
                    $res = true;
                    break;
                case 22:
                    $res = true;
                    break;  
                case 35:
                    $res = true;
                    break;  
                
                case 37:
                    $res = true;
                    break;
                case 29:
                    $res = true;
                    break;
                case 3:
                    $res = true;
                    break;
                case 32:
                    $res = true;
                    break;                
                case 6:
                    $res = true;
                    break;                
                
                case 7:
                    $res = true;
                    break;
                case 8:
                    $res = true;
                    break;
                case 9:
                    $res = true;
                    break;
                case 10:
                    $res = true;
                    break;                
                case 31:
                    $res = true;
                    break;   
                
                case 49:
                    $res = true;
                    break;
                case 48:
                    $res = true;
                    break;
                case 34:
                    $res = true;
                    break;
                case 25:
                    $res = true;
                    break;                
                case 54:
                    $res = true;
                    break;   
                
                case 126:
                    $res = true;
                    break;
                case 30:
                    $res = true;
                    break;
                case 52:
                    $res = true;
                    break;
                case 127:
                    $res = true;
                    break;                
                case 53:
                    $res = true;
                    break;   
                
                case 27:
                    $res = true;
                    break;
                case 11:
                    $res = true;
                    break;
                case 44:
                    $res = true;
                    break;
                case 59:
                    $res = true;
                    break;                
                case 75:
                    $res = true;
                    break;   
                
                case 68:
                    $res = true;
                    break;
                case 41:
                    $res = true;
                    break;
                case 24:
                    $res = true;
                    break;
                case 28:
                    $res = true;
                    break;                
                case 13:
                    $res = true;
                    break;   
                
                default :
                    $res = false;
                    break;
            }
        }
        
        return $res;
    }
        
    public function getDadosServidorUltimoVinculo($id){
        $sql = "SELECT * FROM `servidor` s
                    INNER JOIN vinculo v ON s.id_servidor = v.id_servidor
                    INNER JOIN movimentacao m ON s.id_servidor = m.id_servidor
                    WHERE s.ativo = 1 AND s.id_servidor = '{$id}'
                    ORDER BY v.id_vinculo DESC";
        
        $dados = $this->select($sql);  
        
        $result = array();
        
        foreach($dados as $valor){
            $result['id_cargo'] = $valor->id_cargo;  
            $result['id_funcao'] = $valor->id_funcao; 
            $result['id_unidade_destino'] = $valor->id_unidade_destino; 
        }
        
        return $result;
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
