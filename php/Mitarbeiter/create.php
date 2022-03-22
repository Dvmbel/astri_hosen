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
include "../Security/management_passwort.php";
authenticate_admin();

$vorname = "";
$nachname = "";
$benutzername = "";
$passwort = "";
$benutzernamenzusatz = "";
$benutzernameBereitsVergeben = false;

$items = Mitarbeiter::getAll();
if (isset($_POST['submit'])) {
    $vorname = isset($_POST['vorname']) ? $_POST['vorname'] : '';
    $nachname = isset($_POST['nachname']) ? $_POST['nachname'] : '';

    $benutzername = $vorname . "." . $nachname;
    $benutzername = strtolower($benutzername);
    foreach ($items as $c) {
        if ($c->getMitarbeiterBenutzername() == $benutzername) {
            $benutzernameBereitsVergeben = true;
        }
    }

    if ($benutzernameBereitsVergeben == false) {
        finish();
    }
}

function finish()
{
    $vorname = isset($_POST['vorname']) ? $_POST['vorname'] : '';
    $nachname = isset($_POST['nachname']) ? $_POST['nachname'] : '';
    $benutzername = $vorname . "." . $nachname;
    $benutzername = strtolower($benutzername);

    $rolle = isset($_POST['rolle']) ? $_POST['rolle'] : '';
    $date = date(DATE_ATOM);
    $item = new Mitarbeiter();


    $passwort = isset($_POST['passwort']) ? $_POST['passwort'] : '';
    passwort_verschlüsseln($passwort);

    $item->setMitarbeiterPasswort($_SESSION['passwort_hash']);
    $item->setMitarbeiterVorname($vorname);
    $item->setMitarbeiterNachname($nachname);
    $item->setMitarbeiterBenutzername($benutzername);
    $item->setMitarbeiterPasswort($passwort);
    $item->setMitarbeiterDatum($date);
    $item->setMitarbeiterRole($rolle);
    $item->create();

    $_SESSION['status-good'] = $vorname . " " . $nachname . " wurde erfolgreich hinzugefügt.";
}

if (isset($_POST['benutzernamenZusatz'])) {
    $vorname = isset($_POST['vorname']) ? $_POST['vorname'] : '';
    $nachname = isset($_POST['nachname']) ? $_POST['nachname'] : '';
    $benutzernamenZusatz = isset($_POST['benutzernamenZusatz']) ? $_POST['benutzernamenZusatz'] : '';
    $benutzername = $vorname . "." . $nachname . "." . $benutzernamenZusatz;
    $benutzername = strtolower($benutzername);

    $rolle = isset($_POST['rolle']) ? $_POST['rolle'] : '';
    $date = date(DATE_ATOM);
    $item = new Mitarbeiter();

    $passwort = isset($_POST['passwort']) ? $_POST['passwort'] : '';
    passwort_verschlüsseln($passwort);

    $item->setMitarbeiterPasswort($_SESSION['passwort_hash']);
    $item->setMitarbeiterVorname($vorname);
    $item->setMitarbeiterNachname($nachname);
    $item->setMitarbeiterBenutzername($benutzername);
    $item->setMitarbeiterPasswort($passwort);
    $item->setMitarbeiterDatum($date);
    $item->setMitarbeiterRole($rolle);
    $item->create();

    $_SESSION['status-good'] = $vorname . " " . $nachname . " " . $benutzernamenZusatz . " wurde erfolgreich mit Namenszusatz hinzugefügt.";
}
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
                        <li><a href="../Mitarbeiter/mitarbeiter_anzeigen.php">Mitarbeiter</a></li>
                        <li><a href="../Mitarbeiter/create.php" style="background-color: #95999c">Neuen Mitarbeiter
                                anlegen</a></li>
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

    if ($benutzernameBereitsVergeben == true) {
        echo "<div class='alert alert-danger text-center'> <b>Benutzername bereits vergeben!</b><br> Sie müssen einen Benutzernamen Zusatz wählen.</div>";
    }

    ?>

    <div class="row">
        <h1 style="font-size: xx-large ; color: black ; margin-left: 50px"><b>Einen Mitarbeiter hinzufügen</b></h1>
    </div>
    <p style="color: black;margin-left: 38px">Im folgendem Schritt können Sie einen Mitarbeiter hinzufügen.</p>
    <br>

    <form class="form-horizontal" action="create.php" method="post">

        <div class="row" style="color: black">
            <div class="col-md-4" style="color: black; margin-left: 30px">
                <div class="form-group required">
                    <label class="control-label" style="color: black"><b>Vorname:</b></label>
                    <input type="text" class="form-control" name="vorname" id="vorname" maxlength="20"
                           value="<?= $vorname ?>" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group required">
                    <label class="control-label" style="color: black"><b>Nachname:</b></label>
                    <input type="text" class="form-control" name="nachname" id="nachname" maxlength="20"
                           value="<?= $nachname ?>" required>
                </div>
            </div>
        </div>

        <div class="row" style="color: black">
            <div class="col-md-4" style="color: black; margin-left: 30px">
                <div class="form-group required">
                    <label class="control-label" style="color: black"><b>Benutzername:</b></label>
                    <input type="text" class="form-control" name="benutzername" id="benutzername" maxlength="20"
                           value="<?= $benutzername ?>" readonly value="">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group required">
                    <label class="control-label" style="color: black"><b>Passwort:</b></label>
                    <input type="password" class="form-control" name="password" maxlength="20" value="<?= $passwort ?>"
                           required>
                </div>
            </div>

            <div class="col-md-4" style="color: black; margin-left: 30px">
                <div class="form-group required ">
                    <label class="control-label" style="color: black"><b>Rolle:</b></label>
                    <select name="rolle" id="rolle" class="custom-select">
                        <option value="admin">Admin</option>
                        <option value="mitarbeiter">Mitarbeiter</option>
                    </select>
                </div>
            </div>

        </div>
        <br>
        <?php
        if ($benutzernameBereitsVergeben == true) {
            echo "<div class='alert alert-danger text-center'>Wählen Sie einen jeweiligen Zusatz für den Benutzer.<br><b>" . $benutzername . "</b>. <input name='benutzernamenZusatz' required><br></div>";
        }
        ?>

        <div class="form-group" style="color: black; margin-left: 30px">

            <?php
            if ($benutzernameBereitsVergeben == true) {
                echo " <button type='submit' class='btn btn-primary'>Mitarbeiter mit Zusatz Akzeptieren</button>";

            } else {
                echo "<button type='submit' name='submit' class='btn btn-primary'>Mitarbeiter hinzufügen</button>";
            }

            if (isset($_SESSION['userid_admin'])) {
                echo "<a class='btn btn-warning' href='../admin_übersicht.php' style='margin-left: 5vh'>Zurück zur Übersicht</a>";

            } elseif (isset($_SESSION['userid_mitarbeiter'])) {
                echo "<a class='btn btn-warning' href='../mitarbeiter_übersicht.php' style='margin-left: 5vh'>Zurück zur Übersicht</a>";

            }
            ?>

            <br>
            <br>
        </div>
</div>
</form>
</body>
</html>