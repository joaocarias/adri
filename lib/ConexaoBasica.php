<?php

/**
 * Description of ConexaoBasica
 *
 * @author joao
 */
class ConexaoBasica {
    private static $local = "127.0.0.1";
    private static $bdname = "bd_srisms";
    private static $user = "root";
    private static $pass = "cep59014030";
    
    private static $instance_ = null;
    
    private static function conectar(){       
        try{            
            if(self::$instance_ == null):
                $dsn = "mysql:host=". self::$local .";dbname=". self::$bdname ;           
              
                self::$instance_ = new \PDO($dsn, self::$user, self::$pass);
                self::$instance_->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            endif;
        } catch (\PDOException $ex) {
           // echo "Erro: ".$ex->getMessage();
           header("location: /");
        }
        return self::$instance_;
    }
    
    protected static function getDB(){        
        return self::conectar();
    }
}
