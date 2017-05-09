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

    function berekenTarief($aantalKilometers) {
        foreach ($this->tarieven as $tarief) {
            if ($aantalKilometers <= $tarief->getMaximumAantalKilometers()) {
                return $tarief->getVastePrijs();
            }
        }
        return $tarief->getVastePrijs() + $tarief->getKilometerTarief() * $aantalKilometers;
    }
}