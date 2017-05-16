<?php

namespace model;

use model\Model;

class Pakket extends Model {

    protected $lengte;
    protected $breedte;
    protected $hoogte;
    protected $gewicht;
    protected $referentie;

    public function __construct() {
        parent::__construct();
    }
    
    function getLengte() {
        return $this->lengte;
    }

    function getBreedte() {
        return $this->breedte;
    }

    function getHoogte() {
        return $this->hoogte;
    }

    function getGewicht() {
        return $this->gewicht;
    }

    function getReferentie() {
        return $this->referentie;
    }

    function setLengte($lengte) {
        $this->lengte = $lengte;
    }

    function setBreedte($breedte) {
        $this->breedte = $breedte;
    }

    function setHoogte($hoogte) {
        $this->hoogte = $hoogte;
    }

    function setGewicht($gewicht) {
        $this->gewicht = $gewicht;
    }

    function setReferentie($referentie) {
        $this->referentie = $referentie;
    }

}
