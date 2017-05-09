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
    private $vastePrijs;
    private $kilometerTarief;
    private $maximumAantalKilomets;
    
    function __construct($vastePrijs, $kilometerTarief, $maximumAantalKilomets) {
        $this->vastePrijs = $vastePrijs;
        $this->kilometerTarief = $kilometerTarief;
        $this->maximumAantalKilomets = $maximumAantalKilomets;
    }
    
    function getVastePrijs() {
        return $this->vastePrijs;
    }

    function getKilometerTarief() {
        return $this->kilometerTarief;
    }

    function getMaximumAantalKilomets() {
        return $this->maximumAantalKilomets;
    }

    function setVastePrijs($vastePrijs) {
        $this->vastePrijs = $vastePrijs;
    }

    function setKilometerTarief($kilometerTarief) {
        $this->kilometerTarief = $kilometerTarief;
    }

    function setMaximumAantalKilomets($maximumAantalKilomets) {
        $this->maximumAantalKilomets = $maximumAantalKilomets;
    }
}
