<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Astri Hosen GmbH</title>

    <style rel="stylesheet" type="text/css">
        @import "../../../css/astri_hosen_style.css";
        @import "../../../css/bootstrap-4.3.1-dist/css/bootstrap.css";
        @import "../../../css/templatemo-style.css";

        .grid-container {
            display: inline-grid;
            grid-template-columns: auto auto auto;
            background-color: white;
        }
        .box {
            float: left;
            margin: 0px;
            padding-left: 2px;
        }

    </style>

    <link rel="icon" type="image/png" href="../../../img/favicon.png">

</head>

<body>
<?php
require_once "../../../model/Produkt.php";
require_once "../../Security/management_system.php";
require_once "../../Security/fileDeleteScript.php";
require_once "../../../model/Mitarbeiter.php";
authenticate_mitarbeiter();

$elemente = 0;

if (isset($_GET["erstellungEinesProduktes"])){
    $bearbeitungWahr = $_GET["erstellungEinesProduktes"];
}

if (isset($_POST['verwenden'])) {
    $_SESSION['upgeloadetesElement'] = $_POST['verwenden'];
    header("Location: ../../Produkte/create.php");
}

if (isset($_POST['löschen'])) {
    deleteAnImage($_POST['löschen']);
    header("Refresh:1");
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
            <a href="../../Security/management_abmelden.php"><button type="button" name="button" onclick="" class="form-control btn btn-danger" style="border: 1px solid black; background-color: red">Abmelden</button></a>
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
        <h1 style="font-size: xx-large ; color: black ; margin-left: 40px"><b>Upgeloadete Elemente</b></h1>
    </div>
    <form action="erhalteneUploads.php" method="post" style="margin-left: 30px">
        <?php

        $files = glob('../../../Bilder/*.{jpg,png,jpeg,bmp,gif}', GLOB_BRACE);
        if (empty($files)){
            echo "<br>";
            echo "<button class='btn btn-danger' style='align-content: center'>Es wurden keine Elemente gefunden.</button>";

        } else{
            echo "<p style='color: black'>Hier sehen Sie alle upgeloadeten Elemente.</p>";

        }

        foreach($files as $file) {
        ?>
            <br>
            <h4 style="color: black; ">Element <?php echo $elemente += 1; ?></h4>
            <div class="grid-container">
            <div class="box">

                <img src="<?php echo $file; ?>" alt="<?php echo $file; ?>" style="width: 150px; height: 200px;border: 1px solid black; display: inline">

            </div>
            <div class="box">
                <b style='color: black'>Dateiname: <b style="color: blue"><?php echo basename($file);; ?></b></b>
                <?php
                $produktBildInVerwendung = false;
                $produktBild = Produkt::getAll();
                foreach ($produktBild as $p) {
                    if ($p->getProduktBild() == "../../Bilder/".basename($file)) {
                        $produktBildInVerwendung = true;
                        $p->getProduktBez();
                    }
                }

                if ($produktBildInVerwendung == true){
                    echo "<b style='color: darkgreen; margin-left: 5px'><br>Datei wird aktuell beim Produkt '<u>".$p->getProduktBez()."</u>' verwendet.</b>";

                } else {
                    echo "<b style='color: red; margin-left: 5px'><br>Datei wird nicht verwendet.</b><br>";
                    echo "<div class='box' style='margin-top: 115px; float: left'>";
                    echo "<button type='submit' name='verwenden' class='btn btn-outline-success' value='".basename($file)."'><b>Datei verwenden</b></button>"." | "."<button type='submit' name='löschen' class='btn btn-outline-danger' value='".basename($file)."'>Datei löschen</button>";
                    echo "</div>";
                }

                ?>
            <br>
            </div>
          </div>
        <?php
        echo "<br>";
        } //hier endet die Foreach Schleife
        ?>
        <br>
        <br>
    </form>
    <div class="form-group" style="color: black; margin-left: 30px; margin-top: 50px">
        <?php

        if (isset($_GET['erstellungEinesProduktes'])) {
            echo "<a class='btn btn-warning' href='dateiUpload.php?erstellungEinesProduktes=true'>Zurück zum Upload</a>";

        } else {
            echo "<a class='btn btn-warning' href='../erweiterungen_übersicht.php'>Zurück zur Übersicht</a>";

        }
        ?>
    </div>
    <br>
</div>
</body>
</html>