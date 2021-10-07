<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Astri Hosen GmbH</title>
    <style rel="stylesheet" type="text/css">
        @import "../../css/bootstrap.min.css";
        @import "../../css/astri_hosen_style.css";
    </style>

    <link rel="icon" type="image/png" href="../../img/favicon.png">
</head>
<body>

<?php
session_start();
require_once "../../model/Produkt.php";
require_once "../Secruity/management_system.php";
require_once "../../model/Mitarbeiter.php";
authenticate_admin();



$id = $_GET["id"];
$item = Mitarbeiter::get($id);


if (isset($_POST['submit'])) {


    $Mitarbeiter_Vorname = isset($_POST['vorname']) ? $_POST['vorname'] : '';
    $Mitarbeiter_Nachname = isset($_POST['nachname']) ? $_POST['nachname'] : '';
    $Mitarbeiter_Benutzername = isset($_POST['benutzername']) ? $_POST['benutzername'] : '';
    $Mitarbeiter_Rolle = isset($_POST['rolle']) ? $_POST['rolle'] : '';
    $item->setMitarbeiterVorname($Mitarbeiter_Vorname);
    $item->setMitarbeiterNachname($Mitarbeiter_Nachname);
    $item->setMitarbeiterBenutzername($Mitarbeiter_Benutzername);
    $item->setMitarbeiterRole($Mitarbeiter_Rolle);
    $item->update();


    header("Location: mitarbeiter_anzeigen.php");


}

$title = "Der Mitarbeiter <b>'".$item->getMitarbeiterVorname()." ".$item->getMitarbeiterNachname()."</b>' wird überarbeitet.";


?>
<br>
<div class="container">
    <div class="row">
        <h2><?= $title ?></h2>
    </div>
<br>
    <form class="form-horizontal" action="update.php?id=<?=$item->getMitarbeiterId();?>" method="post">

        <div class="row">
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label"><b>Vorname:</b></label>
                    <input type="text" class="form-control" name="vorname" maxlength="64" value="<?=$item->getMitarbeiterVorname();?>">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="form-group required ">
                    <label class="control-label"><b>Nachname:</b></label>
                    <input type="text" class="form-control" name="nachname" maxlength="64" value="<?=$item->getMitarbeiterNachname();?>">
                </div>
            </div>
            <div class="col-md-5"></div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label"><b>Benutzername:</b></label>
                    <input type="text" class="form-control" name="benutzername" min="1" value="<?=$item->getMitarbeiterBenutzername();?>">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <div class="form-group required ">
                    <label class="control-label"><b>Mitarbeiter Rolle:</b></label>
                    <input type="text" class="form-control" name="rolle" value="<?=$item->getMitarbeiterRole();?>">
                </div>
            </div>



        </div>

        <?php

         echo " <a href='update_passwort.php?id=". $item->getMitarbeiterId()."' >Klicken Sie hier, um das Passwort zu ändern.</a> ";



        ?>

        <div class="form-group">


            <br>

            <br>


            <button type="submit" name="submit" class="btn form-group btn-primary">Aktualisieren</button>
            <a class="btn form-group btn-warning" href="mitarbeiter_anzeigen.php" style="margin-left: 15%">Zurück zur Übersicht</a>
        </div>
    </form>

</div> <!-- /container -->

</body>

</html>
