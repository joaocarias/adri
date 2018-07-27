<?php

/**
 * Description of UnidadesBloqueadas
 *
 * @author joao.franca
 */
class UnidadesBloqueadas {
    /**
     * Lista de Unidades Bloqueadas 
     * @var type array
     */
    private static $arrayUnidades = 
            array(
                76                  //ALTO DA TORRE
                , 89                //Disponivel ao Nivel Central
                , 125               //Junta Medica
                , 85                //Maternidade das Quintas
                , 157               //NÍVEL CENTRAL - CEDIDOS
                , 86                //PAI Sandra Celeste
                , 77                //Ruy Pereira
                , 162               //USF ALTO DA TORRE
            );
    
    /**
     * Este método verifica se uma determinada unidade se encontra bloqueada 
     * ou não liberada 
     * @param type $idTeste id da unidade que será testada
     * @return retorna true se a mesma estiver na lista de bloqueio e false se 
     * não estiver
     */
    public static function unidadeBloqueada($idTeste){
        if(in_array($idTeste, self::$arrayUnidades)){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * Este método retorna uma string de contendo uma subquery para consulta baseada  
     * na tabela unidade do banco dimensionamento
     * @return string retorna a string construído com os ids das unidades de bloqueio
     */
    public static function getStringWhereListaBloqueio(){
        $stringQuery = "";
        foreach (self::$arrayUnidades as $item ){
            $stringQuery .= " AND id_unidade != '{$item}' ";
        }
        
        return $stringQuery;
    }
    
    
    
}
