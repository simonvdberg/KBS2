<?php

namespace model;

class Koerier extends Model {

    private $naam;

    function getNaam() {
        return $this->naam;
    }

    function setNaam($naam) {
        $this->naam = $naam;
    }

}
