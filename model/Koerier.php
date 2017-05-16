<?php

namespace model;

class Koerier extends Model {

    protected $naam;
    protected $tarieven = array();

    function __construct($naam, $tarieven) {
        $this->naam = $naam;
        $this->tarieven = $tarieven;
        parent::__construct();
    }

    function getNaam() {
        return $this->naam;
    }

    function setNaam($naam) {
        $this->naam = $naam;
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