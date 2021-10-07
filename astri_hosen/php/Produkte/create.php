<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Astri Hosen GmbH</title>
    <style rel="stylesheet" type="text/css">
        @import "../../css/bootstrap.min.css";
        @import "../../css/astri_hosen_style.css";
        @import "../../css/templatemo-style.css";
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






if (isset($_POST['submit'])) {

    $produkt_id = isset($_POST['artikelnummer']) ? $_POST['artikelnummer'] : '';
    $produkt_bez = isset($_POST['bezeichnung']) ? $_POST['bezeichnung'] : '';
    $produkt_menge = isset($_POST['menge']) ? $_POST['menge'] : '';
    $produkt_preis = isset($_POST['preis']) ? $_POST['preis'] : '';
    $produkt_bild = isset($_POST['bild']) ? $_POST['bild'] : '';
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


    if(isset($_SESSION['userid_admin'])) {
        header("Location: ../admin_übersicht.php");

    } elseif (isset($_SESSION['userid_mitarbeiter'])) {
        header("Location: ../mitarbeiter_übersicht.php");
    }
}
?>
<!-- Sidebar Menu -->
<div class="responsive-nav">
    <i class="fa fa-bars" id="menu-toggle"></i>
    <div id="menu" class="menu">
        <i class="fa fa-times" id="menu-close"></i>
        <div class="container">
            <div class="image">
                <a href="#"><img src="../../img/astri_logo.png" alt="" /></a>
            </div>
            <div class="author-content">
                <h4>Astri Hosen GmBH</h4>
                <span></span>
            </div>
            <nav class="main-nav" role="navigation">
                <ul class="main-menu">
                    <li><a href="../admin_übersicht.php">Produkte</a></li>
                    <li><a href="../Mitarbeiter/mitarbeiter_anzeigen.php">Mitarbeiter</a></li>
                    <li><a href="../Mitarbeiter/create.php">Neuen Mitarbeiter anlegen</a></li>
                    <li><a href="../Produkte/create.php" style="background-color: #95999c">Neues Produkt anlegen</a></li>
                </ul>
            </nav>

            <br>
            <br>

            <a href="../Secruity/management_abmelden.php"><button type="button" name="button" onclick="" class="form-control btn btn-danger" style="border: 1px solid black; background-color: red">Abmelden</button></a></div>


    </div>
</div>
<br>
<div class="container" style="background-color: gray ; margin-left: 500px">
    <br>
    <div class="row">
        <h1 style="font-size: xx-large ; color: white; margin-left: 15px"><b>Ein Produkt hinzufügen</b></h1>
    </div>
    <p>Im folgendem Schritt können Sie ein Produkt hinzufügen.</p>
<br>
    <form class="form-horizontal" action="create.php" method="post">

        <div class="row">
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label"><b>Artikelnummer:</b></label>
                    <input type="text" class="form-control" name="artikelnummer" maxlength="32" required>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="form-group required ">
                    <label class="control-label"><b>Produkt Bezeichnung:</b></label>
                    <input type="text" class="form-control" name="bezeichnung" maxlength="64" required>
                </div>
            </div>
            <div class="col-md-5"></div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label"><b>Lagerstand:</b></label>
                    <input type="number" class="form-control" name="menge" min="0" value="0">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label"><b>Mindest Menge:</b></label>
                    <input type="number" class="form-control" name="minMenge" min="0" value="0">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label"><b>Preis:</b></label>
                    <input type="text" class="form-control" name="preis" min="0" value="0">
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
                    <input type="text" class="form-control" name="beschreibung">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group required ">
                    <label class="control-label"><b>Produkt Link:</b></label>
                    <input type="text" class="form-control" name="link" maxlength="255">
                </div>
            </div>
            <div class="col-md-5"></div>
            <div class="col-md-12">
                <div class="form-group required ">
                    <label class="control-label"><b>Produktbild Link:</b></label>
                    <input type="text" class="form-control" name="bild" maxlength="255">
                </div>
            </div>
            <div class="col-md-5"></div>
        </div>


        <br>
        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary">Produkt hinzufügen</button>
            <a class="btn btn-warning" href="<?=$_SERVER['HTTP_REFERER']?>" style="margin-left: 8%">Zurück zur Übersicht</a>
        </div>
    </form>
    <br>


</div>
</body>

</html>
