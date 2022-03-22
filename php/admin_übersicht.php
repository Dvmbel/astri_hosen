<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Astri Hosen GmbH</title>

    <style rel="stylesheet" type="text/css">
        @import "../css/astri_hosen_style.css";
        @import "../css/bootstrap-4.3.1-dist/css/bootstrap.css";
        @import "../css/templatemo-style.css";

    </style>

    <link rel="stylesheet" href="../css/astri_hosen_style.css">
    <link rel="icon" type="image/png" href="../img/favicon.png">

</head>

<body>
<?php
require_once "../model/Produkt.php";
require "../model/Mitarbeiter.php";
require_once "Security/management_system.php";
authenticate_admin();
?>

<div class="responsive-nav">
    <i class="fa fa-bars" id="menu-toggle"></i>
    <div id="menu" class="menu">
        <i class="fa fa-times" id="menu-close"></i>
        <div class="container">
            <div class="image">
                <a href="#"><img src="../img/astri_logo.png" alt=""/></a>
            </div>
            <div class="author-content">
                <h4>Astri Hosen GmbH</h4>
                <?php
                echo $_SESSION['userid_anzeige'];
                ?>
            </div>
            <nav class="main-nav" role="navigation">
                <ul class="main-menu">
                    <li><a href="admin_übersicht.php" style="background-color: #95999c">Produkte</a></li>
                    <li><a href="Mitarbeiter/mitarbeiter_anzeigen.php">Mitarbeiter</a></li>
                    <li><a href="Mitarbeiter/create.php">Neuen Mitarbeiter anlegen</a></li>
                    <li><a href="Produkte/create.php">Neues Produkt anlegen</a></li>
                    <li><a href="Erweiterungen/erweiterungen_übersicht.php">Erweiterungen</a></li>
                </ul>
            </nav>
            <a href="Security/management_abmelden.php">
                <button type="button" name="button" class="form-control btn btn-danger"
                        style="border: 1px solid black; background-color: red">Abmelden
                </button>
            </a></div>
    </div>
</div>


<div class="container table-responsive" style="margin-left: 52vh">

    <?php
    $items = Produkt::getAll();
    $text = true;
    foreach ($items as $c) {
        if ($c->getProduktMenge() < $c->getProduktMinMenge()) {
            $text = false;
        }
    }

    if ($text == true) {
        echo "<div class='alert alert-success text-center mt-5'><h3 style='color: black'>Genügend Produkte sind auf Lager!</h3></div>";
    }

    if ($text == false) {
        echo "<div class='alert alert-danger text-center mt-5'> <h3 style='color: black'>Bitte die folgenden Produkte nachbestellen:</h3>";
        echo "<table class='table table-striped border mt-5'>";
        echo "<th>Bezeichnung</th>";
        echo "<th>Verfügbare Menge</th>";
        echo "<th>Bearbeitung</th>";
        foreach ($items as $c) {

            if ($c->getProduktMenge() < $c->getProduktMinMenge()) {

                echo "<tr>";
                echo "<td>" . $c->getProduktBez() . "</td>";
                echo "<td>" . $c->getProduktMenge() . " Stück</td>";
                echo "<td><a href='Produkte/lagerstand_anpassen.php?id=" . $c->getProduktId() . "' ><button class='btn btn-warning'>Lagerstand anpassen</button></a></td>";
                echo "</tr>";

            }

        }

        echo "</table>";
        echo "</div>";
    }
    ?>

    <table class="table table-striped border mt-5" style="text-align: center">

        <th style='text-align: left;'>Artikelnummer</th>
        <th style='text-align: left;'>Bezeichnung</th>
        <th>Verfügbare Menge</th>
        <th>Preis</th>
        <th>Bearbeitung</th>
        <?php

        foreach ($items as $c) {
            echo "<tr>";
            echo "<td>" . $c->getProduktId() . "</td>";
            echo "<td style='text-align: left;'>" . $c->getProduktBez() . "</td>";
            echo "<td>" . $c->getProduktMenge() . " Stück</td>";

            $preis = $c->getProduktPreis();
            echo "<td>" . number_format($preis, 2, ',', '.') . " €</td>";

            echo "<td>";

            echo " <a href='Produkte/view.php?id=" . $c->getProduktId() . "' ><button class='btn btn-info'>Anzeigen</button></a> ";

            echo " <a href='Produkte/lagerstand_anpassen.php?id=" . $c->getProduktId() . "' ><button class='btn btn-warning'>Lagerstand anpassen</button></a> ";

            echo " <a href='Produkte/update.php?id=" . $c->getProduktId() . "' ><button class='btn btn-success'>Ändern</button></a> ";

            echo " <a href='Produkte/delete.php?id=" . $c->getProduktId() . "' >  <b style='color:black;'>  | </b> <button class='btn btn-danger' style=\"border: 1px solid black; background-color: red\">Löschen</button></a> ";

            echo "</td>";

            echo "</tr>";
        }
        ?>
    </table>
    <br>
</div>
</body>
</html>