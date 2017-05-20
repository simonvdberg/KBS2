<?php
require("autoload.php");
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require("router.php");
if (true) {
    ?>
    <!doctype html>
    <html>
        <head>
            <script src="templates/jquery.js"></script>
            <script src="templates/script.js"></script>
            <style>
                .pagina{
                    display: none;
                }
                #stap1{
                    display: block;
                }
            </style>
        </head>
        <body>
            <div class="pagina" id="stap1">
                <div id="verzendDiv">
                    Verzender:
                    <table>
                        <tr>
                            <td>
                                Postcode:
                            </td>
                            <td>
                                <input id="postcodeCijfersVerzender" type="number" size="4" />
                                <input id="postcodeLettersVerzender" type="text" size="2" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Huisnummer: 
                            </td>
                            <td>
                                <input id="huisnummerVerzender"  type="number" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Straat: 
                            </td>
                            <td>
                                <input id="straatVerzender" disabled />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Plaats: 
                            </td>
                            <td>
                                <input id="plaatsVerzender" disabled />
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="ontangDiv">
                    Ontvanger: 
                    <table>
                        <tr>
                            <td>
                                Postcode:
                            </td>
                            <td>
                                <input id="postcodeCijfersOntvanger" type="number" size="4" />
                                <input id="postcodeLettersOntvanger" type="text" size="2" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Huisnummer: 
                            </td>
                            <td>
                                <input id="huisnummerOntvanger"  type="number" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Straat: 
                            </td>
                            <td>
                                <input id="straatOntvanger" disabled />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Plaats: 
                            </td>
                            <td>
                                <input id="plaatsOntvanger" disabled />
                            </td>
                        </tr>
                    </table>
                </div>
                <a href="#" class="changeStep" data-stap="2">Volgende stap</a>
            </div>
            <div class="pagina" id="stap2">
                2
                <a href="#" class="changeStep" data-stap="3">Volgende stap</a>
            </div>
            <div class="pagina" id="stap3">
                3
                <a href="#" class="changeStep" data-stap="4">Volgende stap</a>
            </div>
            <div class="pagina" id="stap4">
                4
            </div>
        </body>
    </html>

    <?php
} else {
    ?>
    <html>
        <form action = "result.php" method = "post">
            Vertrekpunt: <input name = "origin" /><br />
            Eindpunt: <input name = "destination" /><br />
            <input type = "submit" value = "verzend" />
        </form>
    </html>

    <?php
}