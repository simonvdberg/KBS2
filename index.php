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
    include "model/Koerier.php";
    include "model/Tarief.php";
    
    $fietsKoerier = new model/Koerier("Fietskoerier",  array(
        new model/Tarief(9, 0, 4),
        new model/Tarief(14, 0, 8),
        new model/Tarief(19, 0, 12),
        new model/Tarief(15, 0.56, 12),
        ) );
    $fietsKoerier->berekenTarief();
