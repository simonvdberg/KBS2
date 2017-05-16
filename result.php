<?php

include "autoload.php";

use modules\TreinReis;
use modules\KoerierReis;
use modules\RoutePrijsBerekening;

$treinReis = new TreinReis();
$koerierReis = new KoerierReis();

$afstandNaarStation1PerAuto = $treinReis->berekenAfstand($_POST['origin'], "driving");
$afstandNaarStation2PerAuto = $treinReis->berekenAfstand($_POST['destination'], "driving");
$afstandNaarStation1PerFiets = $treinReis->berekenAfstand($_POST['origin'], "bicycling");
$afstandNaarStation2PerFiets = $treinReis->berekenAfstand($_POST['destination'], "bicycling");
$afstandPerAutoDirect = $koerierReis->berekenAfstand($_POST['origin'], $_POST['destination'], "driving");
$afstandPerFietsDirect = $koerierReis->berekenAfstand($_POST['origin'], $_POST['destination'], "bicycling");
echo "Begin naar station per auto: " . $afstandNaarStation1PerAuto . "km<br>";
echo "Station naar eind per auto: " . $afstandNaarStation2PerAuto . "km<br>";
echo "Begin naar station per fiets: " . $afstandNaarStation1PerFiets . "km<br>";
echo "Station naar eind per fiets: " . $afstandNaarStation2PerFiets . "km<br>";
echo "Direct per auto: " . $afstandPerAutoDirect . "km<br>";
echo "Direct per fiets: " . $afstandPerFietsDirect . "km<br>";

$routePrijsBerekening = new RoutePrijsBerekening();
$goedkoopsteVanafBeginStation = $routePrijsBerekening->berekenGoedKoopsteRoute($afstandNaarStation1PerAuto, $afstandNaarStation1PerFiets);
echo "Prijs naar beginstation: " . $routePrijsBerekening->berekenGoedKoopsteRoute($afstandNaarStation1PerAuto, $afstandNaarStation1PerFiets) . " EU <br>";
echo "Prijs vanaf eindstation: " . $routePrijsBerekening->berekenGoedKoopsteRoute($afstandNaarStation2PerAuto, $afstandNaarStation2PerFiets) . " EU <br>";
echo "Prijs voor directe rit per koerier:  " . $routePrijsBerekening->berekenGoedKoopsteRoute($afstandPerAutoDirect, $afstandPerFietsDirect) . " EU <br>";
echo "Prijs voor klant voor de rit " . $routePrijsBerekening->berekenTariefVoorKlant($afstandNaarStation1PerAuto, $afstandNaarStation2PerAuto, $afstandPerAutoDirect, $afstandNaarStation1PerFiets, $afstandNaarStation2PerFiets, $afstandPerFietsDirect) . " EU <br>";
exit();
?>  