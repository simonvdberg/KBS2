<?php

namespace modules;

/**
 * Description of googleApi
 *
 * @author Jonas
 */
class GoogleDistanceApi extends GoogleApi {

    protected $key = "AIzaSyAjs5_pXtQ4GXYoEiFfUnPePHjCfaiQr9g";

    protected function getString() {
        return 'https://maps.googleapis.com/maps/api/distancematrix/json' . $this->getQueryFromParams();
    }

    public function getDistanceToStation($origin) {
        $geoCoding = new \modules\GoogleGeocodingApi();
        //punten om zetten naar coordinaten
        $coordsBegin = $geoCoding->getCoordsFromAdress($origin);

        $google = new \modules\GooglePlacesApi();
        $coordsStation = $google->getNearestStation($coordsBegin->lat . "," . $coordsBegin->lng);

        $distanceMatrix = new \modules\GoogleDistanceApi();
        $distanceMatrix->addParam("origins", $coordsBegin->lat . "," . $coordsBegin->lng);
        $distanceMatrix->addParam("destinations", $coordsStation->lat . "," . $coordsStation->lng);
        $distanceMatrix->addParam("units", "metrics");
        $distanceMatrix->addParam("mode", "bicycling");
        $res = json_decode($distanceMatrix->doRequest());
        return $res->rows[0]->elements[0]->distance->value;
    }

    public function getDistanceBetweenTwoPoints($origin, $destination){
        $distanceMatrix = new \modules\GoogleDistanceApi();
        $distanceMatrix->addParam("origins", $origin);
        $distanceMatrix->addParam("destinations", $destination);
        $distanceMatrix->addParam("units", "metrics");
        $res = json_decode($distanceMatrix->doRequest());
//        var_dump($distanceMatrix->doRequest());
        return $res->rows[0]->elements[0]->distance->value;
    }
    
}
