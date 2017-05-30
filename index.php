<?php
session_start();
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
                #resultaat{
                    display: none;
                }
            </style>
        </head>
        <body>
            <form method="post" action="index.php/modules/OrderPakket/verwerkAanvraag">
                <div class="pagina" id="stap1">
                    <h1>
                        Stap 1: Waar mogen we uw pakketje ophalen en naartoe brengen?
                    </h1>
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
                                    <input id="postcodeCijfersOntvanger" type="text" size="4" />
                                    <input id="postcodeLettersOntvanger" type="text" size="2" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Huisnummer: 
                                </td>
                                <td>
                                    <input id="huisnummerOntvanger"  type="text" />
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
                    <h1>
                        Stap 2: Hoe ziet uw pakketje er vandaag uit?
                    </h1>
                    <table>
                        <tr>
                            <td>
                                Lengte:
                            </td>
                            <td>
                                <input type="number" name="pakketLengte" id="pakketLengte">
                                cm (max 50 cm)
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Breedte:
                            </td>
                            <td>
                                <input type="number" name="pakketBreedte" id="pakketBreedte">
                                cm (max 50 cm)
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Hoogte:
                            </td>
                            <td>
                                <input type="number" name="pakketHoogte" id="pakketHoogte">
                                cm (max 50 cm)
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Gewicht:
                            </td>
                            <td>
                                <input type="number" name="pakketGewicht" id="pakketGewicht">
                                kg (max 10 kg)
                            </td>
                        </tr>
                    </table>
                    <a href="#" class="changeStep" data-stap="3">Volgende stap</a>
                </div>
                <div class="pagina" id="stap3">
                    <h1>
                        Stap 3: Ons voorstel aan u
                    </h1>
                    <div id="waiting">
                        <img src="templates/images/loader.gif" />
                    </div>
                    <div id="resultaat">
                        <table>
                            <tr>
                                <td>
                                    Wij bezorgen uw pakket
                                </td>
                                <td>
                                    Vandaag
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    TZT vraagt hiervoor
                                </td>
                                <td>
                                    <div id="prijs">

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Ophalen bij
                                </td>
                                <td>
                                    <div id="resultaatOphaalAdres">

                                    </div>
                                    <input type="hidden" name="resultaatOphaalAdres" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Afleveradres
                                </td>
                                <td>
                                    <div id="resultaatAfleverAdres">

                                    </div>
                                    <input type="hidden" name="resultaatAfleverAdres" />
                                </td>
                            </tr>
                        </table>
                        <input type="hidden" name="resApiCall" id="resApiCall" />
                        <a href="#" class="changeStep" data-stap="4">Volgende stap</a>
                    </div>
                </div>
                <div class="pagina" id="stap4">
                    <h1>
                        Stap 4: Wij houden u graag op de hoogte van de voortgang
                    </h1>
                    <table>
                        <tr>
                            <td>
                                
                            </td>
                            <td>
                                Klantgegevens
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Naam
                            </td>
                            <td>
                                <input name="klantgegevensNaam" id="klantgegevensNaam" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                E-mailadres
                            </td>
                            <td>
                                <input type="email" name="klantgegevensEmail" id="klantgegevensEmail" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Telefoonnummer
                            </td>
                            <td>
                                <input name="klantgegevensTelNr" id="klantgegevensTelNr" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" value="Plaats Order" />
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
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