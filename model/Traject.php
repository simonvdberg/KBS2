<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of Traject
 *
 * @author Jonas
 */
class Traject extends Model {

    protected $traject_id;
    protected $koerier_id;
    protected $startpunt;
    protected $eindpunt;
    protected $vergoeding;

    public function __construct() {
        $this->pk = "traject_id";
        parent::__construct();
    }

    function getTraject_id() {
        return $this->traject_id;
    }

    function getKoerier_id() {
        return $this->koerier_id;
    }

    function getStartpunt() {
        return $this->startpunt;
    }

    function getEindpunt() {
        return $this->eindpunt;
    }

    function getVergoeding() {
        return $this->vergoeding;
    }

    function setTraject_id($traject_id) {
        $this->traject_id = $traject_id;
    }

    function setKoerier_id($koerier_id) {
        $this->koerier_id = $koerier_id;
    }

    function setStartpunt($startpunt) {
        $this->startpunt = $startpunt;
    }

    function setEindpunt($eindpunt) {
        $this->eindpunt = $eindpunt;
    }

    function setVergoeding($vergoeding) {
        $this->vergoeding = $vergoeding;
    }

    function maakTrajectDeel($opdracht_id) {
        $query = "INSERT INTO TrajectDelen VALUES('" . $opdracht_id . "', '" . $this->getTraject_id() . "')";
        $this->db->insertQuery($query);
    }

}
