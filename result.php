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

$afstandNaarStation1 = $treinReis->berekenAfstand($_POST['origin']);
$afstandNaarStation2 = $treinReis->berekenAfstand($_POST['destination']);
$afstandPerBus = $koerierReis->berekenAfstand($_POST['origin'], $_POST['destination'], "driving");
$afstandPerFiets = $koerierReis->berekenAfstand($_POST['origin'], $_POST['destination'], "bycicling");
echo "Begin naar station: " . $afstandNaarStation1 . "km<br>";
echo "Station naar eind: " . $afstandNaarStation2 . "km<br>";

echo "Direct per bus: " . $afstandPerBus . "km<br>";
echo "Direct per fiets: " . $afstandPerFiets . "km<br>";

$routePrijsBerekening = new RoutePrijsBerekening();
echo "Prijs naar beginstation: " . $routePrijsBerekening->berekenGoedKoopsteRoute($afstandNaarStation1) . " EU <br>";
echo "Prijs vanaf eindstation: " . $routePrijsBerekening->berekenGoedKoopsteRoute($afstandNaarStation2) . " EU <br>";
echo "Prijs voor directe rit per koerier:  " . $routePrijsBerekening->berekenGoedKoopsteRoute($afstandPerBus) . " EU <br>";
echo "Prijs voor klant voor de rit " . $routePrijsBerekening->berekenTariefVoorKlant($afstandNaarStation1, $afstandNaarStation2, $afstandPerBus) . " EU <br>";
exit();
?>  