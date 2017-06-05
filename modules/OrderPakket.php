<?php

namespace modules;

use model\Pakket;
use model\Traject;
use model\Klant;
use model\Bezorgopdracht;

class OrderPakket {

    private $verzendAdres;
    private $ontvangAdres;
    private $pakketLengte;
    private $pakketBreedte;
    private $pakketHoogte;
    private $pakketGewicht;
    private $email;
    private $naam;
    private $telNr;

    public function verwerkAanvraag() {
        if (isset($_POST) && $this->controleerAanvraag($_POST)) {
            $pakket = new Pakket();
            $pakket->setBreedte($this->pakketBreedte);
            $pakket->setHoogte($this->pakketHoogte);
            $pakket->setLengte($this->pakketLengte);
            $pakket->setGewicht($this->pakketGewicht);
            $pakket->setPakket_id($pakket->saveToDatabase());

            $klant = new Klant();
            $klant->setNaam($this->naam);
            $klant->setKlant_id($klant->saveToDatabase());


            $bezorgOpdracht = new Bezorgopdracht();
            $bezorgOpdracht->setKlant_id($klant->getKlant_id());
            $bezorgOpdracht->setPakket_id($pakket->getPakket_id());
            $bezorgOpdracht->setStartpunt($this->verzendAdres);
            $bezorgOpdracht->setEindpunt($this->ontvangAdres);
            $bezorgOpdracht->setOpdracht_id($bezorgOpdracht->saveToDatabase());

            $resApiCall = json_decode($_POST['resApiCall']);
            if (is_array($resApiCall[2])) {
                $trajectEen = new Traject();
                $trajectEen->setStartpunt($this->verzendAdres);
                $trajectEen->setEindpunt($resApiCall[3]);
                $trajectEen->setKoerier_id($resApiCall[2][0]);
                $trajectEen->setVergoeding(10);
                $trajectEen->setTraject_id($trajectEen->saveToDatabase());
                var_dump($trajectEen);
                $trajectEen->maakTrajectDeel($bezorgOpdracht->getOpdracht_id());
                $trajectTwee = new Traject();
                $trajectTwee->setStartpunt($resApiCall[3]);
                $trajectTwee->setEindpunt($resApiCall[4]);
                $trajectEen->setKoerier_id(4);
                $trajectTwee->setVergoeding(3);
                $traj_id = $trajectTwee->saveToDatabase();
                $trajectTwee->setTraject_id($traj_id);
                var_dump($trajectTwee);
                $trajectTwee->maakTrajectDeel($bezorgOpdracht->getOpdracht_id());
                $trajectDrie = new Traject();
                $trajectDrie->setStartpunt($resApiCall[4]);
                $trajectDrie->setEindpunt($this->ontvangAdres);
                $trajectDrie->setKoerier_id($resApiCall[2][1]);
                $trajectDrie->setVergoeding(10);
                $trajectDrie->setTraject_id($trajectTwee->saveToDatabase());
                $trajectDrie->maakTrajectDeel($bezorgOpdracht->getOpdracht_id());
                var_dump($trajectDrie);
            } else {
                $traject = new Traject();
                $traject->setStartpunt($this->verzendAdres);
                $traject->setEindpunt($this->ontvangAdres);
                $traject->setTraject_id($traject->saveToDatabase());
                $trajectEen->setKoerier_id($resApiCall[2]);
                $traject->maakTrajectDeel($bezorgOpdracht->getOpdracht_id());
            }
            ?>

            <!doctype html>
            <html>
                <head>
                    <script src="templates/jquery.js"></script>
                    <script src="templates/script.js"></script>

                    <link href="/templates/bootstrap/css/bootstrap.min.css" rel="stylesheet">
                    <script src="/templates/bootstrap/js/bootstrap.min.js"></script>
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
                    <div class="container" style="text-align: center">
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-6">
                            <h1>
                                Hartelijk dank voor uw opdracht!
                            </h1>
                            Graag onderstaande referentie <br />
                            duidelijk op uw pakket aanbrengen<br >
                            <div>
                                <?php
                                echo $pakket->getPakket_id();
                                ?>
                            </div>
                            <br />
                            De bevestiging is verstuurd naar uw email adres:<br />
                            <?php echo $this->email; ?>
                            <br />
                        </div>
                        <div class="col-md-3">
                        </div>
                    </div>
                </body>
            </html>
            <?php
        } else {
            exit("FOUT");
        }
    }

    protected function controleerAanvraag($gegevens) {

        //beginadres
        if (!empty($gegevens['resultaatOphaalAdres'])) {
            $this->verzendAdres = $gegevens['resultaatOphaalAdres'];
        } else {
            return false;
        }

        //eindadres
        if (!empty($gegevens['resultaatAfleverAdres'])) {
            $this->ontvangAdres = $gegevens['resultaatAfleverAdres'];
        } else {
            return false;
        }

        //pakketgrootte
        if (!empty($gegevens['pakketLengte']) && $gegevens['pakketLengte'] > 0 && $gegevens['pakketLengte'] <= 50) {
            $this->pakketLengte = $gegevens['pakketLengte'];
        } else {
            return false;
        }
        if (!empty($gegevens['pakketBreedte']) && $gegevens['pakketBreedte'] > 0 && $gegevens['pakketBreedte'] <= 50) {
            $this->pakketBreedte = $gegevens['pakketBreedte'];
        } else {
            return false;
        }
        if (!empty($gegevens['pakketHoogte']) && $gegevens['pakketHoogte'] > 0 && $gegevens['pakketHoogte'] <= 50) {
            $this->pakketHoogte = $gegevens['pakketHoogte'];
        } else {
            return false;
        }
        if (!empty($gegevens['pakketGewicht']) && $gegevens['pakketGewicht'] > 0 && $gegevens['pakketGewicht'] <= 10) {
            $this->pakketGewicht = $gegevens['pakketGewicht'];
        } else {
            return false;
        }

        if (filter_var($gegevens['klantgegevensEmail'], FILTER_VALIDATE_EMAIL)) {
            $this->email = $gegevens['klantgegevensEmail'];
        } else {
            return false;
        }
        if (!empty($gegevens['klantgegevensNaam'])) {
            $this->naam = $gegevens['klantgegevensNaam'];
        } else {
            return false;
        }
        if (!empty($gegevens['klantgegevensTelNr'])) {
            $this->telNr = $gegevens['klantgegevensTelNr'];
        } else {
            return false;
        }
        return true;
    }

}
