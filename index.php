<?php
require("autoload.php");
?>
<html>
    <form action="result.php" method="post">
        Vertrekpunt: <input name="origin" /><br />
        Eindpunt: <input name="destination" /><br />
        <input type="submit" value="verzend" />
    </form>
</html>

<?php

use model\Model;
use model\Koerier;
use model\Tarief;

$servername = "localhost";
$username = "root";
// Create connection
// Port configuratie nodig vanwege gebruik van 2 MySQL clients
$mysqli = mysqli_connect($servername, $username, null, "tzt", 3307);

// Check connection
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

if ($result=mysqli_query($mysqli,"select * from koerier"))
  {
  // Fetch one and one row
  while ($row=mysqli_fetch_row($result))
    {
    printf ("%s (%s)\n",$row[0],$row[1]);
    }
  // Free result set
  mysqli_free_result($result);
}

mysqli_close($mysqli);

$fietsKoerier = new Koerier("Fietskoerier", array(
    new Tarief(9, 0, 4),
    new Tarief(14, 0, 8),
    new Tarief(19, 0, 12),
    new Tarief(15, 0.56, 0)));

$fietsKoerier->berekenTarief(4);
