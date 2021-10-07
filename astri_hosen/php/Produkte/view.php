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
authenticate();




$id = $_GET["id"];
$item = Produkt::get($id);
$title = "Das Produkt <b>'".$item->getProduktBez()."' </b>wird angezeigt.";

if ($item->getProduktBild() == NULL){
    $hintergrund = "../../img/keine_hose_vorhanden.png";
} else{
    $hintergrund = $item->getProduktBild();
}

?>
<style>
    body {
        background-image: url("<?=$hintergrund?>");
        background-position: 0%;
        background-repeat: no-repeat;
        background-size: 20%;
    }
</style>
<br>
<div class="container">
    <div class="row">
        <h1 style="font-size: xx-large"><?= $title ?></h1>
    </div>
    <p>Im folgendem Schritt können Sie ein Produkt hinzufügen.</p>
    <br>

    <form class="form-horizontal" action="create.php" method="post">
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
                    <input type="number" class="form-control" name="menge" min="0" value="<?= $item->getProduktMenge() ?>" readonly>
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
                    <input type="text" class="form-control" name="price" min="0" value="<?= $item->getProduktPreis() ?> €" readonly>
                </div>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group required ">
                    <label class="control-label"><b>Produkt Beschreibung:</b></label>
                    <input type="text" class="form-control" name="beschreibung" value="<?= $item->getProduktBeschreibung() ?>" readonly>
                </div>
            </div>

            <div class="col-md-12">
                <br>
                <div class="form-group required ">

                    <?php

                    if ($item->getProduktLink() == NULL){

                        echo "<b>Es ist leider kein Produktlink hinterlegt.</b><br>";

                    } else {

                        echo "<b>Besuchen Sie das Produkt in unserem Webshop, um es zu kaufen:</b><br>";
                        echo "<a class='control-label' target='_blank' href=".$item->getProduktLink().">".$item->getProduktLink()."</a></label>";

                    }
                    ?>
                </div>
            </div>
        </div>
        <br>
        <p>Dieses Produkt wurde am <b><?=$item->getProduktDatum(); ?></b> hinzugefügt.</p>
        <br>
        <div class="form-group">
            <a class="btn btn-warning" href="<?=$_SERVER['HTTP_REFERER']?>">Zurück zur Übersicht</a>
        </div>
    </form>

</div>
</body>

</html>
