<?php

function UploadAnImage(){

    $ziel = "../../../Bilder/";
    $zielDatei = $ziel . basename($_FILES["DateiZumHochladen"]["name"]);
    $error = false;

    $imagesSize = getimagesize($_FILES["DateiZumHochladen"]["tmp_name"]);
    if ($imagesSize === false){
        $error = true;

    } else {
        $imagesSize["mime"];
    }

    $DateiEndung = pathinfo($zielDatei);
    $DateiEndung = pathinfo($zielDatei, PATHINFO_EXTENSION);
    if ($DateiEndung != "jpg" && $DateiEndung != "png" && $DateiEndung != "jpeg" && $DateiEndung != "bmp" && $DateiEndung != "gif"){
        $error = true;
    }

    if (file_exists($zielDatei)){
        $error = true;
    }

    if ($_FILES["DateiZumHochladen"]["size"] > 40*1024*1024){
        $error = true;
    }

    if ($error != true){
        if (move_uploaded_file($_FILES["DateiZumHochladen"]["tmp_name"], $zielDatei)){
            $_SESSION['status-good'] = "Upload war erfolgreich.";
            $_SESSION['upgeloadetesElement'] = basename($_FILES["DateiZumHochladen"]["name"]);

        } else{
            $_SESSION['status-bad'] = "Upload war nicht erfolgreich.";

        }

    } else{
        $_SESSION['status-bad'] = "Die Datei darf nicht hochgeladen werden.";

    }

}
?>