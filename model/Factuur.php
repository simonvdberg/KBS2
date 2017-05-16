<?php

namespace model;

/**
 * Description of Factuur
 *
 * @author Jonas
 */
class Factuur extends Model {

    protected $betaald;
    protected $datum;

    public function __construct() {
        parent::__construct();
    }

    function getBetaald() {
        return $this->betaald;
    }

    function getDatum() {
        return $this->datum;
    }

    function setBetaald($betaald) {
        $this->betaald = $betaald;
    }

    function setDatum($datum) {
        $this->datum = $datum;
    }

}
