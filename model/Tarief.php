<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of Tarief
 *
 * @author svdberg
 */
class Tarief extends Model {
    //put your code here
    protected $vastePrijs;
    protected $kilometerTarief;
    protected $maximumAantalKilometers;
    
    
    function __construct($vastePrijs, $kilometerTarief, $maximumAantalKilometers) {
        $this->vastePrijs = $vastePrijs;
        $this->kilometerTarief = $kilometerTarief;
        $this->maximumAantalKilometers = $maximumAantalKilometers;
        parent::__construct();
    }
    
    function getVastePrijs() {
        return $this->vastePrijs;
    }

    function getKilometerTarief() {
        return $this->kilometerTarief;
    }

    function getMaximumAantalKilometers() {
        return $this->maximumAantalKilometers;
    }

    function setVastePrijs($vastePrijs) {
        $this->vastePrijs = $vastePrijs;
    }

    function setKilometerTarief($kilometerTarief) {
        $this->kilometerTarief = $kilometerTarief;
    }

    function setMaximumAantalKilometers($maximumAantalKilometers) {
        $this->maximumAantalKilometers = $maximumAantalKilometers;
    }
}
