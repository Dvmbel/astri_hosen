<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Astri Hosen GmbH</title>
    <style rel="stylesheet" type="text/css">
        @import "../../css/bootstrap.min.css";
        @import "../../css/astri_hosen_style.css";
        @import "../../css/templatemo-style.css";
    </style>

    <link rel="icon" type="image/png" href="../../img/favicon.png">
</head>
<body>

<?php
session_start();
require_once "../../model/Produkt.php";
require_once "../Secruity/management_system.php";
require_once "../../model/Mitarbeiter.php";
include "../Secruity/management_passwort.php";
authenticate_admin();



if (isset($_POST['submit'])) {
    $benutzername = isset($_POST['benutzername']) ? $_POST['benutzername'] : '';
    $vorname = isset($_POST['vorname']) ? $_POST['vorname'] : '';
    $nachname = isset($_POST['nachname']) ? $_POST['nachname'] : '';
    $passwort = isset($_POST['passwort']) ? $_POST['passwort'] : '';
    $rolle = isset($_POST['rolle']) ? $_POST['rolle'] : '';
    $date = date(DATE_ATOM);
    $item = new Mitarbeiter();


    $passwort = isset($_POST['passwort']) ? $_POST['passwort'] : '';
    passwort_verschlüsseln($passwort);
    $item->setMitarbeiterPasswort($_SESSION['passwort_hash']);


    $item->setMitarbeiterVorname($vorname);
    $item->setMitarbeiterNachname($nachname);
    $item->setMitarbeiterBenutzername($benutzername);
    $item->setMitarbeiterDatum($date);
    $item->setMitarbeiterRole($rolle);
    $item->create();

    header("Location: mitarbeiter_anzeigen.php");

}

?>

<div id="page-wraper">
    <!-- Sidebar Menu -->
    <div class="responsive-nav">
        <i class="fa fa-bars" id="menu-toggle"></i>
        <div id="menu" class="menu">
            <i class="fa fa-times" id="menu-close"></i>
            <div class="container">
                <div class="image">
                    <a href="#"><img src="../../img/astri_logo.png" alt="" /></a>
                </div>
                <div class="author-content">
                    <h4>Astri Hosen GmBH</h4>
                    <span></span>
                </div>
                <nav class="main-nav" role="navigation">
                    <ul class="main-menu">
                        <li><a href="../admin_übersicht.php">Produkte</a></li>
                        <li><a href="../Mitarbeiter/mitarbeiter_anzeigen.php">Mitarbeiter</a></li>
                        <li><a href="../Mitarbeiter/create.php" style="background-color: #95999c">Neuen Mitarbeiter anlegen</a></li>
                        <li><a href="../Produkte/create.php">Neues Produkt anlegen</a></li>
                    </ul>
                </nav>

                <br>
                <br>

                <a href="../Secruity/management_abmelden.php"><button type="button" name="button" onclick="" class="form-control btn btn-danger" style="border: 1px solid black; background-color: red">Abmelden</button></a></div>


        </div>
    </div>
</div>
<br>
<br>
<div class="container" style="background-color: gray ; margin-left: 500px" >
    <br>

    <div class="row">
        <h1 style="font-size: xx-large ; color: white ; margin-left: 50px"  ><b>Einen Mitarbeiter hinzufügen</b></h1>
    </div>
    <br>
    <p style="margin-left: 38px">Im folgendem Schritt können Sie einen Mitarbeiter hinzufügen.</p>
    <br>

    <form class="form-horizontal" action="create.php" method="post">

        <div class="row" style="color: white ; margin-left: 25px">
            <div class="col-md-2" style="color: white">
                <div class="form-group required ">
                    <label class="control-label"><b>Vorname:</b></label>
                    <input type="text" class="form-control" name="vorname" maxlength="20" required>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="form-group required ">
                    <label class="control-label"><b>Nachname:</b></label>
                    <input type="text" class="form-control" name="nachname" maxlength="20" required>
                </div>
            </div>
            <div class="col-md-5"></div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group required " style="margin-left: 30px">
                    <label class="control-label"><b>Benutzername:</b></label>
                    <input type="text" class="form-control" name="benutzername" maxlength="20" required>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <div class="form-group required " style="margin-left: ">
                    <label class="control-label"><b>Passwort:</b></label>
                    <input type="password" class="form-control" name="passwort" maxlength="20" required>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label"><b>Rolle:</b></label>
                    <select name="rolle" id="rolle" class="custom-select">
                        <option value="admin">Admin</option>
                        <option value="mitarbeiter">Mitarbeiter</option>
                        <option value="viewer">Beobachter</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="form-group">
        </div>
        <br>
        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary">Mitarbeiter hinzufügen</button>
            <a class="btn btn-warning" href="<?=$_SERVER['HTTP_REFERER']?>" style="margin-left: 8%">Zurück zur Übersicht</a>
            <br>
            <br>

        </div>

</div> <!-- /container -->

</body>

</html>

