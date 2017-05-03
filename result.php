<?php
include("modules/GoogleApi.php");

$google = new \modules\GoogleApi();

$google->addParam("units", "metrics");
$google->addParam("origins", urlencode($_POST['origin']));
$google->addParam("destinations", urlencode($_POST['destination']));

echo $google->doRequest();
exit();

$api_key = "";
?> 