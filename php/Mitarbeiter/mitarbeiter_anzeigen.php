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
authenticate_admin();
?>

<div id="page-wraper">
    <div class="responsive-nav">
        <i class="fa fa-bars" id="menu-toggle"></i>
        <div id="menu" class="menu">
            <i class="fa fa-times" id="menu-close"></i>
            <div class="container">
                <div class="image">
                    <a href="#"><img src="../../img/astri_logo.png" alt=""/></a>
                </div>
                <div class="author-content">
                    <h4>Astri Hosen GmBH</h4>
                    <?php
                    $c = Mitarbeiter::get($_SESSION['userid_admin']);
                    echo "<b style='color: red'>" . $c->getMitarbeiterVorname() . " " . $c->getMitarbeiterNachname() . "</b>";
                    ?>
                </div>
                <nav class="main-nav" role="navigation">
                    <ul class="main-menu">
                        <li><a href="../admin_übersicht.php">Produkte</a></li>
                        <li><a href="../Mitarbeiter/mitarbeiter_anzeigen.php" style="background-color: #95999c">Mitarbeiter</a>
                        </li>
                        <li><a href="../Mitarbeiter/create.php">Neuen Mitarbeiter anlegen</a></li>
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
</div>

<div class="container table-responsive" style="margin-left: 52vh">
    <?php
    require_once "../../model/Mitarbeiter.php";
    $items = Mitarbeiter::getAll();

    echo "<div class='alert alert-success text-center mt-5'><h3 style='color: black'>Alle Benutzer sind gepflegt!</h3></div>";
    ?>

    <table class="table table-striped border mt-5">
        <th>Vorname</th>
        <th>Nachname</th>
        <th>Benutzer</th>
        <th>Rolle</th>
        <th style='text-align: center;'>Bearbeiten</th>
        <?php

        foreach ($items as $c) {
            echo "<tr>";
            echo "<td>" . $c->getMitarbeiterVorname() . "</td>";
            echo "<td>" . $c->getMitarbeiterNachname() . "</td>";
            echo "<td>" . $c->getMitarbeiterBenutzername() . "</td>";
            echo "<td>" . $c->getMitarbeiterRole() . "</td>";

            echo "<td  style='text-align: center;'>";

            echo " <a href='view.php?id=" . $c->getMitarbeiterId() . "' ><button class='btn btn-info'>Anzeigen</button></a> ";

            echo " <a href='update.php?id=" . $c->getMitarbeiterId() . "' ><button class='btn btn-success'>Ändern</button></a> ";

            if ($c->getMitarbeiterBenutzername() != "clemens.strigl" && $c->getMitarbeiterBenutzername() != "eva.suitner") {
                echo " <a href='delete.php?id=" . $c->getMitarbeiterId() . "' ><b style='color:black;'>  | </b><button class='btn btn-danger' style=\"border: 1px solid black; background-color: red\">Löschen</button></a> ";
            } else {
                echo " <a href='' ><b style='color:black;'>  | </b><button class='btn btn-dark' style=\"border: 1px solid black; background-color: grey\">Löschen</button></a> ";
            }

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