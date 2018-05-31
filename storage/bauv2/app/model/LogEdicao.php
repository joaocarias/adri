<?php

namespace App\model;
use Lib\Model;

/**
 * Description of LogEdicao
 *
 * @author joao.franca
 */
class LogEdicao extends Model {
    private $id_log;
    private $tabela;
    private $id_tabela;
    private $descricao;
    private $criado_por;
    private $data_da_criacao;
    private $ativo;
    
    function __construct($tabela = null, $id_tabela = null, $descricao = null) {
        $this->tabela = $tabela;
        $this->id_tabela = $id_tabela;
        $this->descricao = $descricao;    
    }
    
    public function inserir(){
        $sql = " insert into tb_log_edicao "
                    . " (tabela, id_tabela, descricao, criado_por) "
                    . " values ('{$this->getTabela()}', '{$this->getId_tabela()}', '{$this->getDescricao()}', '{$_SESSION['id_usuario']}'); ";
                    
       return $this->insert($sql);    
    }
    
    function getId_log() {
        return $this->id_log;
    }

    function getTabela() {
        return $this->tabela;
    }

    function getId_tabela() {
        return $this->id_tabela;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getCriado_por() {
        return $this->criado_por;
    }

    function getData_da_criacao() {
        return $this->data_da_criacao;
    }

    function getAtivo() {
        return $this->ativo;
    }

    function setId_log($id_log) {
        $this->id_log = $id_log;
    }

    function setTabela($tabela) {
        $this->tabela = $tabela;
    }

    function setId_tabela($id_tabela) {
        $this->id_tabela = $id_tabela;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setCriado_por($criado_por) {
        $this->criado_por = $criado_por;
    }

    function setData_da_criacao($data_da_criacao) {
        $this->data_da_criacao = $data_da_criacao;
    }

    function setAtivo($ativo) {
        $this->ativo = $ativo;
    }


}
