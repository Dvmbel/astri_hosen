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


    $_SESSION['status-good'] = "Der Lagerstand von '" . $item->getProduktBez() . "' wurde erfolgreich aktualisiert.";
}

$phpdate = strtotime( $item->getProduktDatum() );
$mysqldate = date( 'j. F Y', $phpdate );
?>
<br>
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
                        echo "<li><a href='../admin_übersicht.php' style='background-color: #95999c'>Produkte</a></li>";
                        echo "<li><a href='../Mitarbeiter/mitarbeiter_anzeigen.php'>Mitarbeiter</a></li>";
                        echo "<li><a href='../Mitarbeiter/create.php'>Neuen Mitarbeiter anlegen</a></li>";
                    } else {
                        echo "<li><a href='../mitarbeiter_übersicht.php' style='background-color: #95999c'>Produkte</a></li>";

                    }
                    ?>
                    <li><a href="../Produkte/create.php">Neues Produkt anlegen</a></li>
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
    ?>
    <div class="row">
        <h2 style="color: black; margin-left: 15px">Beim Produkt <b>'<?= $item->getProduktBez() ?>'</b> wird der
            Lagestand angepasst.</h2>
    </div>
    <br>
    <form class="form-horizontal" action="lagerstand_anpassen.php?id=<?= $item->getProduktId(); ?>" method="post">

        <div class="row">
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label" style="color: black"><b>Artikelnummer:</b></label>
                    <input type="text" class="form-control" name="artikelnummer" maxlength="32"
                           value="<?= $item->getProduktId() ?>" readonly>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="form-group required ">
                    <label class="control-label" style="color: black"><b>Produkt Bezeichnung:</b></label>
                    <input type="text" class="form-control" name="bezeichnung" maxlength="64"
                           value="<?= $item->getProduktBez() ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <img src="<?php echo $item->getProduktBild() ?>" id="produkt_bild_anzeige"
                             style="margin-left: 300%; margin-top: -10%; pointer-events: none; position: absolute; width: 180px">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label" style="color: black"><b>Lagerstand:</b></label>
                    <input type="number" class="form-control" name="menge" min="0"
                           value="<?= $item->getProduktMenge() ?>">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label" style="color: black"><b>Mindest Menge:</b></label>
                    <input type="number" class="form-control" name="minMenge" min="0"
                           value="<?= $item->getProduktMinMenge() ?>" readonly>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label" style="color: black"><b>Preis:</b></label>
                    <?php
                    $preis = $item->getProduktPreis();
                    $preis = str_replace(".", ",", "$preis");
                    ?>
                    <input type="text" class="form-control" name="price" min="0"
                           value="<?= number_format($item->getProduktPreis(), 2, ',', '.') ?> €" readonly>
                </div>
            </div>
        </div>

        <br>
        <br>
        <br>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group required ">
                    <label class="control-label" style="color: black"><b>Produkt Beschreibung:</b></label>
                    <textarea type="text" class="form-control" name="beschreibung"
                              readonly><?= $item->getProduktBeschreibung() ?></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group required ">
                    <label class="control-label" style="color: black"><b>Produkt Link:</b></label>
                    <input type="text" class="form-control" name="link" maxlength="255" style="color: blue"
                           value="<?= $item->getProduktLink() ?>" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group required ">
                    <label class="control-label" style="color: black"><b>Produktbild über Link oder Dateiname:</b></label>
                    <input type="text" class="form-control" name="bild" maxlength="255"
                           value="<?= $item->getProduktBild() ?>" readonly>
                </div>
            </div>
            <div class="col-md-5"></div>
        </div>
        <br>
        <p style="color: black">Dieses Produkt wurde am <b><?= $mysqldate; ?></b> hinzugefügt.</p>
        <br>
        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary">Produkt aktualisieren</button>
            <?php

            if (isset($_SESSION['userid_admin'])) {
                echo "<a class='btn btn-warning' href='../admin_übersicht.php' style='margin-left: 5vh'>Zurück zur Übersicht</a>";

            } elseif (isset($_SESSION['userid_mitarbeiter'])) {
                echo "<a class='btn btn-warning' href='../mitarbeiter_übersicht.php' style='margin-left: 5vh'>Zurück zur Übersicht</a>";

            }
            ?>
        </div>
        <br>
    </form>
</div>
</body>
</html>
