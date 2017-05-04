<?php

namespace modules;

/**
 * Description of GoogleApi
 *
 * @author Jonas
 */
class GoogleApi {

    protected $params = array();
    protected $key;
    protected $lastResult;

    public function clearParams() {
        $this->params = array();
    }
    
    public function addParam($key, $value) {
        $this->params[urlencode($key)] = urlencode($value);
    }
    
    public function doRequest() {
        $defaults = array(
            CURLOPT_URL => $this->getString(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false
        );
        $ch = curl_init();
        curl_setopt_array($ch, $defaults);
        $res = curl_exec($ch);
        if (!$res) {
            var_dump(curl_errno($ch));
            var_dump(curl_error($ch));
        } else {
            $this->lastResult = $res;
        }
        curl_close($ch);
        return $this->lastResult;
    }
    
    protected function getQueryFromParams() {
        $query = "?";
        $count = count($this->params);
        $i = 0;
        foreach ($this->params as $key => $val) {
            $query .= $key . "=" . $val . "&";
        }
        $query .= "key=" . $this->key;
        return $query;
    }

}
