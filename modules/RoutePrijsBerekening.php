<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace modules;

use model\Tarief;
use model\Koerier;

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
        foreach ($koeriersMetTarieven as $koerierMetTarief) {
            if ($koerierMetTarief->getIsFietsKoerier()) {
                $berekendTarief = $koerierMetTarief->berekenTarief($aantalKilometersPerFiets);
            } else {
                $berekendTarief = $koerierMetTarief->berekenTarief($aantalKilometersPerAuto);
            }
            if (0 === $laagsteTarief) {
                $laagsteTarief = $berekendTarief;
            }
            if ($laagsteTarief > $berekendTarief) {
                $laagsteTarief = $berekendTarief;
            }
        }
        return $laagsteTarief;
    }

    function berekenTariefVoorKlant($afstandNaarStation1PerAuto, $afstandNaarStation2PerAuto, $afstandDirectPerAuto, $afstandNaarStation1PerFiets, $afstandNaarStation2PerFiets, $afstandDirectPerFiets) {
        $prijsDirecteKoerier = $this->berekenGoedKoopsteRoute($afstandDirectPerAuto, $afstandDirectPerFiets);
        $prijsViaTreinReiziger = $this->berekenGoedKoopsteRoute($afstandNaarStation1PerAuto, $afstandNaarStation1PerFiets) + $this->berekenGoedKoopsteRoute($afstandNaarStation2PerAuto, $afstandNaarStation2PerFiets) + 3;
        if ($prijsViaTreinReiziger > $prijsDirecteKoerier) {
            return $prijsDirecteKoerier * 1.2;
        }
        return $prijsViaTreinReiziger * 1.2;
    }

}
