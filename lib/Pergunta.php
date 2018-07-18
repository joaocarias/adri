<?php

/**
 * Description of Perguntas
 *
 * @author joao.franca
 */
class Pergunta {
    private static $nota1Avaliacao;
    private static $nota2Avaliacao;
    private static $nota3Avaliacao;
    private static $nota4Avaliacao;
    private static $nota5Avaliacao;
    private static $pergunta6Avaliacao;
    private static $pergunta7Avaliacao;
    private static $pergunta8Avaliacao;
    private static $pergunta9Avaliacao;
    
    private static $pergunta10Avaliacao;
    
    private static $arrayPergunta7;
    private static $arrayPergunta8;
    
    private static $arrayPergunta10;
    
    static function stringPergunta7($value){
        $return = "";
        switch ($value){
            case "sim":
                $return = "SIM - Confirmo que o servidor trabalhou na unidade no período indicado";
                break;
            case "nao":
                $return = "NÃO";
                break;
            default :
                $return = "NÃO INFORMADO";
                break;
        }
        
        return $return;
    }
    
    static function stringPergunta10($value){
        $return = "";
        switch ($value){
            case "sim":
                $return = "SIM - Confirmo que o servidor trabalhou no setor no período indicado";
                break;
            case "nao":
                $return = "NÃO";
                break;
            default :
                $return = "NÃO INFORMADO";
                break;
        }
        
        return $return;
    }
    
    static function stringPergunta8($value){
        $return = "";
        switch ($value){
            case "1":
                $return = "Libero o (a) servidor (a) sem substituição";  
                break;
            case "2":
                $return = "Libero o (a) servidor (a) mediante substituição";      
                break;
            case "3":
                $return = "Não Libero o (a) servidor (a)"; 
                break;
            default :
                $return = "NÃO INFORMADO";
                break;
        }
        
        return $return;
    }
    
    static function getArrayPergunta7() {
        
        $arraySimNao = array();
        $arraySimNao[0]['id'] = "sim";
        $arraySimNao[0]['value'] = self::stringPergunta7("sim");            
        $arraySimNao[1]['id'] = "nao";
        $arraySimNao[1]['value'] = self::stringPergunta7("nao");            
        
        self::$arrayPergunta7 = $arraySimNao;        
        return self::$arrayPergunta7;
    }
    
    
    
    static function getArrayPergunta8() {
        
        $arrayLiberacao = array();
        $arrayLiberacao[0]['id'] = "1";
        $arrayLiberacao[0]['value'] = self::stringPergunta8("1");
        $arrayLiberacao[1]['id'] = "2";
        $arrayLiberacao[1]['value'] = self::stringPergunta8("2");
        $arrayLiberacao[2]['id'] = "3";
        $arrayLiberacao[2]['value'] = self::stringPergunta8("3");
        
        self::$arrayPergunta8 = $arrayLiberacao;        
        return self::$arrayPergunta8;
    }
    
    static function getArrayPergunta10() {
        
        $arraySimNao = array();
        $arraySimNao[0]['id'] = "sim";
        $arraySimNao[0]['value'] = self::stringPergunta10("sim");            
        $arraySimNao[1]['id'] = "nao";
        $arraySimNao[1]['value'] = self::stringPergunta10("nao");            
        
        self::$arrayPergunta10 = $arraySimNao;        
        return self::$arrayPergunta10;
    }
       
    static function getNota1Avaliacao() {
        self::$nota1Avaliacao = "O Servidor demostra interesse pela atividade desenvolvida";
        return self::$nota1Avaliacao;
    }

    static function getNota2Avaliacao() {
        self::$nota2Avaliacao = "O Servidor cumpre com as tarefas que lhe são atribuídas e atende as necessidades dos usuários que procuram a Unidade/Departamento";
        return self::$nota2Avaliacao;
    }

    static function getNota3Avaliacao() {
        self::$nota3Avaliacao = "O Servidor mantém um bom relacionamento com a chefia imediata bem como respeita aos regulamentos e normas internas";
        return self::$nota3Avaliacao;
    }

    static function getNota4Avaliacao() {
        self::$nota4Avaliacao = "O servidor cumpre sua jornada de trabalho com pontualidade e regularidade";
        return self::$nota4Avaliacao;
    }

    static function getNota5Avaliacao() {
        self::$nota5Avaliacao = "O Servidor mantém uma postrura ética perante os demais profissionais e usuários";
        return self::$nota5Avaliacao;
    }

    static function getPergunta6Avaliacao() {
        self::$pergunta6Avaliacao = "Cite outras informações que julgue importantes ou que não foram citadas anteriormente";
        return self::$pergunta6Avaliacao;
    }

    static function getPergunta7Avaliacao($data) {
        
        
        self::$pergunta7Avaliacao = "Você confirma que o servidor trabalhou na Unidade a partir do período <strong>{$data}</strong> como informado pelo o mesmo ";
        return self::$pergunta7Avaliacao;
    }

    static function getPergunta8Avaliacao() {
        self::$pergunta8Avaliacao = "Mediante as informações acimas prestadas";
        return self::$pergunta8Avaliacao;
    }

    static function getPergunta9Avaliacao() {
        self::$pergunta9Avaliacao = "Justifique a sua resposta anterior";
        return self::$pergunta9Avaliacao;
    }      
    
    static function getPergunta10Avaliacao($data) {
                
        self::$pergunta10Avaliacao = "Você confirma que o servidor trabalhou no Setor a partir do período <strong>{$data}</strong> como informado pelo o mesmo ";
        return self::$pergunta10Avaliacao;
    }
}
