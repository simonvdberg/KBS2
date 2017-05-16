<?php

namespace model;

class Bezorgopdracht {

    protected $startpunt;
    protected $eindpunt;

    public function __construct() {
        parent::__construct();
    }
    
    function getStartpunt() {
        return $this->startpunt;
    }

    function getEindpunt() {
        return $this->eindpunt;
    }

    function setStartpunt($startpunt) {
        $this->startpunt = $startpunt;
    }

    function setEindpunt($eindpunt) {
        $this->eindpunt = $eindpunt;
    }

}
