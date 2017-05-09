<?php

include "autoload.php";

use modules\TreinReis;
use modules\KoerierReis;

$treinReis = new TreinReis();
$koerierReis = new KoerierReis();

$afstandNaarStation1 = $treinReis->berekenAfstand($_POST['origin']);
$afstandNaarStation2 = $treinReis->berekenAfstand($_POST['destination']);
$afstandPerBus = $koerierReis->berekenAfstand($_POST['origin'], $_POST['destination']);
echo "Begin naar station: " . $afstandNaarStation1 . "km<br>";
echo "Station naar eind: " . $afstandNaarStation2 . "km<br>";
echo "Direct: " . $afstandPerBus . "km";
exit();
?> 