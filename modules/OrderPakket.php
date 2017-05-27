<?php

namespace modules;

use model\Pakket;

class OrderPakket {

    private $verzendAdres;
    private $ontvangAdres;
    private $pakketLengte;
    private $pakketBreedte;
    private $pakketHoogte;
    private $pakketGewicht;
    private $email;
    private $naam;
    private $telNr;

    public function verwerkAanvraag() {
        if (isset($_POST) && $this->controleerAanvraag($_POST)) {
            $pakket = new Pakket();
            $pakket->setBreedte($this->pakketBreedte);
            $pakket->setHoogte($this->pakketHoogte);
            $pakket->setLengte($this->pakketLengte);
            $pakket->setGewicht($this->pakketGewicht);
            $pakket->saveToDatabase();
        } else{
            exit("FOUT");
        }
    }

    protected function controleerAanvraag($gegevens) {

        //beginadres
        if (!empty($gegevens['resultaatOphaalAdres'])) {
            $this->verzendAdres = $gegevens['resultaatOphaalAdres'];
        } else {
            return false;
        }

        //eindadres
        if (!empty($gegevens['resultaatAfleverAdres'])) {
            $this->ontvangAdres = $gegevens['resultaatAfleverAdres'];
        } else {
            return false;
        }

        //pakketgrootte
        if (!empty($gegevens['pakketLengte']) && $gegevens['pakketLengte'] > 0 && $gegevens['pakketLengte'] <= 50) {
            $this->pakketLengte = $gegevens['pakketLengte'];
        } else {
            return false;
        }
        if (!empty($gegevens['pakketBreedte']) && $gegevens['pakketBreedte'] > 0 && $gegevens['pakketBreedte'] <= 50) {
            $this->pakketBreedte = $gegevens['pakketBreedte'];
        } else {
            return false;
        }
        if (!empty($gegevens['pakketHoogte']) && $gegevens['pakketHoogte'] > 0 && $gegevens['pakketHoogte'] <= 50) {
            $this->pakketHoogte = $gegevens['pakketHoogte'];
        } else {
            return false;
        }
        if (!empty($gegevens['pakketGewicht']) && $gegevens['pakketGewicht'] > 0 && $gegevens['pakketGewicht'] <= 10) {
            $this->pakketGewicht = $gegevens['pakketGewicht'];
        } else {
            return false;
        }

//    private $email;
//    private $naam;
//    private $telNr;
        //klantgegevens
        if (filter_var($gegevens['klantgegevensEmail'], FILTER_VALIDATE_EMAIL)) {
            $this->email = $gegevens['klantgegevensEmail'];
        } else {
            return false;
        }
        if (!empty($gegevens['klantgegevensNaam'])) {
            $this->naam = $gegevens['klantgegevensNaam'];
        } else {
            return false;
        }
        if (!empty($gegevens['klantgegevensTelNr'])) {
            $this->telNr = $gegevens['klantgegevensTelNr'];
        } else {
            return false;
        }
        return true;
    }

}
