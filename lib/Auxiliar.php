<?php

include_once 'Sistema.php';

/**
 * Description of Auxiliar
 *
 * @author thalysonluiz
 */
class Auxiliar {
    private $sistema;
    private $title_page;
    
    function __construct($title_page = null, $sistema = null) {
        $this->title_page = is_null($title_page) ? "" : $title_page;
        $this->sistema = is_null($sistema) ? new Sistema() : $sistema;
    }
    
    public static function converterDataParaBR($data_USA){                
        $date = new DateTime($data_USA);      
        return $date->format('d/m/Y');       
    }
    
    public static function converterDataTimeBR($data_USA){                
        $date = new DateTime($data_USA);      
        return $date->format('d/m/Y H:i:s');       
    }
    
    public static function converterDataParaUSA($data_BRA){                        
        $d = explode('/', $data_BRA);
        $dOK = $d[2].'-'.$d[1].'-'.$d[0];
        return $dOK;     
    }
    
    public static function compararDataUSA($data1, $data2){                        
        if(strtotime($data1) == strtotime($data2)){
            return 1;
        }
        else{
            return 0;
        }     
    }
}