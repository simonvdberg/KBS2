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
        foreach ($koeriers as $koerier) {
            $tarievenResult = $db->selectQuery("SELECT * FROM Tarief WHERE koerier_id=" . $db->escape_string($koerier["koerier_id"]));
            foreach ($tarievenResult as $tarief) {
                $tarieven[] = new Tarief($tarief["vastePrijs"], $tarief["kilometerTarief"], $tarief["maximumAantalKilometers"]);
            }
            $koeriersMetTarieven[] = new Koerier($koerier["naam"], $tarieven, $koerier["isFietsKoerier"]);
            $tarieven = array();
        }
        $laagsteTarief = 0;
        $koerier_id = null;
        foreach ($koeriersMetTarieven as $koerierMetTarief) {
            if ($koerierMetTarief->getIsFietsKoerier()) {
                $berekendTarief = $koerierMetTarief->berekenTarief($aantalKilometersPerFiets);
            } else {
                $berekendTarief = $koerierMetTarief->berekenTarief($aantalKilometersPerAuto);
            }
            if (0 === $laagsteTarief) {
                $laagsteTarief = $berekendTarief;
                $koerier_id = $koerierMetTarief->getKoerier_id();
            }
            if ($laagsteTarief > $berekendTarief) {
                $laagsteTarief = $berekendTarief;
            }
        }
        $retVal = array(
            "tarief" => $laagsteTarief,
            "koerier_id" => $koerier_id
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

            
            $prijsTrein = $goedkoopsteVanafBeginStation + 3 + $goedkoopsteVanafEindStation;
            if ($prijsTrein < $goedkoopsteDirecteRit) {
                echo json_encode(array(
                    "trein",
                    $prijsTrein
                ));
            } else {
                echo json_encode(array(
                    "koerier",
                    $goedkoopsteDirecteRit
                ));
            }
            exit();
        }
    }

}
