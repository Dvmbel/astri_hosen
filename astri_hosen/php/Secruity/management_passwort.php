<?php

function passwort_verschlüsseln($passwort)
{
    $key = "astri_hosen_key";
    $hash = hash_hmac('sha256', $passwort, $key);
    $passwort = base64_encode($hash);
    $_SESSION['passwort_hash'] = $passwort;
}

?>