<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Astri Hosen GmbH</title>

    <style rel="stylesheet" type="text/css">
        @import "../../../css/bootstrap-4.3.1-dist/css/bootstrap.css";
        @import "../../../css/astri_hosen_style.css";
        @import "../../../css/templatemo-style.css";
    </style>

    <link rel="icon" type="image/png" href="../../../img/favicon.png">

</head>

<body>

<?php
require_once "../../../model/Produkt.php";
require_once "../../Security/management_system.php";
require_once "../../../model/Mitarbeiter.php";
authenticate_mitarbeiter();

$items = Produkt::getAll();
?>

<div class="responsive-nav">
    <i class="fa fa-bars" id="menu-toggle"></i>
    <div id="menu" class="menu">
        <i class="fa fa-times" id="menu-close"></i>
        <div class="container">
            <div class="image">
                <a href="#"><img src="../../../img/astri_logo.png"/></a>
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
                        echo "<li><a href='../../admin_übersicht.php'>Produkte</a></li>";
                        echo "<li><a href='../../Mitarbeiter/mitarbeiter_anzeigen.php'>Mitarbeiter</a></li>";
                        echo "<li><a href='../../Mitarbeiter/create.php'>Neuen Mitarbeiter anlegen</a></li>";
                    } else {
                        echo "<li><a href='../../mitarbeiter_übersicht.php'>Produkte</a></li>";

                    }
                    ?>
                    <li><a href="../../Produkte/create.php">Neues Produkt anlegen</a></li>
                    <li><a href="../erweiterungen_übersicht.php" style="background-color: #95999c">Erweiterungen</a></li>
                </ul>
            </nav>
            <a href="../../Security/management_abmelden.php">
                <button type="button" name="button" onclick="" class="form-control btn btn-danger" style="border: 1px solid black; background-color: red">Abmelden</button>
            </a>
        </div>
    </div>
</div>
<br>
<br>
<br>
<div class="container" style="background-color: white; margin-left: 52vh; color: black; margin-top: -4.8vh">
    <table class="table table-striped border mt-5" style="text-align: center">

        <br>
        <tr style="text-align: left; color: darkred">
            <th><h1>Kennzahlenanalyse der Produkte</h1></th>
        </tr>
        <tr>
            <th style='text-align: left;'>Erfasste Produkte</th>
            <td>
                <?php
                $summeProdukte = 0;
                foreach ($items as $i) {
                    $summeProdukte += 1;
                }
                echo $summeProdukte . " Produkte";
                ?>

            </td>
        </tr>
        <tr>
            <th style='text-align: left;'>Warenbestand aller Produkte</th>
            <td>
                <?php
                $summeAllerProdukte = 0;
                foreach ($items as $i) {
                    $summeAllerProdukte += $i->getProduktMenge();
                }
                echo $summeAllerProdukte . " Stück";
                ?>

            </td>
        </tr>

        <tr>
            <th style='text-align: left;'>Warenbestand in Euro</th>
            <td>
                <?php
                $sum = 0;
                foreach ($items as $i) {
                    $sum += $i->getProduktMenge() * $i->getProduktPreis();
                }
                echo number_format($sum, 2, ',', '.') . " €";
                ?>

            </td>
        </tr>
    </table>


    <details open>
        <summary>Produkt spezifische Analyse</summary>
        <details style="margin-left: 10px; color: darkred">
            <summary><b style="color: darkred">Analyse der Produkte</b></summary>

            <table class="table table-striped border mt-5" style="text-align: left; margin: 0px">
                <tr>
                    <?php $item2 = Produkt::getTeuerstesProdukt(); ?>
                    <th style='text-align: left;'>Das teuerste Produkt ist <b
                                style="color: darkred;">'<?= $item2->getProduktBez(); ?>'</b> und kostet
                    </th>
                    <td style="float: right">
                        <?php
                        echo number_format($item2->getProduktPreis(), 2, ',', '.') . " €";
                        ?>
                    </td>
                </tr>

                <tr>
                    <th style="text-align: left;">Von dem Produkt sind aktuell <?= $item2->getProduktMenge(); ?> Stück
                        vorhanden.
                    </th>
                </tr>
            </table>

            <table class="table table-striped border mt-5" style="text-align: left">
                <tr>
                    <?php $item2 = Produkt::getBilligstesProdukt(); ?>
                    <th style='text-align: left;'>Das billigste Produkt ist <b
                                style="color: darkred;">'<?= $item2->getProduktBez(); ?>'</b> und kostet
                    </th>
                    <td style="float: right">
                        <?php
                        echo number_format($item2->getProduktPreis(), 2, ',', '.') . " €";
                        ?>
                    </td>
                </tr>
                <tr>
                    <th style="text-align: left;">Von dem Produkt sind aktuell <?= $item2->getProduktMenge(); ?> Stück
                        vorhanden.
                    </th>
                </tr>
            </table>
        </details>


        <details style="margin-left: 10px; color: darkred">
            <summary><b style="color: darkred">Analyse des Lagers</b></summary>
            <table class="table table-striped border mt-5" style="text-align: center; color: white">
                <th style='text-align: left; background-color: darkred; '>Lagerstand aller Produkte in Prozent</th>
                <th style='text-align: left; background-color: darkred; '></th>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <?php
                foreach ($items as $c) {
                    echo "<tr>";
                    echo "<td style='text-align: left; background-color: darkred;'>" . $c->getProduktBez() . "</td>";

                    $lagerstandInProzent = number_format($c->getProduktMenge() / $summeAllerProdukte * 100, 3, '.', '');
                    echo "<td style='text-align: left; background-color: darkred;'>" . $lagerstandInProzent . " %</td>";
                    echo "</tr>";
                }

                ?>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style='text-align: left; background-color: darkred;'><b>Summe</b></td>
                    <td style='text-align: left; background-color: darkred;'><b>100%</b></td>
                </tr>
            </table>
            <table class="table table-striped border mt-5" style="text-align: left">
                <tr>
                    <?php $item2 = Produkt::getMeistGelagertesProdukt(); ?>
                    <th style='text-align: left;'>Das Produkt mit dem größten Lagerbestand ist <b
                                style="color: darkred;">'<?= $item2->getProduktBez(); ?>'</b> mit</b></th>
                    <td style="float: right">
                        <?php
                        echo $item2->getProduktMenge() . " Stück";
                        ?>
                    </td>
                </tr>
                <tr>
                    <th style="text-align: left;">Das
                        wären <?= number_format($item2->getProduktMenge() / $summeAllerProdukte * 100, 2, '.', '') ?> %
                        vom gesamten Lagerbestand.
                    </th>
                </tr>
            </table>

            <table class="table table-striped border mt-5" style="text-align: left">
                <tr>
                    <?php $item2 = Produkt::getWenigstesGelagertesProdukt(); ?>
                    <th style='text-align: left;'>Das Produkt mit dem geringsten Lagerbestand ist <b
                                style="color: darkred;">'<?= $item2->getProduktBez(); ?>'</b> mit</b></th>
                    <td style="float: right">
                        <?php
                        echo $item2->getProduktMenge() . " Stück";
                        ?>
                    </td>
                </tr>
                <tr>
                    <th style="text-align: left;">Das
                        wären <?= number_format($item2->getProduktMenge() / $summeAllerProdukte * 100, 2, '.', '') ?> %
                        vom gesamten Lagerbestand.
                    </th>
                </tr>
            </table>
        </details>
    </details>
    <table class="table table-striped border mt-5" style="text-align: center">
        <?php
        $allePersonen = Mitarbeiter::getAll();
        $admins = Mitarbeiter::getAllAdmins();
        $mitarbeiter = Mitarbeiter::getAllMitarbeiter();
        ?>

        <br>

        <tr style="text-align: left; color: darkred">
            <th><h1>Kennzahlen der Mitarbeiter</h1></th>
        </tr>

        <tr>
            <th style='text-align: left;'>Anzahl aller Administratoren</th>
            <td>
                <?php
                $summeAllerAdmins = 0;
                foreach ($admins as $m) {
                    $summeAllerAdmins += 1;
                }
                echo $summeAllerAdmins;
                ?>
            </td>
        </tr>

        <tr>
            <th style='text-align: left;'>Anzahl aller Mitarbeiter</th>
            <td>
                <?php
                $summeAllerMitarbeiter = 0;
                foreach ($mitarbeiter as $m) {
                    $summeAllerMitarbeiter += 1;
                }
                echo $summeAllerMitarbeiter;
                ?>
            </td>
        </tr>

        <tr>
            <th style='text-align: left;'>Summe aller Personen</th>
            <td>
                <?php
                $summeAllerPersonen = 0;
                foreach ($allePersonen as $m) {
                    $summeAllerPersonen += 1;
                }
                echo $summeAllerPersonen;
                ?>
            </td>
        </tr>

    </table>
    <br>
</div>
</body>
</html>


