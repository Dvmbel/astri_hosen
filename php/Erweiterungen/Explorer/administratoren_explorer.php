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
authenticate_admin();


$sucheErfolgreich = false;
if(isset($_GET["search"])){

    $sucheErfolgreich = true;

}
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
    <br>
    <h1 style="text-align: left; color: red"><b>Administratoren Explorer</b></h1>
    <br>
    <table class="table table-striped border" style="text-align: center">
        <tr>
            <th style="text-align: center; background-color: darkred"><h4></h4></th>
        </tr>
        <tr>
        <form method="get">
            <td style="text-align: center; background-color: #c82333"><input type="text" class="form-control" name="search" placeholder="Nach was suchen Sie?" maxlength="255"></td>
        </form>
        </tr>
    </table>
    <?php

    if ($sucheErfolgreich == true){
        echo "Die Suche funktioniert aktuell noch nicht.";
    }

    ?>
    <br>
    <br>
</body>
</html>