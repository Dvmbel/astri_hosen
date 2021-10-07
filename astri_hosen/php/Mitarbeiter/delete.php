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

$title = "Produkt löschen";



$id = $_GET["id"];
$item = Mitarbeiter::get($id);
if (isset($_POST['submit'])) {



    $item->delete($id);
    header("Location: mitarbeiter_anzeigen.php");

}

$title = "Der Mitarbeiter <b>'".$item->getMitarbeiterNachname()." ".$item->getMitarbeiterVorname()."'</b> wird gelöscht.";


?>
<br>
<div class="container">
    <h2><?= $title ?></h2>
    <form class="form-horizontal" action="delete.php?id=<?=$item->getMitarbeiterId();?>" method="post">
    <table class="table table-striped table-bordered detail-view">
        <br>
        <tbody>
        <tr>
            <th>Vorname:</th>
            <td><?= $item->getMitarbeiterVorname();?></td>
        </tr>
        <tr>
            <th>Nachname:</th>
            <td><?= $item->getMitarbeiterNachname();?></td>
        </tr>
        <tr>
            <th>Benutzername:</th>
            <td><?= $item->getMitarbeiterBenutzername();?></td>
        </tr>
        <tr>
            <th>Rolle:</th>
            <td><?= $item->getMitarbeiterRole();?></td>
        </tr>



        </tbody>
    </table>
        <br>

    <div class="form-group">
        <button type="submit" name="submit" class="btn btn-danger">Löschen</button>
        <a class="btn btn-warning" href="<?=$_SERVER['HTTP_REFERER']?>" style="margin-left: 52%">Zurück zur Übersicht</a>
    </div>
    </form>
</div> <!-- /container -->

</body>

</html>


