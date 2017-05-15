<?php
require("autoload.php");

use model\Model;
use model\Koerier;
use model\Tarief;
use modules\DBManager;

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
$db = DBManager::getInstance();
$db->selectQuery('SELECT * FROM Klant');
?>
<html>
    <form action="result.php" method="post">
        Vertrekpunt: <input name="origin" /><br />
        Eindpunt: <input name="destination" /><br />
        <input type="submit" value="verzend" />
    </form>
</html>

<?php
$db->selectQuery("SELECT * FROM koerier");
$fietsKoerier = new Koerier("Fietskoerier", array(
    new Tarief(9, 0, 4),
    new Tarief(14, 0, 8),
    new Tarief(19, 0, 12),
    new Tarief(15, 0.56, 0)));

$fietsKoerier->berekenTarief(4);
