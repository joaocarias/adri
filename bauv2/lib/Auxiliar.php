<?php

namespace Lib;

/**
 * Description of Auxiliar
 *
 * @author joao.franca
 */
class Auxiliar {
    private static $senhaPadrao = "123456";
    
    
    
    
    static function getSenhaPadrao() {
        return self::$senhaPadrao;
    }

    static function setSenhaPadrao($senhaPadrao) {
        self::$senhaPadrao = $senhaPadrao;
    }
    
    public static function dateToBR($dataAmericana){
        $t = strlen($dataAmericana);
        if($t != 10){
            return "";
        }else{
            $d = explode('-', $dataAmericana);
            if(isset($d[2]) && isset($d[1]) && isset($d[0])){
                $dOK = $d[2].'/'.$d[1].'/'.$d[0];
                return $dOK;
            }else{
                return "";
            }
        }
    }
    
    public static function dateToUS($dataBrasil){
        $t = strlen($dataBrasil);
        if($t != 10){
            return "";
        }else{
            $d = explode('/', $dataBrasil);
            if(isset($d[2]) && isset($d[1]) && isset($d[0])){
                $dOK = $d[2].'-'.$d[1].'-'.$d[0];
                return $dOK;
            }else{
                return "";
            }
        }
    }
    
    public static function getStatus($status){
        $value = "DESCONHECIDO";
        switch ($status){
            case 0:
                $value = "EXCLUÍDO";
                break;
            case 1:
                $value = "ATIVO";
                break;
            default :
                $value = "DESCONHECIDO";
                break;            
        }
        
        return $value;
    }

    
    
}
