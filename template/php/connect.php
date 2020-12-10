<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=esport;charset=utf8', 'root', '');
}
catch (Exception $e) {
    echo 'Erreur lors du chargement du serveur';
}


