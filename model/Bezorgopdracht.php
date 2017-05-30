<?php

namespace model;

class Bezorgopdracht extends Model{

    protected $opdracht_id;
    protected $klant_id;
    protected $pakket_id;
    protected $startpunt;
    protected $eindpunt;

    public function __construct() {
        $this->pk = "opdracht_id";
        parent::__construct();
    }

    function getOpdracht_id() {
        return $this->opdracht_id;
    }

    function getKlant_id() {
        return $this->klant_id;
    }

    function getPakket_id() {
        return $this->pakket_id;
    }

    function getStartpunt() {
        return $this->startpunt;
    }

    function getEindpunt() {
        return $this->eindpunt;
    }

    function setOpdracht_id($opdracht_id) {
        $this->opdracht_id = $opdracht_id;
    }

    function setKlant_id($klant_id) {
        $this->klant_id = $klant_id;
    }

    function setPakket_id($pakket_id) {
        $this->pakket_id = $pakket_id;
    }

        
    function setStartpunt($startpunt) {
        $this->startpunt = $startpunt;
    }

    function setEindpunt($eindpunt) {
        $this->eindpunt = $eindpunt;
    }

}
