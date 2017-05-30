<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of Traject
 *
 * @author Jonas
 */
class Traject extends Model {

    protected $startpunt;
    protected $eindpunt;
    protected $vergoeding;
    
    public function __construct() {
        $this->pk = "traject_id";
        parent::__construct();
    }
    
    function getStartpunt() {
        return $this->startpunt;
    }

    function getEindpunt() {
        return $this->eindpunt;
    }

    function getVergoeding() {
        return $this->vergoeding;
    }

    function setStartpunt($startpunt) {
        $this->startpunt = $startpunt;
    }

    function setEindpunt($eindpunt) {
        $this->eindpunt = $eindpunt;
    }

    function setVergoeding($vergoeding) {
        $this->vergoeding = $vergoeding;
    }

}
