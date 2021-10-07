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


$title = "Der Mitarbeiter <b>'".$item->getMitarbeiterNachname()." ".$item->getMitarbeiterVorname()."'</b> wird angezeigt.";

?>

<br>
<div class="container" style="margin-left: 400px">
    <div class="row">
        <h2><?= $title ?></h2>
    </div>
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
    <p>Diese Person wurde am <b><?=$item->getMitarbeiterDatum(); ?></b> hinzugefügt.</p>
<br>
        <div class="form-group" style="margin: 0px auto">
            <a class="btn form-group btn-warning" href="<?=$_SERVER['HTTP_REFERER']?>">Zurück zur Übersicht</a>
        </div>

</div> <!-- /container -->

</body>

</html>
