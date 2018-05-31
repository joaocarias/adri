<?php

namespace Lib;

/**
 * Description of Model
 *
 * @author joao.franca
 */
class Model extends Conexao {
    public function select($sql){
        try{          
            $pdo = parent::getDB();
            $query = $pdo->prepare($sql);            
            $query->execute();
        } catch (Exception $ex) {
            die("ERROR_404: " . $ex->getMessage() . " " . $sql);
        }
        
        $array = array();
        while($row = $query->fetchObject()){
            $array[] = $row;
        }
        return $array;
    }
    
    public function insert($sql){
        try{
            $pdo = parent::getDB();
            $query = $pdo->prepare($sql);
            $query->execute();
                                   
            return array("id"=>$pdo->lastInsertId(), "msg_tipo"=>"success", "msg"=>"Cadastrado realizado com sucesso!");
        } catch (Exception $ex) {
            return array("id"=>-1, "msg_tipo"=>"error", "msg"=>$ex->getMessage());
        }
    }
    
    public function update($sql){
        try{
            $pdo = parent::getDB();
            $query = $pdo->prepare($sql);
            $query->execute();
                                   
            return array("msg_tipo"=>"success", "msg"=>"Cadastrado atualizado com sucesso!");
        } catch (Exception $ex) {
            return array("msg_tipo"=>"error", "msg"=>$ex->getMessage());
        }
    }
    
    public function inativar($sql){
        try{
            $pdo = parent::getDB();
            $query = $pdo->prepare($sql);
            $query->execute();
                                   
            return array("msg_tipo"=>"success", "msg"=>"Cadastrado Excluído com sucesso!");
        } catch (Exception $ex) {
            return array("msg_tipo"=>"error", "msg"=>$ex->getMessage());
        }
    }
}
