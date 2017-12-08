<?php

header('Content-type: application/json');
require '../dbConnectMysql.php';
require '../classes/Connexion.class.php';
require '../classes/Client.class.php';
require '../classes/ClientDB.class.php';
$cnx = Connexion::getInstance($dsn, $user, $pass);

try {
    $recherche = new ClientDB($cnx);
    $retour = $recherche->getClientJson($_GET['email'], $_GET['password']);
    print json_encode($retour);
} catch (Exception $e) {
    print $e->getMessage();
}
