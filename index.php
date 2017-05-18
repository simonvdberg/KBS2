<?php
require("autoload.php");
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
?>
<html>
    <form action="result.php" method="post">
        Vertrekpunt: <input name="origin" /><br />
        Eindpunt: <input name="destination" /><br />
        <input type="submit" value="verzend" />
    </form>
</html>
