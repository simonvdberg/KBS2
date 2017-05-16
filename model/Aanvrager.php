<?php

namespace model;

class Aanvrager extends Model {

    protected $naam;

    public function __construct() {
        parent::__construct();
    }
    
    function getNaam() {
        return $this->naam;
    }

    function setNaam($naam) {
        $this->naam = $naam;
    }

}
