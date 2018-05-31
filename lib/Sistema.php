<?php

/**
 * Description of Sistema
 *
 * @author joao.franca
 */
class Sistema {
    private $name = "Sistema de Remoção Interna";
    private $reduced_name = "Remoção Interna";
    private $sigla = "RI";
    private $versao = "1.0";
    private $description = "Sistema de Remoção Interna da Secretaria Municipal de Saúde de Natal";
    private $company = "Secretaria Municipal de Saúde";
    private $city = "Natal";
    private $state = "RN";
    private $unity = "Unidade Central";
            
    function getName() {
        return $this->name;
    }

    function getSigla() {
        return $this->sigla;
    }

    function getVersao() {
        return $this->versao;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setSigla($sigla) {
        $this->sigla = $sigla;
    }

    function setVersao($versao) {
        $this->versao = $versao;
    }
    
    function getDescription() {
        return $this->description;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function getCompany() {
        return $this->company;
    }

    function getCity() {
        return $this->city;
    }

    function getState() {
        return $this->state;
    }

    function getUnity() {
        return $this->unity;
    }

    function setCompany($company) {
        $this->company = $company;
    }

    function setCity($city) {
        $this->city = $city;
    }

    function setState($state) {
        $this->state = $state;
    }

    function setUnity($unity) {
        $this->unity = $unity;
    }    
    
    function getReduced_name() {
        return $this->reduced_name;
    }

    function setReduced_name($reduced_name) {
        $this->reduced_name = $reduced_name;
    }
}
