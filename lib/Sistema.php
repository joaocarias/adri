<?php

/**
 * Description of Sistema
 *
 * @author joao.franca
 */
class Sistema {
    private $name = "Administração de Remanejamento Interno Funcional";
    private $reduced_name = "Remanejamento Interno";
    private $sigla = "ADRIF";
    private $versao = "1.0";
    private $description = "Administração de Remanejamento Interno Funcional da Secretaria Municipal de Saúde de Natal";
    private $company = "Secretaria Municipal de Saúde - Natal/RN";
    private $city = "Natal";
    private $state = "RN";
    private $unity = "Unidade Central";
    private $ano = "2018";
    private $team = "SGTIC";
    
    function getTeam() {
        return $this->team;
    }

    function setTeam($team) {
        $this->team = $team;
    }
    
    function getAno() {
        return $this->ano;
    }

    function setAno($ano) {
        $this->ano = $ano;
    }

                
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
