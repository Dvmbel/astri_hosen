<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Astri Hosen GmbH</title>
    <style rel="stylesheet" type="text/css">
        @import "css/bootstrap.min.css";
        /*@import "css/astri_hosen_style.css";
    </style>

    <link rel="icon" type="image/png" href="img/favicon.png">
</head>


<body>
<br>
<?php
session_start();

require_once "model/Mitarbeiter.php";
require_once "php/Secruity/management_passwort.php";

$falsch = false;
$items = Mitarbeiter::getAll();




if (isset($_POST['submit'])) {

    $benutzername = isset($_POST['benutzername']) ? $_POST['benutzername'] : '';
    $passwort = isset($_POST['passwort']) ? $_POST['passwort'] : '';
    passwort_verschlüsseln($passwort);




    foreach ($items as $c) {
        if ($c->getMitarbeiterBenutzername()==$benutzername & $c->getMitarbeiterPasswort()==$_SESSION['passwort_hash']){



            if ($c->getMitarbeiterRole()=="admin"){

                $_SESSION['userid_admin'] = $c->getMitarbeiterId();
                header("Location: php/admin_übersicht.php");

            } else if ($c->getMitarbeiterRole()=="mitarbeiter"){

                $_SESSION['userid_mitarbeiter'] = $c->getMitarbeiterId();
                header("Location: php/mitarbeiter_übersicht.php");

            }
        }
    }

    $falsch = true;
}

if (isset($_GET['besucherlogin'])) {
    $_SESSION['userid'] = 40;
    header("Location: php/viewer_übersicht.php");
}
?>
<br>
<img src="img/logo.png" style=" display: block;
 margin: auto;
 width: 30%; ">
<div class="container table-responsive">

    <form method="post" action="index.php" id="d">
        <div class="row mt-5" id="d">

            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <label><b>Ihr Benutzername:</b></label>
                <input class="form-control" type="text" name="benutzername" maxlength="50" value="<?= isset($_POST['benutzername']) ? $_POST['benutzername'] : "" ?>" required ><br>
            </div>
            <div class="col-sm-4"></div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <label><b>Ihr Passwort:</b></label>
                <input class="form-control" type="password" name="passwort" maxlength="50" value="<?= isset($_POST['passwort']) ? $_POST['passwort'] : "" ?>" required >


                <?php
                if($falsch == true){
                    echo "<div class='alert alert-danger text-center mt-5'> <b>Ihre Zugangsdaten sind ungültig!</b> <br><br> Bitte wenden Sie sich an einen Adminitrator. </div>";
                }
                ?>


            </div>
            <div class="col-sm-4"></div>
        </div>

        <div class="row mt-5">
            <div class="col sm-4"></div>
            <div class="col sm-4" ><input class="btn btn-primary btn-block" type="submit" name="submit" value="Anmelden" style="border: 1px solid black; background-color: red"></div>
            <div class="col sm-4"></div>
        </div>
        <div class="row mt-5" >
            <div class="col sm-4"></div>
            <div class="col sm-4" style="text-align: center"><a href="index.php?besucherlogin=true">-->Besucherlogin<--</a></div>
            <div class="col sm-4"></div>
        </div>
    </form>
<br>
</div>
</body>