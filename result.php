<?php

use modules\TreinReis;
use modules\KoerierReis;

$treinReis = new TreinReis();
$koerierReis = new KoerierReis();

$afstandNaarStation1 = $treinReis->getDistanceToStation($_POST['origin']);
$afstandNaarStation2 = $treinReis->getDistanceToStation($_POST['destination']);
$afstandPerBus = $koerierReis->berekenAfstand($_POST['origin'], $_POST['destination']);
echo "Begin naar station: " . $afstandNaarStation1 . "m<br>";
echo "Station naar eind: " . $afstandNaarStation2 . "m<br>";
echo "Direct: " . $afstandPerBus . "m";
exit();
$api_key = "";
?> 