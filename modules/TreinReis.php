<?php

namespace modules;

use modules\Google\GooglePlacesApi;
use modules\Google\GoogleGeocodingApi;
use modules\Google\GoogleDistanceApi;
use Exception;
/**
 * Description of Treinreis
 *
 * @author Jonas
 */
class TreinReis {

    private function getNearestStation($location) {
        $placesApi = new GooglePlacesApi();
        $placesApi->addParam("location", $location);
        //$placesApi->addParam("rankby", "distance");
        $placesApi->addParam("radius", "500000"); //kijken vanaf waar kijken voor een station geen zin heeft
        $placesApi->addParam("type", "train_station");
        $res = json_decode($placesApi->doRequest());
        $apiResult = $res->results[0]->geometry->location;
        if($res->status == "INVALID_REQUEST" || null == $apiResult){
            if($res->status == "ZERO_RRESULTS"){
                throw new Exception("ZERO RESULTS");
            }
            throw new Exception("INVALID_REQUEST or $apiResult is NULL");
        }
        return $apiResult;
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

    public function berekenAfstand($location, $mode){
        return $this->getDistanceToStation($location, $mode)/1000;
    }
    
}
