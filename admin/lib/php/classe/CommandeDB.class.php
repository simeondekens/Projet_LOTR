<?php

class CommandeDB extends InfoTexte{

    private $_db;
    private $_CommandeArray = array();

    public function __construct($cnx) {
        $this->_db = $cnx;
    }
    

    public function addCommande(array $data) {

        $query = "insert into commandes (FK_CLIENT,DATE,TOTAL,FK_ARTICLE) values (:fk_client,:date,:total,:fk_produit)";

        try {
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':fk_client', $data[0], PDO::PARAM_STR);
            $resultset->bindValue(':fk_produit', $data[1], PDO::PARAM_STR);
            $resultset->bindValue(':total', $data[2], PDO::PARAM_STR);
            $resultset->bindValue(':date', $data[3], PDO::PARAM_STR);
            
            $resultset->execute();
            //$retour = $resultset->fetchColumn(0);
            //return $retour;
        } catch (PDOException $e) {
            print "<br/>Echec de l'insertion";
            print $e->getMessage();
        }
    }

}
