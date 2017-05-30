<?php

namespace model;

use model\Model;

class Pakket extends Model {

    protected $pakket_id;
    protected $lengte;
    protected $breedte;
    protected $hoogte;
    protected $gewicht;

    public function __construct() {
        $this->pk = "pakket_id";
        parent::__construct();
    }

    function getPakket_id() {
        return $this->pakket_id;
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

    function setPakket_id($pakket_id) {
        $this->pakket_id = $pakket_id;
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
    
    
}
