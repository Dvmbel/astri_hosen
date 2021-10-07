<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Astri Hosen GmbH</title>
    <style rel="stylesheet" type="text/css">
        @import "../css/bootstrap.min.css";
        @import "../css/astri_hosen_style.css";
        @import "../css/templatemo-style.css";
    </style>

    <link rel="icon" type="image/png" href="../img/favicon.png">
</head>


<body>
<?php
session_start();
require_once "../model/Mitarbeiter.php";
require_once "../model/Produkt.php";
require_once "Secruity/management_system.php";
authenticate_mitarbeiter();

?>
<!-- Sidebar Menu -->
<div class="responsive-nav">
    <i class="fa fa-bars" id="menu-toggle"></i>
    <div id="menu" class="menu">
        <i class="fa fa-times" id="menu-close"></i>
        <div class="container">
            <div class="image">
                <a href="#"><img src="../img/astri_logo.png" alt="" /></a>
            </div>
            <div class="author-content">
                <h4>Astri Hosen GmBH</h4>
                <?php
                $c = Mitarbeiter::get($_SESSION['userid_mitarbeiter']);
                echo "<b style='color: green'>".$c->getMitarbeiterVorname()." ".$c->getMitarbeiterNachname()."</b>";
                ?>
                <span></span>
            </div>
            <nav class="main-nav" role="navigation">
                <ul class="main-menu">
                    <li><a href="mitarbeiter_übersicht.php">Produkte</a></li>

                </ul>
            </nav>

            <br>
            <br>

            <a href="Secruity/management_abmelden.php"><button type="button" name="button" onclick="" class="form-control btn btn-danger" style="border: 1px solid black; background-color: red">Abmelden</button></a></div>


    </div>
</div>



<br>
<br>
<div class="container table-responsive" style="margin-left: 500px">


    <?php


    $items = Produkt::getAll();
    $text = true;

    foreach ($items as $c) {
        if($c->getProduktMenge() < $c->getProduktMinMenge()){

            $text = false;

        }
    }
    if ($text == true){

        echo "<div class='alert alert-success text-center mt-5'><h3 style='color: black'>Es sind genügend Stück von allen Produkten vorhanden!</h3></div>";

    }
    if ($text == false){

        echo "<div class='alert alert-danger text-center mt-5'> <h3 style='color: black'>Bitte die folgenden Produkte nachbestellen:</h3>";
        echo "<table class='table table-striped border mt-5'>";
        echo "<th>Bezeichnung</th>";
        echo "<th>Verfügbare Menge</th>";
        echo "<th>Bearbeitung</th>";
        foreach ($items as $c) {

            if($c->getProduktMenge()< $c->getProduktMinMenge()) {


                echo "<tr>";
                echo "<td>" . $c->getProduktBez() . "</td>";
                echo "<td>" . $c->getProduktMenge() . " Stück</td>";
                echo "<td><a href='Produkte/lagerstand_anpassen.php?id=". $c->getProduktId()."' ><button class='btn btn-warning'>Lagerstand anpassen</button></a></td>";
                echo "</tr>";

            }
        }
        echo "</table>";
        echo "</div>";
    }

    ?>

    <table class="table table-striped border mt-5">
        <th>Artikelnummer</th>
        <th>Bezeichnung</th>
        <th>Verfügbare Menge</th>
        <th>Preis</th>
        <th>Bearbeitung</th>
        <?php


        foreach ($items as $c) {

                echo "<tr>";
                echo "<td>" . $c->getProduktId(). "</td>";
                echo "<td>" . $c->getProduktBez(). "</td>";
                echo "<td>" . $c->getProduktMenge(). "</td>";
                echo "<td>" . $c->getProduktPreis(). " €</td>";
                echo "<td>";
                echo " <a href='Produkte/view.php?id=". $c->getProduktId()."' ><button class='btn btn-info'>Anzeigen</button></a> ";
                echo " <a href='Produkte/lagerstand_anpassen.php?id=". $c->getProduktId()."' ><button class='btn btn-warning'>Lagerstand anpassen</button></a> ";
                echo " <a href='Produkte/update.php?id=". $c->getProduktId()."' ><button class='btn btn-success'>Ändern</button></a> ";
                echo "</td>";
                echo "</tr>";

        }

        ?>
    </table>


</div>
<br>
<br>
<br>

</body>
</html>