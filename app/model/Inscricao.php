<?php

include_once '../lib/ModelDimenisionamento.php';

/**
 * Description of Inscricao
 *
 * @author thalysonluiz
 */
class Inscricao extends ModelDimenisionamento{
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
                         $motivo_sair, $unidade_vai1, $unidade_vai2, $unidade_vai3, 
                         $unidade_foi1, $data_chegada_foi1, $data_saida_foi1, $motivo_foi1, 
                         $unidade_foi2, $data_chegada_foi2, $data_saida_foi2, $motivo_foi2, 
                         $unidade_foi3, $data_chegada_foi3, $data_saida_foi3, $motivo_foi3) {
        
        
        $sql = " INSERT INTO inscricao ( nome_servidor, cpf_servidor, cep, endereco,
                         telefone, email, cargo, funcao, unidade_atual, data_chegada,
                         motivo_sair, unidade_vai1, unidade_vai2, unidade_vai3, 
                         unidade_foi1, data_chegada_foi1, data_saida_foi1, motivo_foi1, 
                         unidade_foi2, data_chegada_foi2, data_saida_foi2, motivo_foi2, 
                         unidade_foi3, data_chegada_foi3, data_saida_foi3, motivo_foi3, ) "
        . "VALUES ('{$nome_servidor}', '{$cpf_servidor}', '{$cep}', '{$endereco}',
                         '{$telefone}', '{$email}', '{$cargo}', '{$funcao}', '{$unidade_atual}', '{$data_chegada}',
                         '{$motivo_sair}', '{$unidade_vai1}', '{$unidade_vai2}', '{$unidade_vai3}', 
                         '{$unidade_foi1}', '{$data_chegada_foi1}', '{$data_saida_foi1}', '{$motivo_foi1}', 
                         '{$unidade_foi2}', '{$data_chegada_foi2}', '{$data_saida_foi2}', '{$motivo_foi2}', 
                         '{$unidade_foi3}', '{$data_chegada_foi3}', '{$data_saida_foi3}', '{$motivo_foi3}'); ";
        
        echo $sql;
        die();
        $arrayRetorno = $this->insert($sql);
        return $arrayRetorno;
    }
}
