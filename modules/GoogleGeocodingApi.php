<?php

namespace modules;

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
        $res = $this->doRequest();
        return json_decode($res)->results[0]->geometry->location;
    }

}
