<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Astri Hosen GmbH</title>

    <style rel="stylesheet" type="text/css">
        @import "../css/bootstrap-4.3.1-dist/css/bootstrap.css";
        @import "../css/astri_hosen_style.css";
        @import "../css/templatemo-style.css";
    </style>

    <link rel="icon" type="image/png" href="../img/favicon.png">

</head>

<body>
<?php
require_once "../model/Mitarbeiter.php";
require_once "../model/Produkt.php";
require_once "Security/management_system.php";
$_SESSION['userid'] = 0;
authenticate();
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
                    <li><a href="viewer_übersicht.php" style="background-color: #95999c">Produkte</a></li>

                </ul>
            </nav>
            <a href="Security/management_abmelden.php">
                <button type="button" name="button" onclick="" class="form-control btn btn-danger" style="border: 1px solid black; background-color: red">Anmelden</button>
            </a>
        </div>
    </div>
</div>
<br>
<br>
<div class="container table-responsive" style="margin-left: 50vh">

    <?php
    $items = Produkt::getAll();
    $text = true;

    foreach ($items as $c) {
        if ($c->getProduktMenge() < $c->getProduktMinMenge()) {
            $text = false;
        }
    }

    if ($text == true) {
        echo "<div class='alert alert-success text-center mt-5'><br><h3 style='color: black'>Es sind genügend Stück von allen Produkten vorhanden!</h3></div>";
    }

    if ($text == false) {
        echo "<div class='alert alert-danger text-center mt-5'><br><h3 style='color: black'>Folgende Produkte sind nicht auf Lager:</h3>";
        echo "<table class='table table-striped border mt-5'>";
        echo "<th>Artikelnummer</th>";
        echo "<th>Bezeichnung</th>";


        foreach ($items as $c) {
            if ($c->getProduktMenge() < $c->getProduktMinMenge()) {


                echo "<tr>";
                echo "<td>" . $c->getProduktId() . "</td>";
                echo "<td>" . $c->getProduktBez() . "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
        echo "</div>";
    }
    ?>

    <table class="table table-striped border mt-5" style="text-align: center">
        <th>Artikelnummer</th>
        <th style='text-align: left;'>Bezeichnung</th>
        <th>Preis</th>
        <th>Anzeigen</th>

        <?php
        foreach ($items as $c) {
            echo "<tr>";
            echo "<td>" . $c->getProduktId() . "</td>";
            echo "<td style='text-align: left;'>" . $c->getProduktBez() . "</td>";

            $preis = $c->getProduktPreis();
            echo "<td>" . number_format($preis, 2, ',', '.') . " €</td>";

            echo "<td>";
            echo " <a href='Produkte/view.php?id=" . $c->getProduktId() . "' ><button class='btn btn-info'>Anzeigen</button></a> ";

            echo "</td>";
            echo "</tr>";
        }
        ?>

    </table>
    <br>
</div>
</body>
</html>