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
        $placesApi->addParam("radius", "2500"); //kijken vanaf waar kijken voor een station geen zin heeft
        $placesApi->addParam("types", "train_station");
        $res = json_decode($placesApi->doRequest());
        return $res->results[0]->geometry->location;
    }

    private function getDistanceToStation($origin) {
        $geoCoding = new GoogleGeocodingApi();
        //punten om zetten naar coordinaten
        $coordsBegin = $geoCoding->getCoordsFromAdress($origin);

        $placesApi = new GooglePlacesApi();
        $coordsStation = $placesApi->getNearestStation($coordsBegin->lat . "," . $coordsBegin->lng);

        $distanceMatrix = new GoogleDistanceApi();
        $distanceMatrix->addParam("origins", $coordsBegin->lat . "," . $coordsBegin->lng);
        $distanceMatrix->addParam("destinations", $coordsStation->lat . "," . $coordsStation->lng);
        $distanceMatrix->addParam("units", "metrics");
        $distanceMatrix->addParam("mode", "bicycling");
        $res = json_decode($distanceMatrix->doRequest());
        //autowaarde berekenen
        return $res->rows[0]->elements[0]->distance->value;
    }

    public function berekenAfstand($location){
        return $this->getDistanceToStation($location)/1000;
    }
    
}
