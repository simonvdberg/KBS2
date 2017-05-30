<?php

namespace model;

class Klant extends Model {

    public function __construct() {
        $this->pk = "klant_id";
        parent::__construct();
    }

    protected $klant_id;
    protected $naam;

    function getKlant_id() {
        return $this->klant_id;
    }

    function getNaam() {
        return $this->naam;
    }

    function setKlant_id($klant_id) {
        $this->klant_id = $klant_id;
    }

    function setNaam($naam) {
        $this->naam = $naam;
    }

}
