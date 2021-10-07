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

            $passwort = isset($_POST['passwort']) ? $_POST['passwort'] : '';
            $key = "astri_hosen_key";
            $hash = hash_hmac('sha256', $passwort, $key);
            $mitarbeiter_passwort = base64_encode($hash);
            $item->setMitarbeiterPasswort($mitarbeiter_passwort);
            $item->update();
            header("Location: mitarbeiter_anzeigen.php");






}



$title = "Das Passwort für <b>'".$item->getMitarbeiterVorname()." ".$item->getMitarbeiterNachname()."</b>' wird erneuert.";

?>
<br>
<div class="container">
    <div class="row">
        <h2><?= $title ?></h2>
    </div>
    <br>
    <form class="form-horizontal" action="update_passwort.php?id=<?=$item->getMitarbeiterId();?>" method="post">
<br>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label"><b>Vorname:</b></label>
                    <input type="text" class="form-control" name="vorname" maxlength="4" value="<?=$item->getMitarbeiterVorname();?>" readonly>
                </div>
            </div>


            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="form-group required ">
                    <label class="control-label"><b>Nachname:</b></label>
                    <input type="text" class="form-control" name="nachname" maxlength="64" value="<?=$item->getMitarbeiterNachname();?>" readonly>
                </div>
            </div>
            <div class="col-md-5"></div>
        </div>


        <div class="row">
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label"><b>Benutzername:</b></label>
                    <input type="text" class="form-control" name="benutzername" min="1" value="<?=$item->getMitarbeiterBenutzername();?>" readonly>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label"><b>Rolle:</b></label>
                    <input type="text" class="form-control" name="rolle" value="<?=$item->getMitarbeiterRole();?>" readonly>
                </div>
            </div>

        </div>
        <br>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group required">
                    <label class="control-label"><b>Geben Sie das neue Passwort hier ein:</b></label>
                    <input type="password" class="form-control" name="passwort" value="" required>
                    <p>Klicken Sie allerdings nur auf "<u>Aktualisieren</u>", wenn Sie sich sicher sind.</p>

                </div>
            </div>
        <br>
        </div>

        <div class="form-group">
            <br>
            <br>
            <button type="submit" name="submit" class="btn form-group btn-primary">Aktualisieren</button>

            <?php

            echo " <a class=\"btn form-group btn-warning\" style='color: black' href='update.php?id=". $item->getMitarbeiterId()."' > Zurück </a> ";


            ?>
        </div>

    </form>

</div>

</body>

</html>
