<?php

/**
 * Description of Conexao
 *
 * @author joao
 */
class ConexaoDimensionamento {
    private static $local = "127.0.0.1";
    private static $bdname = "bd_dimensionamento";
    private static $user = "root";
    private static $pass = "minhasenha";
    
    private static $instance_ = null;
    
    private static function conectar(){       
        try{            
            if(self::$instance_ == null):
                $dsn = "mysql:host=". self::$local .";dbname=". self::$bdname ;           
              
                self::$instance_ = new \PDO($dsn, self::$user, self::$pass);
                self::$instance_->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            endif;
        } catch (\PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return self::$instance_;
    }
    
    protected static function getDB(){        
        return self::conectar();
    }
}
