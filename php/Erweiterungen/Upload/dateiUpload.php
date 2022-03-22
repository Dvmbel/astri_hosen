<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Astri Hosen GmbH</title>

    <style rel="stylesheet" type="text/css">
        @import "../../../css/bootstrap-4.3.1-dist/css/bootstrap.css";
        @import "../../../css/astri_hosen_style.css";
        @import "../../../css/templatemo-style.css";
    </style>

    <link rel="icon" type="image/png" href="../../../img/favicon.png">

</head>

<body>
<?php
require_once "../../../model/Produkt.php";
require_once "../../Security/management_system.php";
require_once "../../Security/fileUploadScript.php";
require_once "../../../model/Mitarbeiter.php";
authenticate_mitarbeiter();

if (isset($_GET["erstellungEinesProduktes"])){
    $bearbeitungWahr = $_GET["erstellungEinesProduktes"];
}

if (isset($_POST['submit'])) {

    UploadAnImage();

    if (isset($_SESSION['upgeloadetesElement']) && isset($_POST['bildDirektVerwenden'])){
        header("Location: ../../Produkte/create.php");
    }
}
?>

<div class="responsive-nav">
    <i class="fa fa-bars" id="menu-toggle"></i>
    <div id="menu" class="menu">
        <i class="fa fa-times" id="menu-close"></i>
        <div class="container">
            <div class="image">
                <a href="#"><img src="../../../img/astri_logo.png"/></a>
            </div>
            <div class="author-content">
                <h4>Astri Hosen GmBH</h4>
                <?php
                echo $_SESSION['userid_anzeige'];
                ?>
            </div>
            <nav class="main-nav" role="navigation">
                <ul class="main-menu">
                    <?php
                    if (isset($_SESSION['userid_admin']) != NULL) {
                        echo "<li><a href='../../admin_übersicht.php'>Produkte</a></li>";
                        echo "<li><a href='../../Mitarbeiter/mitarbeiter_anzeigen.php'>Mitarbeiter</a></li>";
                        echo "<li><a href='../../Mitarbeiter/create.php'>Neuen Mitarbeiter anlegen</a></li>";
                    } else {
                        echo "<li><a href='../../mitarbeiter_übersicht.php'>Produkte</a></li>";

                    }

                    if (isset($_GET["erstellungEinesProduktes"])){
                        echo "<li><a href='../../Produkte/create.php' style='background-color: #95999c'>Neues Produkt anlegen </li></a>";
                        echo "<li><a href='../erweiterungen_übersicht.php'>Erweiterungen</a></li>";
                    } else{
                        echo "<li><a href='../../Produkte/create.php'>Neues Produkt anlegen </li></a>";
                        echo "<li><a href='../erweiterungen_übersicht.php' style='background-color: #95999c'>Erweiterungen</a></li>";
                    }
                    ?>
                </ul>
            </nav>
            <a href="../../Security/management_abmelden.php">
                <button type="button" name="button" onclick="" class="form-control btn btn-danger" style="border: 1px solid black; background-color: red">Abmelden</button>
            </a>
        </div>
    </div>
</div>
<br>
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

    if (isset($_SESSION['status-bad'])) {
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <b><?= $_SESSION['status-bad']; ?></b>
        </div>
        <?php
        unset($_SESSION['status-bad']);
    }
    ?>
    <div class="row">
        <h1 style="font-size: xx-large ; color: black ; margin-left: 50px"><b>Bild Upload</b></h1>
    </div>
    <br>

    <form action="dateiUpload.php" method="post" enctype="multipart/form-data">
        <b style="color: black; margin-left: 38px">Wählen Sie eine Datei aus:</b><br>
        <input type="file" name="DateiZumHochladen" id="DateiZumHochladen" style="color: blue; margin-left: 38px" required>
        <br><br>

        <p style="color: black; margin-left: 38px">Die Datei darf nicht größer als <b>40MB</b> sein. <br> <b>JPG</b>, <b>PNG</b>, <b>JPEG</b>, <b>BMP</b>  oder auch <b>Gifs</b> sind erlaubt.</p>

        <?php
        if (isset($_GET["erstellungEinesProduktes"])){
            echo "<input style='color: black; margin-left: 38px' type='checkbox' id='bildDirektVerwenden' name='bildDirektVerwenden' checked> <b style='color: red'>Produkt mit Bild erstellen.</b>";

        } else{
            echo "<input style='color: black; margin-left: 38px' type='checkbox' id='bildDirektVerwenden' name='bildDirektVerwenden'> <b style='color: red'>Produkt mit Bild erstellen.</b>";

        }
        ?>
        <br>
        <br>
        <br>

        <?php

        if (isset($_GET['erstellungEinesProduktes'])) {
            echo "<a href='erhalteneUploads.php?erstellungEinesProduktes=true'><p style='color: black; margin-left: 38px'>Klicken Sie hier, um bereits hochgeladene Elemente anzuzeigen.</p></a>";

        } else {
            echo "<a href='erhalteneUploads.php'><p style='color: black; margin-left: 38px'>Klicken Sie hier, um bereits hochgeladene Elemente anzuzeigen.</p></a>";

        }
        ?>

        <div class="form-group" style="color: black; margin-left: 30px">
            <input type="submit" name="submit" class="btn btn-primary" value="Datei Upload">
            <?php

            if (isset($_GET['erstellungEinesProduktes'])) {
                echo "<a class='btn btn-warning' href='../../Produkte/create.php' style='margin-left: 5vh'>Zurück zur Erstellung</a>";

            } else {
                echo "<a class='btn btn-warning' href='../erweiterungen_übersicht.php' style='margin-left: 5vh'>Zurück zur Übersicht</a>";

            }
            ?>
        </div>
    </form>

    <br>
</div>
</body>
</html>