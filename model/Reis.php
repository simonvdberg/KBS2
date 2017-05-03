<?php

namespace model;

class Reis extends Model {

    private $startstation;
    private $eindstation;

    function getStartstation() {
        return $this->startstation;
    }

    function getEindstation() {
        return $this->eindstation;
    }

    function setStartstation($startstation) {
        $this->startstation = $startstation;
    }

    function setEindstation($eindstation) {
        $this->eindstation = $eindstation;
    }

}
