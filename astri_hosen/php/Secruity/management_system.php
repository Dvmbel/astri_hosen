<?php

function authenticate(){
    if(isset($_SESSION['userid'])) {
        authenticate_viewer();

    } elseif (isset($_SESSION['userid_mitarbeiter'])){
        authenticate_mitarbeiter();

    } elseif (isset($_SESSION['userid_admin'])){
        authenticate_admin();

    } else{
        authenticate_end();

    }
}

function authenticate_viewer()
{
    if (isset($_SESSION['userid_admin'])==NULL && isset($_SESSION['userid_mitarbeiter'])==NULL && isset($_SESSION['userid'])==NULL){
        authenticate_end();
    }

    if(isset($_SESSION['userid_admin'])) {

    } elseif (isset($_SESSION['userid_mitarbeiter'])) {

    } elseif (isset($_SESSION['userid'])) {

    }
}


function authenticate_mitarbeiter()
{

    if (isset($_SESSION['userid_admin'])==NULL && isset($_SESSION['userid_mitarbeiter'])==NULL){
        authenticate_end();
    }

    if(isset($_SESSION['userid_admin'])) {

    } elseif (isset($_SESSION['userid_mitarbeiter'])) {

    }


}


function authenticate_admin()
{
    if(!isset($_SESSION['userid_admin'])) {
        authenticate_end();

    } else {

    }
}

function authenticate_end(){
    header("Location: ../../index.php");
    session_destroy();
}

?>