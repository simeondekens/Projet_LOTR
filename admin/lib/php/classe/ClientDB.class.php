<?php

class ClientDB extends InfoTexte{

    private $_db;
    private $_clientArray = array();

    public function __construct($cnx) {
        $this->_db = $cnx;
    }
    
    public function getClientJson($email,$password){
        $query="select * from clients where MAIL = :mail and PASSWORD = :password";
        try {
        $resultset = $this->_db->prepare($query);
        $resultset->bindValue(':mail',$email, PDO::PARAM_STR);
        $resultset->bindValue(':password',$password, PDO::PARAM_STR);
        $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }
       
        while ($data = $resultset->fetch()) {
            try {
                //$_clientArray[] = new Client ($data);
                $_clientArray[]=$data;
                return $_clientArray;
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        
    }
    public function getClient($email) {
        $query = "select * from clients where MAIL=:mail";
        try {
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':mail', $email, PDO::PARAM_STR);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                //$_clientArray[] = new Client ($data);
                $_clientArray[] = $data;
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        return $_clientArray;
    }

    public function addClient(array $data) {
//en commentaire : appel d'une fonction plpgsql stockée dans Postgresql, avec récupération
//de la valeur retournée
        /* $query="select ajout_client (:nom_client,:prenom_client,:email_client,:telephone,:adresse_client,"
          . ":numero,:codepostal,:localite) as retour";
         */
        $query = "insert into clients (NOM,PRENOM,MAIL,PASSWORD)"
                . " values (:nom,:prenom,:mail,:password)";

        try {
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':nom', $data['nom'], PDO::PARAM_STR);
            $resultset->bindValue(':prenom', $data['prenom'], PDO::PARAM_STR);
            $resultset->bindValue(':mail', $data['email1'], PDO::PARAM_STR);
            $resultset->bindValue(':password', $data['password'], PDO::PARAM_STR);
            $resultset->execute();
            //$retour = $resultset->fetchColumn(0);
            //return $retour;
        } catch (PDOException $e) {
            print "<br/>Echec de l'insertion";
            print $e->getMessage();
        }
    }

}
