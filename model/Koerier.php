<?php

namespace model;

class Koerier extends Model {

    private $naam;
    private $tarieven = array();
    
    
    function __construct($naam, $tarieven) {
        $this->naam = $naam;
        $this->tarieven = $tarieven;
    }

    function getNaam() {
        return $this->naam;
    }

    function setNaam($naam) {
        $this->naam = $naam;
    }
    
    function berekenTarief(){
        
    }
    //TODO implement berekening
    }
