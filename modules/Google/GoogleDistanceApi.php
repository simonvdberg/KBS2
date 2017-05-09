<?php

namespace modules\Google;

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

}
