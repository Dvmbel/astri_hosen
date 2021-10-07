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
authenticate_mitarbeiter();

$id = $_GET["id"];
$item = Produkt::get($id);
if (isset($_POST['submit'])) {



    $item->delete($id);
    if(isset($_SESSION['userid_admin'])) {
        header("Location: ../admin_übersicht.php");

    } elseif (isset($_SESSION['userid_mitarbeiter'])) {
        header("Location: ../mitarbeiter_übersicht.php");
    }

}

$title = "Das Produkt <b>'".$item->getProduktBez()."' </b> wird gelöscht.";

if ($item->getProduktBild() == NULL){
    $hintergrund = "../../img/keine_hose_vorhanden.png";
} else{
    $hintergrund = $item->getProduktBild();
}

?>
<style>
    body {
        background-image: url("<?=$hintergrund?>");
        background-position-y: 100px;
        background-repeat: no-repeat;
        background-size: 20%;
    }
</style>
<br>
<div class="container">
    <h2><?= $title ?></h2>
    <form class="form-horizontal" action="delete.php?id=<?=$item->getProduktId();?>" method="post">
    <table class="table table-striped table-bordered detail-view">
        <br>
        <tbody>
        <tr>
            <th>Artikelnummer:</th>
            <td><?= $item->getProduktId();?></td>
        </tr>
        <tr>
            <th>Produkt Bezeichnung:</th>
            <td><?= $item->getProduktBez();?></td>
        </tr>
        <tr>

            <?php

            if ($item->getProduktMenge()==0){
                echo "<th>Restlicher Lagerbestand:</th>";
                echo "<td style='color: black'><b>".$item->getProduktMenge()." Stücke</b></td>";
            } else{

                echo "<th>Restlicher Lagerbestand:</th>";
                echo "<td style='color: red'><b>".$item->getProduktMenge()." Stücke</b></td>";
            }

            ?>
        </tr>
        <tr>
            <th>Mindest Menge:</th>
            <td><?= $item->getProduktMinMenge();?> Stück</td>
        </tr>
        <tr>
            <th>Produkt Preis:</th>
            <td><?= $item->getProduktPreis();?> €</td>
        </tr>
        <tr>
            <th>Produkt Beschreibung:</th>
            <td><?= $item->getProduktBeschreibung();?></td>
        </tr>
        <tr>
            <th>Produkt Erstelldatum:</th>
            <td style="color: black"><b><?= $item->getProduktDatum();?></b></td>
        </tr>
        <th>
            <button type="submit" name="submit" class="btn btn-danger">Löschen</button></th>
        <th>
            <a class="btn btn-warning" href="<?=$_SERVER['HTTP_REFERER']?>">Zurück zur Übersicht</a></th>
        </tbody>
    </table>
        <br>

    <div class="form-group">
    </div>
    </form>
</div> <!-- /container -->

</body>

</html>


