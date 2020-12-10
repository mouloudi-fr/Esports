<?php
session_start();
include("connect.php");

if (isset($_POST['idTournoi']) && isset($_POST['idEquipe'])) {
    $reqInscription = $bdd->prepare('INSERT INTO participation (IdEquipe, idTournois) VALUES (?, ?)');
    $reqInscription->execute(array($_POST['idEquipe'], $_POST['idTournoi']));

    if ($reqInscription) {
        echo 'reussi';
    }
    else {
        echo 'erreur';
    }
}



