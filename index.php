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

            <link href="templates/bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <script src="templates/bootstrap/js/bootstrap.min.js"></script>
            <style>
                body{
                    font-family: Helvetica
                }
                .pagina{
                    display: none;
                }
                .pagina td{
                    padding: 3px;
                }
                #stap1{
                    display: block;
                }
                #resultaat{
                    display: none;
                }
                #waiting{
                    color: white;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <ul class="nav">
                    <li class="nav-item col-md-2">
                        <a class="nav-link active changeStep" data-stap="1">
                            1 - De reis
                        </a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link changeStep" data-stap="2">
                            2 - Het pakket
                        </a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link changeStep" data-stap="3">
                            3 - Ons voorstel
                        </a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link changeStep" data-stap="4">
                            4 - Uw gegevens
                        </a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link disabled changeStep" data-stap="5">
                            Bevestiging en referentie
                        </a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a href="#" data-toggle="modal" data-target="#exampleModal">
                            ?
                        </a>
                        </a>
                    </li>
                </ul>
                <form method="post" action="index.php/modules/OrderPakket/verwerkAanvraag">
                    <div class="pagina" id="stap1">
                        <h1>
                            Stap 1: Waar mogen we uw pakketje ophalen en naartoe brengen?
                        </h1>
                        <div id="verzendDiv" class="col-md-6">
                            Ophalen bij:
                            <table>
                                <tr>
                                    <td>
                                        Postcode:
                                    </td>
                                    <td>
                                        <input id="postcodeCijfersVerzender" type="text" size="4" />
                                        <input id="postcodeLettersVerzender" type="text" size="2" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Huisnummer: 
                                    </td>
                                    <td>
                                        <input id="huisnummerVerzender"  type="text" size="4"/>
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
                        <div id="ontangDiv" class="col-md-6">
                            Brengen naar: 
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
                                        <input id="huisnummerOntvanger"  type="text" size="4" />
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
                            <br /><br />
                            <a href="#" class="changeStep btn btn-primary" data-stap="2">
                                Klaar, naar stap 2
                            </a>
                        </div>
                    </div>
                    <div class="pagina" id="stap2">
                        <h1>
                            Stap 2: Hoe ziet uw pakketje er vandaag uit?
                        </h1>
                        <br /><br />
                        <table>
                            <tr>
                                <td>
                                    &nbsp;
                                </td>
                                <td>
                                    <h2>Kenmerken:</h2>
                                </td>
                            </tr>
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
                                    kilo (max 10 kg)
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    &nbsp;
                                </td>
                                <td>
                                    <a href="#" class="changeStep btn btn-primary" data-stap="3">Naar de offerte</a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    &nbsp;
                                </td>
                                <td>
                                    <a href="#" class="changeStep btn btn-primary" data-stap="1">Terug naar de reisgegevens</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="pagina" id="stap3" class="col-md-6">
                        <h1>
                            Stap 3: Ons voorstel aan u
                        </h1>
                        <div id="waiting" class="img-rounded bg-primary">
                            <div style="display: inline-block;">
                                <img src="templates/images/loader.gif" /> 
                            </div>

                            <div style="display: inline-block;">Nog even geduld: de optimale route wordt berekend en uw offerte wordt samengesteld<br />
                                De pagina wordt automatisch ververst
                            </div>
                        </div>
                        <div id="resultaat">
                            <table>
                                <tr>
                                    <td>
                                        Wij bezorgen uw pakket
                                    </td>
                                    <td style="color: green">
                                        Vandaag
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        TZT vraagt hiervoor
                                    </td>
                                    <td>
                                        <div id="prijs" style="color: green">

                                        </div>
                                    </td>
                                    <td>
                                        (all-in, inclusief 21% btw)
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Ophalen bij
                                    </td>
                                    <td>
                                        &nbsp;
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
                                        &nbsp;
                                    </td>
                                    <td>
                                        <div id="resultaatAfleverAdres">

                                        </div>
                                        <input type="hidden" name="resultaatAfleverAdres" />
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" name="resApiCall" id="resApiCall" />
                            <br />
                            <a href="#" class="changeStep btn btn-primary" data-stap="4">Ja graag, naar stap 4</a><br />
                            <br />
                            <a href="#" class="changeStep btn btn-primary" data-stap="3">Terug naar pakketgegevens</a>
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
                                    <h2>
                                        Klantgegevens
                                    </h2>
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
            </div>
            <div id="debugInfo" class="col-md-12">
                
            </div>
            <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="exampleModalLabel">
                                Kunnen wij u helpen?
                            </h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Heeft u vragen of opmerkingen?<br />
                            Bel: 06-123 456 78
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
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