<?php

namespace model;

class Offerte extends Model {

    private $bedrag;

    function getBedrag() {
        return $this->bedrag;
    }

    function setBedrag($bedrag) {
        $this->bedrag = $bedrag;
    }

}
