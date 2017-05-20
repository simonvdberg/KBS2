<?php

namespace modules\Google;

use Exception;

/**
 * Description of GoogleGeocodingApi
 *
 * @author Jonas
 */
class GoogleGeocodingApi extends GoogleApi {

    protected $key = 'AIzaSyCYOwIka_gvwP9bvsnTfoFhOUNCgPe9P00';

    protected function getString() {
        return 'https://maps.googleapis.com/maps/api/geocode/json' .  $this->getQueryFromParams();
    }

    public function getCoordsFromAdress($adress) {
        $this->addParam("address", str_replace(' ', '', $adress));
        $res = json_decode($this->doRequest());
        $location = $res->results[0]->geometry->location;
        if($location === null){
            throw new Exception("No location found for adress " . $adress);
        }
        return $location;
    }

}
