<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace modules;

use model\Tarief;
use model\Koerier;
use modules\TreinReis;
use modules\KoerierReis;

/**
 * Description of RoutePrijsBerekening
 *
 * @author svdberg
 */
class RoutePrijsBerekening {

    function berekenGoedKoopsteRoute($aantalKilometersPerAuto, $aantalKilometersPerFiets) {
        $db = DBManager::getInstance();
        $koeriers = $db->selectQuery("SELECT * FROM Koerier");
        $koeriersMetTarieven = array();
        foreach ($koeriers as $koerier) {
            $tarievenResult = $db->selectQuery("SELECT * FROM Tarief WHERE koerier_id=" . $db->escape_string($koerier["koerier_id"]));
            foreach ($tarievenResult as $tarief) {
                $tarieven[] = new Tarief($tarief["vastePrijs"], $tarief["kilometerTarief"], $tarief["maximumAantalKilometers"]);
            }
            $koerierObj = new Koerier($koerier["naam"], $tarieven, $koerier["isFietsKoerier"]);
            $koerierObj->setKoerier_id($koerier['koerier_id']);
            $koeriersMetTarieven[] = $koerierObj;
            $tarieven = array();
        }
        $laagsteTarief = 0;
        $koerier_id = null;
        foreach ($koeriersMetTarieven as $koerierMetTarief) {
            //hack om treinkoerier over te slaan
            if($koerierMetTarief->getKoerier_id() == 4){
                continue;
            }
            if ($koerierMetTarief->getIsFietsKoerier()) {
                $newArr['koerier'] = "Fiets";
                $berekendTarief = $koerierMetTarief->berekenTarief($aantalKilometersPerFiets);
            } else {
                $newArr['koerier'] = "Auto";
                $berekendTarief = $koerierMetTarief->berekenTarief($aantalKilometersPerAuto);
            }
            $newArr['prijs'] = $berekendTarief;
            if (0 === $laagsteTarief) {
                $laagsteTarief = $berekendTarief;
                $koerier_id = $koerierMetTarief->getKoerier_id();
            }
            if ($laagsteTarief > $berekendTarief) {
                $laagsteTarief = $berekendTarief;
                $koerier_id = $koerierMetTarief->getKoerier_id();
            }
            $koerierGegevens[] = $newArr;
        }
        $retVal = array(
            "tarief" => $laagsteTarief,
            "koerier_id" => $koerier_id,
            "prijzen" => $koerierGegevens
        );
        return $retVal;
    }

    function berekenTariefVoorKlant($afstandNaarStation1PerAuto, $afstandNaarStation2PerAuto, $afstandDirectPerAuto, $afstandNaarStation1PerFiets, $afstandNaarStation2PerFiets, $afstandDirectPerFiets) {
        $prijsDirecteKoerier = $this->berekenGoedKoopsteRoute($afstandDirectPerAuto, $afstandDirectPerFiets);
        $prijsViaTreinReiziger = $this->berekenGoedKoopsteRoute($afstandNaarStation1PerAuto, $afstandNaarStation1PerFiets) + $this->berekenGoedKoopsteRoute($afstandNaarStation2PerAuto, $afstandNaarStation2PerFiets) + 3;
        if ($prijsViaTreinReiziger > $prijsDirecteKoerier) {
            return $prijsDirecteKoerier * 1.2;
        }
        return $prijsViaTreinReiziger * 1.2;
    }

    public function ajaxCall() {
        if (isset($_POST['verzendAdres']) && isset($_POST['ontvangAdres'])) {
            $treinReis = new TreinReis();
            $koerierReis = new KoerierReis();
            $verzendAdres = $_POST['verzendAdres'];
            $ontvangAdres = $_POST['ontvangAdres'];
            $gegevensNaarStation1PerAuto = $treinReis->berekenAfstand($verzendAdres, "driving");
            $gegevensNaarStation2PerAuto = $treinReis->berekenAfstand($ontvangAdres, "driving");
            $gegevensNaarStation1PerFiets = $treinReis->berekenAfstand($verzendAdres, "bicycling");
            $gegevensNaarStation2PerFiets = $treinReis->berekenAfstand($ontvangAdres, "bicycling");
            $afstandNaarStation1PerAuto = $gegevensNaarStation1PerAuto['distance'];
            $afstandNaarStation2PerAuto = $gegevensNaarStation2PerAuto['distance'];
            $afstandNaarStation1PerFiets = $gegevensNaarStation1PerFiets['distance'];
            $afstandNaarStation2PerFiets = $gegevensNaarStation2PerFiets['distance'];
            $afstandPerAutoDirect = $koerierReis->berekenAfstand($verzendAdres, $ontvangAdres, "driving");
            $afstandPerFietsDirect = $koerierReis->berekenAfstand($verzendAdres, $ontvangAdres, "bicycling");

            //bij akkoord route opslaan
            $routePrijsBerekening = new RoutePrijsBerekening();
            $goedkoopsteVanafBeginStation = $routePrijsBerekening->berekenGoedKoopsteRoute($afstandNaarStation1PerAuto, $afstandNaarStation1PerFiets);
            $goedkoopsteVanafEindStation = $routePrijsBerekening->berekenGoedKoopsteRoute($afstandNaarStation2PerAuto, $afstandNaarStation2PerFiets);
            $goedkoopsteDirecteRit = $routePrijsBerekening->berekenGoedKoopsteRoute($afstandPerAutoDirect, $afstandPerFietsDirect);

            $prijzen1 = "Fiets: " . $goedkoopsteVanafBeginStation['prijzen'][0]['prijs'] . "<br>"
                    . "Bode koeriers: " . $goedkoopsteVanafBeginStation['prijzen'][1]['prijs'] . "<br>"
                    . "Pietersen: " . $goedkoopsteVanafBeginStation['prijzen'][2]['prijs'] . "<br>";
            
            $prijzen2 = "Fiets: " . $goedkoopsteVanafEindStation['prijzen'][0]['prijs'] . "<br>"
                    . "Bode koeriers: " . $goedkoopsteVanafEindStation['prijzen'][1]['prijs'] . "<br>"
                    . "Pietersen: " . $goedkoopsteVanafEindStation['prijzen'][2]['prijs'] . "<br>";
            
            $prijzen3 = "Fiets: " . $goedkoopsteDirecteRit['prijzen'][0]['prijs'] . "<br>"
                    . "Bode koeriers: " . $goedkoopsteDirecteRit['prijzen'][1]['prijs'] . "<br>"
                    . "Pietersen: " . $goedkoopsteDirecteRit['prijzen'][2]['prijs'] . "<br>";
            
            $debug = "Beginplaats: " . $verzendAdres . "<br>Station 1: " . $gegevensNaarStation1PerAuto['stationAdres'] . "<br> Station 2: " . $gegevensNaarStation2PerAuto['stationAdres'] . " <br>
                    Eindplaats: " . $ontvangAdres . "
                      <br>Rit: Beginplaats naar station<br> Afstand: " . $gegevensNaarStation1PerAuto['distance'] . " KM <br> Prijzen: <br>" . $prijzen1 . "<br><br>" . "Rit: Station naar eindplaats<br>
                    Afstand: " . $gegevensNaarStation2PerAuto['distance'] . " KM<br> Afstand: " . $afstandPerAutoDirect . "<br> Prijzen: <br>" . $prijzen2 . "<br><br>
                    Directe rit: " . $afstandPerAutoDirect . "<br>Prijzen: <br>" . $prijzen3;
//            var_dump($debug);
//            var_dump($goedkoopsteVanafBeginStation);
//            var_dump($goedkoopsteVanafEindStation);
//            var_dump($goedkoopsteDirecteRit);
//            exit();

            $prijsTrein = $goedkoopsteVanafBeginStation['tarief'] + 3 + $goedkoopsteVanafEindStation['tarief'];
            if ($prijsTrein < $goedkoopsteDirecteRit) {
                $debug .= "<br><br> Totale prijs: " . $prijsTrein * 1.2 * 1.21;
                $koerierArr = array(
                    $goedkoopsteVanafBeginStation['koerier_id'],
                    $goedkoopsteVanafEindStation['koerier_id'],
                    $debug
                );
                echo json_encode(array(
                    "trein",
                    $prijsTrein,
                    $koerierArr,
                    $gegevensNaarStation1PerAuto['stationAdres'],
                    $gegevensNaarStation2PerAuto['stationAdres'],
                    $debug
                ));
            } else {
                $debug .= "<br><br> Totale prijs: " . $goedkoopsteDirecteRit * 1.2 * 1.21;
                echo json_encode(array(
                    "koerier",
                    $koerierArr,
                    $goedkoopsteDirecteRit['tarief'],
                    $goedkoopsteDirecteRit['koerier_id'],
                    $debug
                ));
            }
            exit();
        }
    }
}
