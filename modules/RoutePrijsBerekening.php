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

    function berekenGoedKoopsteRoute($aantalKilometers) {
        $db = DBManager::getInstance();
        $koeriers = $db->selectQuery("SELECT * FROM Koerier");
        foreach ($koeriers as $koerier) {
            $tarievenResult = $db->selectQuery("SELECT * FROM Tarief WHERE koerier_id=" . $db->escape_string($koerier["koerier_id"]));
            foreach ($tarievenResult as $tarief) {
                $tarieven[] = new Tarief($tarief["vastePrijs"], $tarief["kilometerTarief"], $tarief["maximumAantalKilometers"]);
            }
            $koeriersMetTarieven[] = new Koerier($koerier["naam"], $tarieven);
            $tarieven = array();
        }
        $laagsteTarief = 0;
        foreach ($koeriersMetTarieven as $koerierMetTarief) {
            $berekendTarief = $koerierMetTarief->berekenTarief($aantalKilometers);
            if (0 === $laagsteTarief) {
                $laagsteTarief = $berekendTarief;
            }
            if ($laagsteTarief > $berekendTarief) {
                $laagsteTarief = $berekendTarief;
            }
        }
        return $laagsteTarief;
    }

    function berekenTariefVoorKlant($afstandNaarStation1, $afstandNaarStation2, $afstandPerBus) {
        $prijsDirecteKoerier = $this->berekenGoedKoopsteRoute($afstandPerBus);
        $prijsViaTreinReiziger = $this->berekenGoedKoopsteRoute($afstandNaarStation1) + $this->berekenGoedKoopsteRoute($afstandNaarStation2) + 3;
        if ($prijsViaTreinReiziger > $prijsDirecteKoerier) {
            return $prijsDirecteKoerier * 1.2;
        }
        return $prijsViaTreinReiziger * 1.2;
    }

}
