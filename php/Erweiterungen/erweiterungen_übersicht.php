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

$items = Produkt::getAll();
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
                        echo "<li><a href='../admin_übersicht.php'>Produkte</a></li>";
                        echo "<li><a href='../Mitarbeiter/mitarbeiter_anzeigen.php'>Mitarbeiter</a></li>";
                        echo "<li><a href='../Mitarbeiter/create.php'>Neuen Mitarbeiter anlegen</a></li>";
                    } else {
                        echo "<li><a href='../mitarbeiter_übersicht.php'>Produkte</a></li>";

                    }
                    ?>
                    <li><a href="../Produkte/create.php">Neues Produkt anlegen</a></li>
                    <li><a href="" style="background-color: #95999c">Erweiterungen</a></li>
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
<div class="container" style="background-color: white; margin-left: 52vh; color: black; margin-top: -4.8vh">
    <br>
    <?php
    if (isset($_SESSION['userid_admin'])) {
        echo "<h1 style='text-align: left; color: red'><b>Funktionale Erweiterungen</b></h1>";

    } elseif (isset($_SESSION['userid_mitarbeiter'])) {
        echo "<h1 style='text-align: left; color: green'><b>Funktionale Erweiterungen</b></h1>";

    }
    ?>
    <br>
    <table class="table table-striped border" style="text-align: center">
        <tr>
            <th><h4  style="text-align: left; color: darkred">Kennzahlenanalyse</h4></th>
        </tr>
        <tr>
            <th style='text-align: left;'><a href="Kennzahlen/kennzahlen.php" style="color: black; margin-left: 10px"> Klicken Sie hier, um die Kennzahlenanalyse aufrufen.</a></th>
        </tr>
    </table>

    <br>
    <table class="table table-striped border" style="text-align: center; margin-top: 10px">
        <tr>
            <th><h4  style="text-align: left; color: darkred">Datei Manager</h4></th>
        </tr>
        <tr>
            <th style='text-align: left;'><a href="Upload/erhalteneUploads.php" style="color: black; margin-left: 10px"> Klicken Sie hier, um alle hochgeladenen Datein aufzurufen.</a></th>
        </tr>
        <tr>
            <th style='text-align: left;'><a href="Upload/dateiUpload.php" style="color: black; margin-left: 10px"> Klicken Sie hier, um eine Datei hochzuladen.</a></th>
        </tr>
    </table>

    <!--
    <br>
    <table class="table table-striped border" style="text-align: center; margin-top: 10px">
        <tr>
            <th><h4  style="text-align: left; color: darkred">Server Explorer</h4></th>
        </tr>
        <tr>
            <?php
            if (isset($_SESSION['userid_admin'])) {
                echo "<th style='text-align: left;'><a href='Explorer/administratoren_explorer.php' style='color: black; margin-left: 10px'> Klicken Sie hier, um die Suche zu starten.</a></th>";

            } elseif (isset($_SESSION['userid_mitarbeiter'])) {
                echo "<th style='text-align: left;'><a href='Explorer/mitarbeiter_explorer.php' style='color: black; margin-left: 10px'> Klicken Sie hier, um die Suche zu starten.</a></th>";

            }
            ?>
        </tr>
    </table>
    -->
    <br>
</body>
</html>


