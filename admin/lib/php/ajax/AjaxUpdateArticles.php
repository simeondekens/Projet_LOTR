<?php

header('Content-type: application/json');
require '../dbConnectMysql.php';
require '../classe/Connexion.class.php';
require '../classe/InfoTexte.class.php';
require '../classe/InfoArticlesDB.class.php';
$cnx = Connexion::getInstance($dsn, $user, $pass);

try {
    $update = new InfoArticlesDB($cnx);
    extract($_GET, EXTR_OVERWRITE);
    $param = 'id=' . $id . '&champ=' . $champ . '&nouveau=' . $nouveau;
    $update->updateArticle($champ, $nouveau, $id);
} catch (Exception $e) {
    print $e->getMessage();
}
