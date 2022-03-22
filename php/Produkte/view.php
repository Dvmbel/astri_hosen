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
authenticate();


$id = $_GET["id"];
$item = Produkt::get($id);

$phpdate = strtotime( $item->getProduktDatum() );
$mysqldate = date( 'j. F Y', $phpdate );

?>

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
                        echo "<li><a href='../Produkte/create.php'>Neues Produkt anlegen</a></li>";
                        echo "<li><a href='../Erweiterungen/erweiterungen_übersicht.php'>Erweiterungen</a></li>";

                    } elseif ((isset($_SESSION['userid_mitarbeiter']) != NULL)) {
                        echo "<li><a href='../mitarbeiter_übersicht.php' style='background-color: #95999c'>Produkte</a></li>";
                        echo "<li><a href='../Produkte/create.php'>Neues Produkt anlegen</a></li>";
                        echo "<li><a href='../Erweiterungen/erweiterungen_übersicht.php'>Erweiterungen</a></li>";

                    } elseif ((isset($_SESSION['userid']) != NULL)) {
                        echo "<li><a href='../viewer_übersicht.php' style='background-color: #95999c'>Produkte</a></li>";

                    }
                    ?>
                </ul>
            </nav>
            <a href="../Security/management_abmelden.php">
                <button type="button" name="button" onclick="" class="form-control btn btn-danger"
                        style="border: 1px solid black; background-color: red">Abmelden
                </button>
            </a></div>


    </div>
</div>
<br>
<br>
<br>
<div class="container" style="background-color: white; margin-left: 52vh; color: black; margin-top: -4.8vh">
    <br>
    <div class="row">

        <h1 style="font-size: xx-large; margin-left: 15px;">Das Produkt <b>'<?= $item->getProduktBez() ?>'</b> wird
            angezeigt.</h1>
    </div>
    <p style="color: black">Im folgendem Schritt können Sie ein Produkt hinzufügen.</p>
    <br>

    <form class="form-horizontal" action="create.php" method="post">
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
                        <img src="<?php echo $item->getProduktBild() ?>" id="produkt_bild_anzeige" style="margin-left: 300%; margin-top: -10%; pointer-events: none; position: absolute; width: 180px">
                    </div>
                </div>
            </div>
        </div>

        <?php

        if (isset($_SESSION['userid']) == 0) {

        echo "<div class='row'>";
        echo    "<div class='col-md-2'>";
        echo        "<div class='form-group required'>";
        echo            "<label class='control-label' style='color: black'><b>Lagerstand:</b></label>";
        echo            "<input type='number' class='form-control' name='menge' min='0' value=".$item->getProduktMenge()." readonly>";
        echo        "</div>";
        echo    "</div>";
        echo    "<div class='col-md-1'></div>";
        echo    "<div class='col-md-2'>";
        echo        "<div class='form-group required '>";
        echo            "<label class='control-label' style='color: black'><b>Mindest Menge:</b></label>";
        echo            "<input type='number' class='form-control' name='minMenge' min='0' value=".$item->getProduktMinMenge()." readonly>";
        echo        "</div>";
        echo    "</div>";
        echo "</div>";

        }
        ?>
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
        <?php

        if (isset($_SESSION['userid']) != 0) {
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
        }
        echo "<br>";
        ?>
        <div class="row" style="color: black">
            <div class="col-md-12">
                <div class="form-group required ">
                    <label class="control-label" style="color: black"><b>Produkt Beschreibung:</b></label>
                    <textarea type="text" class="form-control" name="beschreibung"
                              readonly><?= $item->getProduktBeschreibung() ?></textarea>
                </div>
            </div>

            <div class="col-md-12">
                <br>
                <div class="form-group required ">
                    <?php
                    if ($item->getProduktLink() == NULL) {

                        echo "<b>Es ist leider kein Produktlink hinterlegt.</b><br>";

                    } else {

                        echo "<b>Besuchen Sie das Produkt in unserem Webshop, um es zu kaufen:</b><br>";
                        echo "<a class='control-label' target='_blank' href=" . $item->getProduktLink() . " style=\"color: blue\">" . $item->getProduktLink() . "</a></label>";

                    }
                    ?>

                </div>
            </div>
        </div>
        <br>
        <p style="color: black">Dieses Produkt wurde am <b><?php echo $mysqldate; ?></b> hinzugefügt.</p>
        <br>
        <div class="form-group">
            <?php

            if (isset($_SESSION['userid_admin'])) {
                echo "<a class='btn btn-warning' href='../admin_übersicht.php'>Zurück zur Übersicht</a>";

            } elseif (isset($_SESSION['userid_mitarbeiter'])) {
                echo "<a class='btn btn-warning' href='../mitarbeiter_übersicht.php'>Zurück zur Übersicht</a>";

            } elseif (isset($_SESSION['userid'])) {
                echo "<a class='btn btn-warning' href='../viewer_übersicht.php'>Zurück zur Übersicht</a>";

            }
            ?>
        </div>
        <br>
    </form>
</div>
</body>
</html>
