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
if (isset($_POST['submit'])) {

    $item->delete($id);
    header("Location: mitarbeiter_anzeigen.php");

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
    <h2>Der Mitarbeiter <b>'<?= $item->getMitarbeiterNachname() . " " . $item->getMitarbeiterVorname() ?>'</b> wird gelöscht.</h2>
    <form class="form-horizontal" action="delete.php?id=<?= $item->getMitarbeiterId(); ?>" method="post">
        <table class="table table-striped table-bordered detail-view">
            <br>

            <tbody>
            <tr>
                <th>Vorname:</th>
                <td><?= $item->getMitarbeiterVorname(); ?></td>
            </tr>
            <tr>
                <th>Nachname:</th>
                <td><?= $item->getMitarbeiterNachname(); ?></td>
            </tr>
            <tr>
                <th>Benutzername:</th>
                <td><?= $item->getMitarbeiterBenutzername(); ?></td>
            </tr>
            <tr>
                <th>Mitarbeiter Erstelldatum:</th>
                <td><?= $mysqldate; ?></td>
            </tr>
            <tr>
                <th>Rolle:</th>
                <td><?= $item->getMitarbeiterRole(); ?></td>
            </tr>
            </tbody>

        </table>

        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-danger">Löschen</button>
            <a class="btn btn-warning" href="<?= $_SERVER['HTTP_REFERER'] ?>" style="margin-left: 15%">Zurück zur Übersicht</a>
        </div>
    </form>
    <br>
</div>
</body>
</html>


