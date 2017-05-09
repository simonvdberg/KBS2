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

$fietsKoerier = new Koerier("Fietskoerier", array(
    new Tarief(9, 0, 4),
    new Tarief(14, 0, 8),
    new Tarief(19, 0, 12),
    new Tarief(15, 0.56, 0)
        ));

echo $fietsKoerier->berekenTarief(4);
