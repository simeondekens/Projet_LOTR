<?php

header('Content-type: application/json');
require '../dbConnectMysql.php';
require '../classes/Connexion.class.php';
require '../classes/Gateau.class.php';
require '../classes/GateauDB.class.php';
$cnx = Connexion::getInstance($dsn, $user, $pass);

try {
    $update = new GateauDB($cnx);
    extract($_GET, EXTR_OVERWRITE);
    $param = 'id=' . $id . '&champ=' . $champ . '&nouveau=' . $nouveau;
    $update->updateGateau($champ, $nouveau, $id);
} catch (Exception $e) {
    print $e->getMessage();
}
