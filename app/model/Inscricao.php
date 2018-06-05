<?php

include_once '../lib/ModelBasico.php';

/**
 * Description of Inscricao
 *
 * @author thalysonluiz
 */
class Inscricao extends ModelBasico{
    private $id_inscricao;
    private $nome_servidor;
    private $cpf_servidor;
    private $cep;
    private $endereco;
    private $telefone;
    private $email;
    private $cargo;
    private $funcao;
    private $unidade_atual;
    private $data_chegada;
    private $experiencia_saude;
    private $motivo_sair;
    private $unidade_vai1;
    private $unidade_vai2;
    private $unidade_vai3;
    
    private $unidade_foi1;
    private $data_chegada_foi1;
    private $data_saida_foi1;
    private $motivo_foi1;
    private $unidade_foi2;
    private $data_chegada_foi2;
    private $data_saida_foi2;
    private $motivo_foi2;
    private $unidade_foi3;
    private $data_chegada_foi3;
    private $data_saida_foi3;
    private $motivo_foi3;
    
    private $solicitado_por;
    private $data_solicitacao;


//    function __construct($id_inscricao, $nome_servidor, $cpf_servidor, $cep, $endereco,
//                         $telefone, $email, $cargo, $funcao, $unidade_atual, $data_chegada,
//                         $motivo_sair, $unidade_vai1, $unidade_vai2, $unidade_vai3, 
//                         $unidade_foi1, $data_chegada_foi1, $data_saida_foi1, $motivo_foi1, 
//                         $unidade_foi2, $data_chegada_foi2, $data_saida_foi2, $motivo_foi2, 
//                         $unidade_foi3, $data_chegada_foi3, $data_saida_foi3, $motivo_foi3) {
//        $this->id_inscricao;
//        $this->nome_servidor;
//        $this->cpf_servidor;
//        $this->cep;
//        $this->endereco;
//        $this->telefone;
//        $this->email;
//        $this->cargo;
//        $this->funcao;
//        $this->unidade_atual;
//        $this->data_chegada;
//        $this->motivo_sair;
//        $this->unidade_vai1;
//        $this->unidade_vai2;
//        $this->unidade_vai3;
//
//        $this->unidade_foi1;
//        $this->data_chegada_foi1;
//        $this->data_saida_foi1;
//        $this->motivo_foi1;
//        $this->unidade_foi2;
//        $this->data_chegada_foi2;
//        $this->data_saida_foi2;
//        $this->motivo_foi2;
//        $this->unidade_foi3;
//        $this->data_chegada_foi3;
//        $this->data_saida_foi3;
//        $this->motivo_foi3;
//    }
    
    public function inserir($nome_servidor, $cpf_servidor, $cep, $endereco,
                         $telefone, $email, $cargo, $funcao, $unidade_atual, $data_chegada,
                         $motivo_sair, $unidade_vai1, $unidade_vai2, $unidade_vai3, $experiencia,
                         $unidade_foi1, $data_chegada_foi1, $data_saida_foi1, $motivo_foi1, 
                         $unidade_foi2, $data_chegada_foi2, $data_saida_foi2, $motivo_foi2, 
                         $unidade_foi3, $data_chegada_foi3, $data_saida_foi3, $motivo_foi3) {
        
        
        $sql = " INSERT INTO `inscricao` (`nome_servidor`, `cpf_servidor`, `cep`, 
                    `endereco`, `telefone`, `email`, `cargo`, `funcao`, `unidade_atual`, `data_chegada_atual`, 
                    `motivo_solicitacao`, `unidade_desejo1`, `unidade_desejo2`, `unidade_desejo3`, `experiencia_saude`,
                    `unidade_anterior1`, `data_chegada_anterior1`, `data_saida_anterior1`, `motivo_saida_anterior1`, 
                    `unidade_anterior2`, `data_chegada_anterior2`, `data_saida_anterior2`, `motivo_saida_anterior2`, 
                    `unidade_anterior3`, `data_chegada_anterior3`, `data_saida_anterior3`, `motivo_saida_anterior3`) 
                    VALUES ( '{$nome_servidor}', '{$cpf_servidor}', '{$cep}', '{$endereco}', 
                            '{$telefone}', '{$email}', '{$cargo}', '{$funcao}', '{$unidade_atual}', '{$data_chegada}',
                            '{$motivo_sair}', '{$unidade_vai1}', '{$unidade_vai2}', '{$unidade_vai3}', '{$experiencia}',
                            '{$unidade_foi1}', '{$data_chegada_foi1}', '{$data_saida_foi1}', '{$motivo_foi1}',
                            '{$unidade_foi2}', '{$data_chegada_foi2}', '{$data_saida_foi2}', '{$motivo_foi2}', 
                            '{$unidade_foi3}', '{$data_chegada_foi3}', '{$data_saida_foi3}', '{$motivo_foi3}');";
        
//        echo $sql;
//        die();
        $arrayRetorno = $this->insert($sql);
        return $arrayRetorno;
    }
    
    public function selectObj($id){
        $sql = " SELECT * FROM `inscricao` WHERE id_inscricao = '{$id}' ORDER BY nome_servidor ASC ";
                
        $dados = $this->select($sql);        
        $obj = new Cargo();
        
        foreach ($dados as $row){                        
            $obj->setId_funcao($row->id_funcao);
            $obj->setNome_funcao($row->nome_funcao);
        }                
        return $obj;
    }
    
    public function selectObjCPF($cpf){
        $sql = " SELECT * FROM `inscricao` WHERE cpf_servidor = '{$cpf}' ORDER BY nome_servidor ASC ";
                
        $dados = $this->select($sql);        
        $obj = new Cargo();
        
        foreach ($dados as $row){                        
            $obj->setId_funcao($row->id_funcao);
            $obj->setNome_funcao($row->nome_funcao);
        }                
        return $obj;
    }

    public function getArrayBasic(){
        $list = $this->getListObjActive();
        
        $array = array();
        
        $i = 0;
        foreach ($list as $item){
            $array[$i]['id'] = $item->getId_funcao();
            $array[$i]['value'] = $item->getNome_funcao();
            $i++;
        }
        
        return $array;
    }
    
    public function getListObjActive(){
        $sql = " SELECT * FROM `inscricao` ORDER BY nome_servidor ASC ";
        
        $dados = array();
        $dados = $this->select($sql);
        
        $array = array();
        
        foreach ($dados as $row){
            
            $obj = new Funcao();
            
            $obj->setId_funcao($row->id_funcao);
            $obj->setNome_funcao($row->nome_funcao);
            
            array_push($array, $obj);
        }        
        
        return $array;
    }
    
    function getIdInscricao() {
        return $this->id_inscricao;
    }

    function getNomeServidor() {
        return $this->nome_servidor;
    }
    
    function getCpfServidor() {
        return $this->cpf_servidor;
    }
    
    function getCep() {
        return $this->cep;
    }
    
    function getEndereco() {
        return $this->endereco;
    }
    
    function getTelefone() {
        return $this->telefone;
    }
    
    function getEmail() {
        return $this->email;
    }
    
    function getCargo() {
        return $this->cargo;
    }
    
    function getFuncao() {
        return $this->funcao;
    }
    
    function getUnidadeAtual() {
        return $this->unidade_atual;
    }
    
    function getDataChegadaAtual() {
        return $this->data_chegada;
    }
    
    function getExperienciaSaude() {
        return $this->experiencia_saude;
    }
    
    function getMotivoSolicitacao() {
        return $this->motivo_sair;
    }
    
    function getUnidadeDesejo1() {
        return $this->unidade_vai1;
    }
    
    function getUnidadeDesejo2() {
        return $this->unidade_vai2;
    }
    
    function getUnidadeDesejo3() {
        return $this->unidade_vai3;
    }
    
    function getUnidadeAnterior1() {
        return $this->unidade_foi1;
    }
    
    function getChegadaUnidadeAnterior1() {
        return $this->data_chegada_foi1;
    }
    
    function getSaidaUnidadeAnterior1() {
        return $this->data_saida_foi1;
    }
    
    function getMotivoUnidadeAnterior1() {
        return $this->motivo_foi1;
    }
    
    function getUnidadeAnterior2() {
        return $this->unidade_foi2;
    }
    
    function getChegadaUnidadeAnterior2() {
        return $this->data_chegada_foi1;
    }
    
    function getSaidaUnidadeAnterior2() {
        return $this->data_saida_foi1;
    }
    
    function getMotivoUnidadeAnterior2() {
        return $this->motivo_foi1;
    }
    
    function getUnidadeAnterior3() {
        return $this->unidade_foi3;
    }
    
    function getChegadaUnidadeAnterior3() {
        return $this->data_chegada_foi1;
    }
    
    function getSaidaUnidadeAnterior3() {
        return $this->data_saida_foi1;
    }
    
    function getMotivoUnidadeAnterior3() {
        return $this->motivo_foi1;
    }
    
    function getDataSolicitacao() {
        return $this->data_solicitacao;
    }
    
    function getSolicitadoPor() {
        return $this->solicitado_por;
    }
    
    function setIdInscricao() {
        return $this->id_inscricao;
    }

    function setNomeServidor() {
        return $this->nome_servidor;
    }
    
    function setCpfServidor() {
        return $this->cpf_servidor;
    }
    
    function setCep() {
        return $this->cep;
    }
    
    function setEndereco() {
        return $this->endereco;
    }
    
    function setTelefone() {
        return $this->telefone;
    }
    
    function setEmail() {
        return $this->email;
    }
    
    function setCargo() {
        return $this->cargo;
    }
    
    function setFuncao() {
        return $this->funcao;
    }
    
    function setUnidadeAtual() {
        return $this->unidade_atual;
    }
    
    function setDataChegadaAtual() {
        return $this->data_chegada;
    }
    
    function setExperienciaSaude() {
        return $this->experiencia_saude;
    }
    
    function setMotivoSolicitacao() {
        return $this->motivo_sair;
    }
    
    function setUnidadeDesejo1() {
        return $this->unidade_vai1;
    }
    
    function setUnidadeDesejo2() {
        return $this->unidade_vai2;
    }
    
    function setUnidadeDesejo3() {
        return $this->unidade_vai3;
    }
    
    function setUnidadeAnterior1() {
        return $this->unidade_foi1;
    }
    
    function setChegadaUnidadeAnterior1() {
        return $this->data_chegada_foi1;
    }
    
    function setSaidaUnidadeAnterior1() {
        return $this->data_saida_foi1;
    }
    
    function setMotivoUnidadeAnterior1() {
        return $this->motivo_foi1;
    }
    
    function setUnidadeAnterior2() {
        return $this->unidade_foi2;
    }
    
    function setChegadaUnidadeAnterior2() {
        return $this->data_chegada_foi1;
    }
    
    function setSaidaUnidadeAnterior2() {
        return $this->data_saida_foi1;
    }
    
    function setMotivoUnidadeAnterior2() {
        return $this->motivo_foi1;
    }
    
    function setUnidadeAnterior3() {
        return $this->unidade_foi3;
    }
    
    function setChegadaUnidadeAnterior3() {
        return $this->data_chegada_foi1;
    }
    
    function setSaidaUnidadeAnterior3() {
        return $this->data_saida_foi1;
    }
    
    function setMotivoUnidadeAnterior3() {
        return $this->motivo_foi1;
    }
    
    function setDataSolicitacao() {
        return $this->data_solicitacao;
    }
    
    function setSolicitadoPor() {
        return $this->solicitado_por;
    }
}
