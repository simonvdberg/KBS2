<?php
include "modules/GoogleApi.php";
include("modules/GooglePlacesApi.php");
include("modules/GoogleDistanceApi.php");
include("modules/GoogleGeocodingApi.php");

$distanceMatrix = new \modules\GoogleDistanceApi();
$afstandNaarStation1 = $distanceMatrix->getDistanceToStation($_POST['origin']);
$afstandNaarStation2 = $distanceMatrix->getDistanceToStation($_POST['destination']);
$afstandPerBus = $distanceMatrix->getDistanceBetweenTwoPoints($_POST['origin'], $_POST['destination']);
echo "Begin naar station: " . $afstandNaarStation1 . "m<br>";
echo "Station naar eind: " . $afstandNaarStation2 . "m<br>";
echo "Direct: " . $afstandPerBus . "m";
exit();
$api_key = "";
?> 