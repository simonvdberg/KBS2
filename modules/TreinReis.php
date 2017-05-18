<?php

namespace modules;

use modules\Google\GooglePlacesApi;
use modules\Google\GoogleGeocodingApi;
use modules\Google\GoogleDistanceApi;

/**
 * Description of Treinreis
 *
 * @author Jonas
 */
class TreinReis {

    private function getNearestStation($location) {
        $placesApi = new GooglePlacesApi();
        $placesApi->addParam("location", $location);
        $placesApi->addParam("rankby", "distance");
//        $placesApi->addParam("radius", "50000"); //kijken vanaf waar kijken voor een station geen zin heeft
        $placesApi->addParam("type", "train_station");
        $res = json_decode($placesApi->doRequest());
        $resLocation = $res->results[0]->geometry->location;
        var_dump($res);
        exit();
        return $resLocation;
    }

    private function getDistanceToStation($origin, $mode="default") {
        $geoCoding = new GoogleGeocodingApi();
        //punten om zetten naar coordinaten
        $coordsBegin = $geoCoding->getCoordsFromAdress($origin);

        $coordsStation = $this->getNearestStation($coordsBegin->lat . "," . $coordsBegin->lng);

        $distanceMatrix = new GoogleDistanceApi();
        $distanceMatrix->addParam("origins", $coordsBegin->lat . "," . $coordsBegin->lng);
        $distanceMatrix->addParam("destinations", $coordsStation->lat . "," . $coordsStation->lng);
        $distanceMatrix->addParam("units", "metrics");
        $distanceMatrix->addParam("mode", $mode);
        $res = json_decode($distanceMatrix->doRequest());
        //autowaarde berekenen
        return $res->rows[0]->elements[0]->distance->value;
    }

    public function berekenAfstand($location){
        return $this->getDistanceToStation($location)/1000;
    }
    
}
