<?php
namespace modules\Google;

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
    
}
