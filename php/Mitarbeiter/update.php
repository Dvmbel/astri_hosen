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

<script type="text/javascript">
    window.oninput = function () {
        var vorname = document.getElementById("vorname").value.toLowerCase();
        var nachname = document.getElementById("nachname").value.toLowerCase();
        document.getElementById('benutzername').value = vorname + "." + nachname;
    }
</script>

<?php
require_once "../../model/Produkt.php";
require_once "../Security/management_system.php";
require_once "../../model/Mitarbeiter.php";
authenticate_admin();

$id = $_GET["id"];
$item = Mitarbeiter::get($id);

if (isset($_POST['submit'])) {

    $vorname = isset($_POST['vorname']) ? $_POST['vorname'] : '';
    $nachname = isset($_POST['nachname']) ? $_POST['nachname'] : '';

    $benutzername = $vorname . "." . $nachname;
    $benutzername = strtolower($benutzername);

    $rolle = isset($_POST['rolle']) ? $_POST['rolle'] : '';
    $item->setMitarbeiterVorname($vorname);
    $item->setMitarbeiterNachname($nachname);
    $item->setMitarbeiterBenutzername($benutzername);
    $item->setMitarbeiterRole($rolle);
    $item->update();

    $_SESSION['status-good'] = "'" . $item->getMitarbeiterVorname() . " " . $item->getMitarbeiterNachname() . "' wurde erfolgreich bearbeitet.";
}

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
    <?php
    if (isset($_SESSION['status-good'])) {
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <b><?= $_SESSION['status-good']; ?></b>
        </div>
        <?php
        unset($_SESSION['status-good']);
    }
    ?>

    <div class="row">
        <h2 style="margin-left: 15px">Der Mitarbeiter <b>'<?= $item->getMitarbeiterVorname() . " " . $item->getMitarbeiterNachname() ?>'</b> wird überarbeitet.</h2>
    </div>
    <br>
    <form class="form-horizontal" action="update.php?id=<?= $item->getMitarbeiterId(); ?>" method="post">

        <div class="row">

            <div class="col-md-4">
                <div class="form-group required ">
                    <label class="control-label" style="color: black"><b>Vorname:</b></label>
                    <input type="text" class="form-control" name="vorname" maxlength="64" id="vorname" value="<?= $item->getMitarbeiterVorname(); ?>" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group required ">
                    <label class="control-label" style="color: black"><b>Nachname:</b></label>
                    <input type="text" class="form-control" name="nachname" maxlength="64" id="nachname" value="<?= $item->getMitarbeiterNachname(); ?>" required>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-4">
                <div class="form-group required ">
                    <label class="control-label" style="color: black"><b>Benutzername:</b></label>
                    <input type="text" class="form-control" name="benutzername" min="1" id="benutzername" value="<?= $item->getMitarbeiterBenutzername(); ?>" readonly>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group required ">
                    <label class="control-label" style="color: black"><b>Rolle:</b></label>
                    <select name="rolle" id="rolle" class="custom-select">
                        <option value="<?= $item->getMitarbeiterRole() ?>"><?= $item->getMitarbeiterRole() ?></option>
                        <?php

                        if ($item->getMitarbeiterRole() == "admin"){
                            echo "<option value='mitarbeiter'>mitarbeiter</option>";
                        } else{
                            echo "<option value='admin'>admin</option>";
                        }

                        ?>

                    </select>
                </div>
            </div>
        </div>
        <p style="color: black">Diese Person wurde am <b><?= $mysqldate; ?></b> hinzugefügt.</p>
        <br>
        <?php
        echo " <a href='update_passwort.php?id=" . $item->getMitarbeiterId() . "' >Klicken Sie hier, um das Passwort zu ändern.</a> ";
        ?>

        <div class="form-group">
            <br>
            <br>
            <?php

            if ($item->getMitarbeiterBenutzername() == "clemens.strigl" || $item->getMitarbeiterBenutzername() == "eva.suitner") {
                echo "<button class='btn form-group btn-dark' style='background-color: grey'>Aktualisieren</button>";

            } else {
                echo "<button type='submit' name='submit' class='btn form-group btn-primary'>Aktualisieren</button>";
            }

            ?>

            <a class="btn form-group btn-warning" href="mitarbeiter_anzeigen.php" style="margin-left: 15%">Zurück zur Übersicht</a>
        </div>
    </form>
</div>
</body>
</html>