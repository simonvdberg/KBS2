<?php

namespace modules;

class PostcodeApi {

    private function makeCall($postcode, $huisnummer) {
        // De headers worden altijd meegestuurd als array
        $headers = array();
        $headers[] = 'X-Api-Key: YYuy7Fo8oP5Gt0DtW1JhL3ZoE0sRecrb7ERLoVQc';

// De URL naar de API call
        $url = 'https://postcode-api.apiwise.nl/v2/addresses/?postcode=' . $postcode . '&number=' . $huisnummer;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

// Indien de server geen TLS ondersteunt kun je met 
// onderstaande optie een onveilige verbinding forceren.
// Meestal is dit probleem te herkennen aan een lege response.
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
// De ruwe JSON response
        $response = curl_exec($curl);

// Gebruik json_decode() om de response naar een PHP array te converteren
        $data = json_decode($response);
        curl_close($curl);
        return $data;
    }

    public function zoekAdres() {
        if (isset($_POST['postcode']) && isset($_POST['huisnummer'])) {
            $data = $this->makeCall($_POST['postcode'], $_POST['huisnummer']);
            if(isset($data->_embedded->addresses[0])) {
                $retVal = array(
                    'plaats' => $data->_embedded->addresses[0]->city->label,
                    'straat' => $data->_embedded->addresses[0]->street
                );
                echo json_encode($retVal);
            } else{
                echo json_encode(array(
                    'plaats' => "leeg",
                    'straat' => "leeg"
                ));
            }
            exit();
        }
    }

}
