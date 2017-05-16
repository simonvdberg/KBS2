<?php

namespace model;

class Offerte extends Model {

    protected $bedrag;

    public function __construct() {
        parent::__construct();
    }
    
    function getBedrag() {
        return $this->bedrag;
    }

    function setBedrag($bedrag) {
        $this->bedrag = $bedrag;
    }

}
