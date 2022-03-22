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


    $item->delete($id);
    if (isset($_SESSION['userid_admin'])) {
        header("Location: ../admin_übersicht.php");

    } elseif (isset($_SESSION['userid_mitarbeiter'])) {
        header("Location: ../mitarbeiter_übersicht.php");
    }

}

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
<br>

<div class="container" style="background-color: white; margin-left: 52vh; color: black; margin-top: -2.8vh">
    <br>
    <h2>Das Produkt <b>'<?= $item->getProduktBez() ?>'</b> wird gelöscht.</h2>
    <form class="form-horizontal" action="delete.php?id=<?= $item->getProduktId(); ?>" method="post">
        <table class="table table-striped table-bordered detail-view">
            <br>
            <tbody>
            <tr>
                <th>Artikelnummer:</th>
                <td><?= $item->getProduktId(); ?></td>
            </tr>
            <tr>
                <th>Produkt Bezeichnung:</th>
                <td><?= $item->getProduktBez(); ?></td>
            </tr>
            <tr>

                <?php

                if ($item->getProduktMenge() == 0) {
                    echo "<th>Restlicher Lagerbestand:</th>";
                    echo "<td style='color: black'><b>" . $item->getProduktMenge() . " Stücke</b></td>";
                } else {

                    echo "<th>Restlicher Lagerbestand:</th>";
                    echo "<td style='color: red'><b>" . $item->getProduktMenge() . " Stücke</b></td>";
                }

                ?>
            </tr>
            <tr>
                <th>Mindest Menge:</th>
                <td><?= $item->getProduktMinMenge(); ?> Stück</td>
            </tr>
            <tr>
                <th>Produkt Preis:</th>
                <td><?= number_format($item->getProduktPreis(), 2, ',', '.') ?> €</td>
            </tr>
            <tr>
                <th>Produkt Beschreibung:</th>
                <td><?= $item->getProduktBeschreibung(); ?></td>
            </tr>
            <tr>
                <th>Produkt Erstelldatum:</th>
                <td style="color: black"><b><?= $mysqldate; ?></b></td>
            </tr>
            </tbody>
        </table>
        <br>
        <div class="form-group">

            <button type="submit" name="submit" class="btn btn-danger">Löschen</button>
            <?php

            if (isset($_SESSION['userid_admin'])) {
                echo "<a class='btn btn-warning' href='../admin_übersicht.php' style='margin-left: 15%'>Zurück zur Übersicht</a>";

            } elseif (isset($_SESSION['userid_mitarbeiter'])) {
                echo "<a class='btn btn-warning' href='../mitarbeiter_übersicht.php' style='margin-left: 15%'>Zurück zur Übersicht</a>";

            }
            ?>
        </div>
    </form>
    <br>
</div>
</body>
</html>


