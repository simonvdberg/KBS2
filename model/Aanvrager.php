<?php

namespace model;

class Aanvrager extends Model {

    private $naam;

    function getNaam() {
        return $this->naam;
    }

    function setNaam($naam) {
        $this->naam = $naam;
    }

}
