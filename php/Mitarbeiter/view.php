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

$id = $_GET["id"];
$item = Mitarbeiter::get($id);

$phpdate = strtotime( $item->getMitarbeiterDatum() );
$mysqldate = date( 'j. F Y', $phpdate );
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
                    echo $_SESSION['userid_anzeige'];
                    ?>
                </div>
                <nav class="main-nav" role="navigation">
                    <ul class="main-menu">
                        <li><a href="../admin_übersicht.php">Produkte</a></li>
                        <li><a href="../Mitarbeiter/mitarbeiter_anzeigen.php" style='background-color: #95999c'>Mitarbeiter</a>
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
<br>
<br>
<div class="container" style="background-color: white; margin-left: 52vh; color: black; margin-top: -4.8vh">

    <br>
    <div class="row">
        <h2 style="margin-left:15px ">Der Mitarbeiter <b>'<?= $item->getMitarbeiterNachname() . " " . $item->getMitarbeiterVorname() ?>'</b> wird angezeigt.</h2>
    </div>
    <br>

    <div class="row">

        <div class="col-md-4">
            <div class="form-group required ">
                <label class="control-label" style="color: black"><b>Vorname:</b></label>
                <input type="text" class="form-control" name="vorname" maxlength="4"
                       value="<?= $item->getMitarbeiterVorname(); ?>" readonly>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group required ">
                <label class="control-label" style="color: black"><b>Nachname:</b></label>
                <input type="text" class="form-control" name="nachname" maxlength="64"
                       value="<?= $item->getMitarbeiterNachname(); ?>" readonly>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="form-group required ">
                <label class="control-label" style="color: black"><b>Benutzername:</b></label>
                <input type="text" class="form-control" name="benutzername" min="1"
                       value="<?= $item->getMitarbeiterBenutzername(); ?>" readonly>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group required ">
                <label class="control-label" style="color: black"><b>Rolle:</b></label>
                <input type="text" class="form-control" name="rolle" value="<?= $item->getMitarbeiterRole(); ?>" readonly>
            </div>
        </div>

    </div>
    <br>
    <p style="color: black">Diese Person wurde am <b><?= $mysqldate; ?></b> hinzugefügt.</p>
    <br>
    <div class="form-group" style="margin: 0px auto">
        <a class="btn form-group btn-warning" href="<?= $_SERVER['HTTP_REFERER'] ?>">Zurück zur Übersicht</a>
    </div>
</div>
</body>
</html>
