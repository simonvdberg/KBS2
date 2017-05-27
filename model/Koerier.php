<?php

namespace model;

class Koerier extends Model {

    protected $koerier_id;
    protected $naam;
    protected $tarieven = array();
    protected $isFietsKoerier;

    function __construct($naam, $tarieven, $isFietsKoerier) {
        $this->naam = $naam;
        $this->tarieven = $tarieven;
        $this->isFietsKoerier = $isFietsKoerier;
        $this->pk = "koerier_id";
        parent::__construct();
    }

    function getKoerier_id() {
        return $this->koerier_id;
    }

    function getNaam() {
        return $this->naam;
    }

    function setNaam($naam) {
        $this->naam = $naam;
    }

    function setKoerier_id($koerier_id) {
        $this->koerier_id = $koerier_id;
    }

    function getIsFietsKoerier() {
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
