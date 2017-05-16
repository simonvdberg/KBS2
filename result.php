<?php

include "autoload.php";

use modules\TreinReis;
use modules\KoerierReis;
use modules\RoutePrijsBerekening;

$treinReis = new TreinReis();
$koerierReis = new KoerierReis();

$afstandNaarStation1 = $treinReis->berekenAfstand($_POST['origin']);
$afstandNaarStation2 = $treinReis->berekenAfstand($_POST['destination']);
$afstandPerBus = $koerierReis->berekenAfstand($_POST['origin'], $_POST['destination']);
echo "Begin naar station: " . $afstandNaarStation1 . "km<br>";
echo "Station naar eind: " . $afstandNaarStation2 . "km<br>";
echo "Direct: " . $afstandPerBus . "km<br>";

$routePrijsBerekening = new RoutePrijsBerekening();
echo "Prijs naar beginstation: " .$routePrijsBerekening->berekenGoedKoopsteRoute($afstandNaarStation1) . " EU <br>";
echo "Prijs vanaf eindstation: " .$routePrijsBerekening->berekenGoedKoopsteRoute($afstandNaarStation2) . " EU <br>";
echo "Prijs voor directe rit per koerier:  " .$routePrijsBerekening->berekenGoedKoopsteRoute($afstandPerBus) . " EU <br>";
exit();
?>  