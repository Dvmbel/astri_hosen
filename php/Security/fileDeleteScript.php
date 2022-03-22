<?php

function deleteAnImage($file){

    $ziel = "../../../Bilder/";
    $zielDatei = $ziel.$file;

    if (unlink($zielDatei)){
        $_SESSION['status-good'] = "Die Datei '".$file."' wird gelöscht...";

    } else{
        $_SESSION['status-bad'] = "Die Datei konnte nicht gelöscht werden.";

    }
}
?>