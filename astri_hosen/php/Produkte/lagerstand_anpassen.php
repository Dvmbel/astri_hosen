<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Astri Hosen GmbH</title>
    <style rel="stylesheet" type="text/css">
        @import "../../css/bootstrap.min.css";
        @import "../../css/astri_hosen_style.css";
    </style>

    <link rel="icon" type="image/png" href="../../img/favicon.png">
</head>


<body>
<?php
session_start();
require_once "../../model/Produkt.php";
require_once "../Secruity/management_system.php";
require_once "../../model/Mitarbeiter.php";
authenticate_mitarbeiter();





$id = $_GET["id"];
$item = Produkt::get($id);


if (isset($_POST['submit'])) {



    $produkt_bez = $item->getProduktBez();
    $produkt_menge = isset($_POST['menge']) ? $_POST['menge'] : '';
    $produkt_preis = $item->getProduktPreis();
    $produkt_bild = $item->getProduktBild();
    $produkt_datum = $item->getProduktDatum();
    $produkt_mindest_menge = $item->getProduktMinMenge();
    $produkt_beschreibung = $item->getProduktBeschreibung();
    $produkt_link = $item->getProduktLink();


    $item->setProduktBez($produkt_bez);
    $item->setProduktMenge($produkt_menge);
    $item->setProduktPreis($produkt_preis);
    $item->setProduktBild($produkt_bild);
    $item->setProduktDatum($produkt_datum);
    $item->setProduktMinMenge($produkt_mindest_menge);
    $item->setProduktBeschreibung($produkt_beschreibung);
    $item->setProduktLink($produkt_link);
    $item->update();


    if(isset($_SESSION['userid_admin'])) {
        header("Location: ../admin_übersicht.php");

    } elseif (isset($_SESSION['userid_mitarbeiter'])) {
        header("Location: ../mitarbeiter_übersicht.php");
    }
}

$title = "Beim Produkt <b>'".$item->getProduktBez()."' </b>wird der Lagestand angepasst.";

if ($item->getProduktBild() == NULL){
    $hintergrund = "../../img/keine_hose_vorhanden.png";
} else{
    $hintergrund = $item->getProduktBild();
}
?>
<style>
    body {
        background-image: url("<?=$hintergrund?>");
        background-position-y: 100px;
        background-repeat: no-repeat;
        background-size: 20%;
    }
</style>
<br>
<div class="container">
    <div class="row">
        <h2><?= $title ?></h2>
    </div>
<br>
    <form class="form-horizontal" action="lagerstand_anpassen.php?id=<?=$item->getProduktId();?>" method="post">

        <div class="row">
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label"><b>Artikelnummer:</b></label>
                    <input type="text" class="form-control" name="artikelnummer" maxlength="32" value="<?= $item->getProduktId() ?>" readonly>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="form-group required ">
                    <label class="control-label"><b>Produkt Bezeichnung:</b></label>
                    <input type="text" class="form-control" name="bezeichnung" maxlength="64" value="<?= $item->getProduktBez() ?>" readonly>
                </div>
            </div>
            <div class="col-md-5"></div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label"><b>Lagerstand:</b></label>
                    <input type="number" class="form-control" name="menge" min="0" value="<?= $item->getProduktMenge() ?>" >
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label"><b>Mindest Menge:</b></label>
                    <input type="number" class="form-control" name="minMenge" min="0" value="<?= $item->getProduktMinMenge() ?>" readonly>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label"><b>Preis:</b></label>
                    <input type="text" class="form-control" name="preis" min="0" value="<?= $item->getProduktPreis() ?> €" readonly>
                </div>
            </div>
        </div>

        <br>
        <br>
        <br>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group required ">
                    <label class="control-label"><b>Produkt Beschreibung:</b></label>
                    <input type="text" class="form-control" name="beschreibung" value="<?= $item->getProduktBeschreibung() ?>" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group required ">
                    <label class="control-label"><b>Produkt Link:</b></label>
                    <input type="text" class="form-control" name="link" maxlength="255" value="<?= $item->getProduktLink() ?>" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group required ">
                    <label class="control-label"><b>Produktbild Link:</b></label>
                    <input type="text" class="form-control" name="bild" maxlength="255" value="<?= $item->getProduktBild() ?>" readonly>
                </div>
            </div>
            <div class="col-md-5"></div>
        </div>
        <br>
        <p>Dieses Produkt wurde am <b><?=$item->getProduktDatum(); ?></b> hinzugefügt.</p>
        <br>
        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary">Produkt aktualisieren</button>
            <a class="btn btn-warning" href="<?=$_SERVER['HTTP_REFERER']?>" style="margin-left: 8%">Zurück zur Übersicht</a>
        </div>
    </form>

</div> <!-- /container -->

</body>

</html>
