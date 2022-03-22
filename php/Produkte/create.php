<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Astri Hosen GmbH</title>
    <style rel="stylesheet" type="text/css">
        @import "../../css/bootstrap-4.3.1-dist/css/bootstrap.css";
        @import "../../css/astri_hosen_style.css";
        @import "../../css/templatemo-style.css";
    </style>

    <link rel="icon" type="image/png" href="../../img/favicon.png">
</head>
<body>
<?php
require_once "../../model/Produkt.php";
require_once "../Security/management_system.php";
require_once "../../model/Mitarbeiter.php";
authenticate_mitarbeiter();


$items = Produkt::getAll();
$item2 = Produkt::getLetzterEintrag();
$produkt_link = "https://www.astri.at/shop/";
$ArtikelnummerBereitsVergeben = false;
$produkt_bez = "";
$produkt_menge = "0";
$produkt_preis = "0,00";

if (isset($_SESSION['upgeloadetesElement'])){
    $produkt_bild = $_SESSION['upgeloadetesElement'];
    unset($_SESSION['upgeloadetesElement']);

} else{
    $produkt_bild = "keine_hose_vorhanden.png";
}

$produkt_mindest_menge = "0";
$produkt_beschreibung = "";
$produkt_bez = "";

if (isset($_POST['submit'])) {
    $ArtikelnummerBereitsVergeben = false;
    $produkt_id = isset($_POST['artikelnummer']) ? $_POST['artikelnummer'] : '';
    foreach ($items as $c) {
        if ($c->getProduktId() == $produkt_id) {
            $ArtikelnummerBereitsVergeben = true;
        }
    }

    if ($ArtikelnummerBereitsVergeben == false) {
        finishArtikel();
    }
}

function finishArtikel()
{
    $produkt_id = isset($_POST['artikelnummer']) ? $_POST['artikelnummer'] : '';
    $produkt_bez = isset($_POST['bezeichnung']) ? $_POST['bezeichnung'] : '';
    $produkt_menge = isset($_POST['menge']) ? $_POST['menge'] : '';

    $produkt_preis = isset($_POST['preis']) ? $_POST['preis'] : '';
    $produkt_preis = str_replace(",", ".", "$produkt_preis");

    $produkt_bild = isset($_POST['bild']) ? $_POST['bild'] : '';
    if (strpos($produkt_bild, 'http') || strpos($produkt_bild, 'https') || strpos($produkt_bild, 'www')) {
        $produkt_bild = isset($_POST['bild']) ? $_POST['bild'] : '';
    } else {
        $produkt_bild_pfad = "../../Bilder/";
        $produkt_bild = $produkt_bild_pfad . $produkt_bild;
    }

    $produkt_datum = date(DATE_ATOM);
    $produkt_mindest_menge = isset($_POST['minMenge']) ? $_POST['minMenge'] : '';
    $produkt_beschreibung = isset($_POST['beschreibung']) ? $_POST['beschreibung'] : '';
    $produkt_link = isset($_POST['link']) ? $_POST['link'] : '';
    $item = new Produkt();

    $item->setProduktId($produkt_id);
    $item->setProduktBez($produkt_bez);
    $item->setProduktMenge($produkt_menge);
    $item->setProduktPreis($produkt_preis);
    $item->setProduktBild($produkt_bild);
    $item->setProduktDatum($produkt_datum);
    $item->setProduktMinMenge($produkt_mindest_menge);
    $item->setProduktBeschreibung($produkt_beschreibung);
    $item->setProduktLink($produkt_link);
    $item->create();

    $_SESSION['status-good'] = "Das Produkt wurde erfolgreich hinzugefügt.";
}

?>

<script type="text/javascript">
    window.oninput = function () {
        var bild_link = document.getElementById("myImg").value;

        if (bild_link.includes("http") || bild_link.includes("https") || bild_link.includes("www")) {
            document.getElementById("produkt_bild_anzeige").src = bild_link;

        } else if (bild_link.includes("keine_hose_vorhanden.png")) {

            var bild_link_pfad = "../../img/";
            document.getElementById("produkt_bild_anzeige").src = bild_link_pfad + bild_link;

        } else {

            var bild_link_pfad = "../../Bilder/";
            document.getElementById("produkt_bild_anzeige").src = bild_link_pfad + bild_link;

        }
    }
</script>

<div class="responsive-nav">
    <i class="fa fa-bars" id="menu-toggle"></i>
    <div id="menu" class="menu">
        <i class="fa fa-times" id="menu-close"></i>
        <div class="container">
            <div class="image">
                <a href="#"><img src="../../img/astri_logo.png"/></a>
            </div>
            <div class="author-content">
                <h4>Astri Hosen GmBH</h4>
                <?php
                echo $_SESSION['userid_anzeige'];
                ?>
            </div>
            <nav class="main-nav" role="navigation">
                <ul class="main-menu">
                    <?php
                    if (isset($_SESSION['userid_admin']) != NULL) {
                        echo "<li><a href='../admin_übersicht.php'>Produkte</a></li>";
                        echo "<li><a href='../Mitarbeiter/mitarbeiter_anzeigen.php'>Mitarbeiter</a></li>";
                        echo "<li><a href='../Mitarbeiter/create.php'>Neuen Mitarbeiter anlegen</a></li>";
                    } else {
                        echo "<li><a href='../mitarbeiter_übersicht.php'>Produkte</a></li>";

                    }
                    ?>
                    <li><a href="../Produkte/create.php" style="background-color: #95999c">Neues Produkt anlegen</a></li>
                    <li><a href="../Erweiterungen/erweiterungen_übersicht.php">Erweiterungen</a></li>
                </ul>
            </nav>
            <a href="../Security/management_abmelden.php">
                <button type="button" name="button" onclick="" class="form-control btn btn-danger" style="border: 1px solid black; background-color: red">Abmelden</button>
            </a>
        </div>
    </div>
</div>
<br>
<br>
<br>

<div class="container" style="background-color: white; margin-left: 52vh; color: black; margin-top: -4.8vh">
    <br>
    <?php
    if (isset($_SESSION['status-good'])) {
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <b><?= $_SESSION['status-good']; ?></b>
        </div>
        <?php
        unset($_SESSION['status-good']);
    }


    if ($ArtikelnummerBereitsVergeben == true) {
        echo "<div class='alert alert-danger text-center'> <b>Artikelnummer bereits vergeben!</b><br> Wählen Sie eine andere Artikelnummer für Ihr Produkt.<b></div>";
    }
    ?>

    <div class="row">
        <h1 style="font-size: xx-large ; color: black ; margin-left: 50px"><b>Ein Produkt hinzufügen</b></h1>
    </div>
    <p style="color: black; margin-left: 38px">Im folgendem Schritt können Sie ein Produkt hinzufügen.</p>
    <br>
    <form class="form-horizontal" action="create.php" method="post">
        <div class="row">
            <div class="col-md-4" style="color: black; margin-left: 30px">
                <div class="form-group required">
                    <label class="control-label" style="color: black"><b>Artikelnummer:</b></label>
                    <input type="text" class="form-control" value="<?= $item2->getProduktId() + 1000 ?>"
                           name="artikelnummer" maxlength="32" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group required ">
                    <label class="control-label" style="color: black"><b>Produkt Bezeichnung:</b></label>
                    <input type="text" class="form-control" name="bezeichnung" value="<?= $produkt_bez ?>"
                           maxlength="64" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div>
                        <img src="../../img/keine_hose_vorhanden.png" id="produkt_bild_anzeige" style="margin-left: 300%; margin-top: -10%; pointer-events: none; position: absolute; width: 180px">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4" style="color: black; margin-left: 30px">
                <div class="form-group required ">
                    <label class="control-label" style="color: black"><b>Lagerstand:</b></label>
                    <input type="number" class="form-control" name="menge" value="<?= $produkt_menge ?>" min="0">
                </div>
            </div>


            <div class="col-md-4">
                <div class="form-group required ">
                    <label class="control-label" style="color: black"><b>Mindest Menge:</b></label>
                    <input type="number" class="form-control" name="minMenge" value="<?= $produkt_mindest_menge ?>"
                           min="0">
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-2" style="color: black; margin-left: 30px">
                <div class="form-group required ">
                    <label class="control-label" style="color: black"><b>Preis:</b></label>
                    <input type="text" class="form-control" name="preis" value="<?= $produkt_preis ?>" min="0">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group required" style="color: black; margin-left: 30px">
                    <label class="control-label" style="color: black"><b>Produktbild über Link oder Dateiname:</b></label>
                    <input type="text" class="form-control" name="bild" id="myImg" value="<?= $produkt_bild ?>" maxlength="255" style="color: blue">
                    <a href="../Erweiterungen/Upload/dateiUpload.php?erstellungEinesProduktes=true" style="color: black">Wenn Sie eine Datei hochladen möchten, dann klicken Sie hier.</a>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group required " style="color: black; margin-left: 30px">
                    <label class="control-label" style="color: black"><b>Produkt Link:</b></label>
                    <input type="text" class="form-control" name="link" value="<?= $produkt_link ?>" style="color: blue"
                           maxlength="255">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group required " style="color: black; margin-left: 30px">
                    <label class="control-label" style="color: black"><b>Produkt Beschreibung:</b></label>
                    <textarea type="text" class="form-control" value="<?= $produkt_beschreibung ?>" name="beschreibung"
                              placeholder="Geben Sie eine Beschreibung zu dem Artikel ein."></textarea>
                </div>
            </div>

        </div>
        <br>
        <div class="form-group" style="color: black; margin-left: 30px">
            <button type="submit" name="submit" class="btn btn-primary">Produkt hinzufügen</button>
            <?php

            if (isset($_SESSION['userid_admin'])) {
                echo "<a class='btn btn-warning' href='../admin_übersicht.php' style='margin-left: 5vh'>Zurück zur Übersicht</a>";

            } elseif (isset($_SESSION['userid_mitarbeiter'])) {
                echo "<a class='btn btn-warning' href='../mitarbeiter_übersicht.php' style='margin-left: 5vh'>Zurück zur Übersicht</a>";

            }
            ?>
        </div>
    </form>
    <br>
</div>
</body>
</html>
