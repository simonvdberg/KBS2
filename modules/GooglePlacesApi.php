<?php
namespace modules;

//require_once('GoogleApi.php');
/**
 * Description of GooglePlacesApi
 *
 * @author Jonas
 */
class GooglePlacesApi extends GoogleApi{
//      
    protected $key = "AIzaSyBKshTm5CljE_rrTtiUn-QzQ_VayCsVqH0";

    protected function getString() {
        return 'https://maps.googleapis.com/maps/api/place/nearbysearch/json' . $this->getQueryFromParams();
    }
    
    public function getNearestStation($location){
        $this->addParam("location", $location);
        $this->addParam("radius", "2500"); //kijken vanaf waar kijken voor een station geen zin heeft
        $this->addParam("types", "train_station");
        $res = json_decode($this->doRequest());
        return $res->results[0]->geometry->location;
    }
}
