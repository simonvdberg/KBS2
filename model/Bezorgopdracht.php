<?php

namespace model;

class Bezorgopdracht {

    private $startpunt;
    private $eindpunt;

    function getStartpunt() {
        return $this->startpunt;
    }

    function getEindpunt() {
        return $this->eindpunt;
    }

    function setStartpunt($startpunt) {
        $this->startpunt = $startpunt;
    }

    function setEindpunt($eindpunt) {
        $this->eindpunt = $eindpunt;
    }

}
