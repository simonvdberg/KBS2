<?php

include "autoload.php";

use modules\TreinReis;
use modules\KoerierReis;
use modules\RoutePrijsBerekening;

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
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
$goedkoopsteVanafEindStation = $routePrijsBerekening->berekenGoedKoopsteRoute($afstandNaarStation2PerAuto, $afstandNaarStation2PerFiets);
//Return deze waarde voor prijs als de directe rit goedkoper is
$goedkoopsteDirecteRit = $routePrijsBerekening->berekenGoedKoopsteRoute($afstandPerAutoDirect, $afstandPerFietsDirect);
echo "Prijs naar beginstation: " . $goedkoopsteVanafBeginStation . " EU <br>";
echo "Prijs vanaf eindstation: " . $goedkoopsteVanafEindStation . " EU <br>";
echo "Prijs voor directe rit per koerier:  " . $goedkoopsteDirecteRit . " EU <br>";
echo "Berekening goedkoopste route per treinreiziger: ( ". $goedkoopsteVanafBeginStation . " + " . $goedkoopsteVanafEindStation . " + 3 ) x 1,2 = " . ((3+$goedkoopsteVanafBeginStation+$goedkoopsteVanafEindStation)*1.2) . " EU <br>";
echo "Prijs voor klant voor de rit " . $routePrijsBerekening->berekenTariefVoorKlant($afstandNaarStation1PerAuto, $afstandNaarStation2PerAuto, $afstandPerAutoDirect, $afstandNaarStation1PerFiets, $afstandNaarStation2PerFiets, $afstandPerFietsDirect) . " EU <br>";
exit();
?>  
