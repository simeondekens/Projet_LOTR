<?php

header('Content-type: application/json');
require '../dbConnectMysql.php';
require '../classe/Connexion.class.php';
require '../classe/InfoTexte.class.php';
require '../classe/ClientDB.class.php';
$cnx = Connexion::getInstance($dsn, $user, $pass);

try {
    $recherche = new ClientDB($cnx);
    $retour = $recherche->getClientJson($_GET['email'], $_GET['password']);
    print json_encode($retour);
} catch (Exception $e) {
    print $e->getMessage();
}
