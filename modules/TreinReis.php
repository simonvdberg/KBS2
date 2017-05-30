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
        $origRes = $res;
        if(count($res->results) > 1){
            $res = $this->getNearestFromResult($res->results, explode(",", $location));
        } else{
            $res = $res->result[0];
        }
        $location = $res->geometry->location;
        if($origRes->status == "INVALID_REQUEST" || null == $location){
            if($origRes->status == "ZERO_RRESULTS"){
                throw new Exception("ZERO RESULTS");
            }
            throw new Exception("INVALID_REQUEST or $apiResult is NULL");
        }
//        $name = $res->name . " station";
//        $apiResult = array(
//            "location" => $location,
//            "name" => $name
//        );
        return $location;
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
        var_dump($res);
        $apiResult = array(
            "stationAdres" => $res->destination_adresses[0],
            'distance' => $res->rows[0]->elements[0]->distance->value/1000
        );
        return $apiResult;
    }

    public function berekenAfstand($location, $mode){
        return $this->getDistanceToStation($location, $mode);
    }
    
    private function getNearestFromResult($res, $orig){
        $arr = array();
        $i = 0;
        foreach($res as $result){
            $lat = $result->geometry->location->lat;
            $lng = $result->geometry->location->lng;
            //Stelling van pytagoras
            $afstand = sqrt(pow(abs($lng) - abs($orig[1]), 2) + pow(abs($lat) - abs($orig[0]), 2));
            $arr[$i] = $afstand;
            $i++;
        }
        $antwoord = array_keys($arr, min($arr))[0];
        return $res[$antwoord];
    }
}
