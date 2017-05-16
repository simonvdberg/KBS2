<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace modules;

use modules\Google\GoogleDistanceApi;

/**
 * Description of Koerier
 *
 * @author Jonas
 */
class KoerierReis {
    
    private function getDistanceBetweenTwoPoints($origin, $destination, $mode="default"){
        $distanceMatrix = new GoogleDistanceApi();
        $distanceMatrix->addParam("origins", $origin);
        $distanceMatrix->addParam("destinations", $destination);
        $distanceMatrix->addParam("units", "metrics");
        $distanceMatrix->addParam("mode", $mode);
        $res = json_decode($distanceMatrix->doRequest());
        return $res->rows[0]->elements[0]->distance->value;
    }
    
    public function berekenAfstand($begin, $eind){
        return $this->getDistanceBetweenTwoPoints($begin, $eind)/1000;
    }
}
