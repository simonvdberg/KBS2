<?php

namespace model;

class Reis extends Model {

    protected $startstation;
    protected $eindstation;

    public function __construct() {
        parent::__construct();
    }
    
    function getStartstation() {
        return $this->startstation;
    }

    function getEindstation() {
        return $this->eindstation;
    }

    function setStartstation($startstation) {
        $this->startstation = $startstation;
    }

    function setEindstation($eindstation) {
        $this->eindstation = $eindstation;
    }

}
