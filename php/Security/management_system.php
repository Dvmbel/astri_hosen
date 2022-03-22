<?php
session_start();
setlocale (LC_ALL, 'de_DE@euro', 'de_DE', 'de', 'ge');

function authenticate()
{
    if (isset($_SESSION['userid'])) {
        authenticate_viewer();

    } elseif (isset($_SESSION['userid_mitarbeiter'])) {
        authenticate_mitarbeiter();

    } elseif (isset($_SESSION['userid_admin'])) {
        authenticate_admin();

    } else {
        authenticate_end();

    }
}

function authenticate_viewer()
{
    if (isset($_SESSION['userid_admin']) == NULL && isset($_SESSION['userid_mitarbeiter']) == NULL && isset($_SESSION['userid']) == NULL) {
        authenticate_end();
    }

    if (isset($_SESSION['userid_admin'])) {

        $c = Mitarbeiter::get($_SESSION['userid_admin']);
        $_SESSION['userid_anzeige'] = "<b style='color: red'>" . $c->getMitarbeiterVorname() . " " . $c->getMitarbeiterNachname() . "</b>";

    } elseif (isset($_SESSION['userid_mitarbeiter'])) {

        $c = Mitarbeiter::get($_SESSION['userid_mitarbeiter']);
        $_SESSION['userid_anzeige'] = "<b style='color: darkgreen'>" . $c->getMitarbeiterVorname() . " " . $c->getMitarbeiterNachname() . "</b>";

    } elseif (isset($_SESSION['userid'])) {

        $_SESSION['userid_anzeige'] = "<a style='color: black'>nicht angemeldet</a>";

    }
}


function authenticate_mitarbeiter()
{

    if (isset($_SESSION['userid_admin']) == NULL && isset($_SESSION['userid_mitarbeiter']) == NULL) {
        authenticate_end();
    }

    if (isset($_SESSION['userid_admin'])) {

        $c = Mitarbeiter::get($_SESSION['userid_admin']);
        $_SESSION['userid_anzeige'] = "<b style='color: red'>" . $c->getMitarbeiterVorname() . " " . $c->getMitarbeiterNachname() . "</b>";

    } elseif (isset($_SESSION['userid_mitarbeiter'])) {

        $c = Mitarbeiter::get($_SESSION['userid_mitarbeiter']);
        $_SESSION['userid_anzeige'] = "<b style='color: darkgreen'>" . $c->getMitarbeiterVorname() . " " . $c->getMitarbeiterNachname() . "</b>";

    }

}


function authenticate_admin()
{
    if (!isset($_SESSION['userid_admin'])) {
        authenticate_end();

    } else {

        $c = Mitarbeiter::get($_SESSION['userid_admin']);
        $_SESSION['userid_anzeige'] = "<b style='color: red'>" . $c->getMitarbeiterVorname() . " " . $c->getMitarbeiterNachname() . "</b>";

    }
}

function authenticate_end()
{
    header("Location: ../../index.php");
    session_destroy();
}
?>