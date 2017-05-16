<?php

namespace model;

class Koerier extends Model {

    protected $naam;
    protected $tarieven = array();
    protected $isFietsKoerier;

    function __construct($naam, $tarieven, $isFietsKoerier) {
        $this->naam = $naam;
        $this->tarieven = $tarieven;
        $this->isFietsKoerier = $isFietsKoerier;
        parent::__construct();
    }

    function getNaam() {
        return $this->naam;
    }

    function setNaam($naam) {
        $this->naam = $naam;
    }
    
    function getIsFietsKoerier(){
        return $this->isFietsKoerier;
    }
    
    function berekenTarief($aantalKilometers) {
        foreach ($this->tarieven as $tarief) {
            if ($aantalKilometers <= $tarief->getMaximumAantalKilometers()) {
                return $tarief->getVastePrijs();
            }
        }
        return $tarief->getVastePrijs() + $tarief->getKilometerTarief() * $aantalKilometers;
    }
}