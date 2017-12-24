<?php

class InfoArticlesDB extends InfoTexte {
    private $_db;
    private $_infoArray = array();
    private $_variable="valeur";
    
    public function __construct($cnx){
        $this->_db = $cnx;
    }
    
    public function getInfoTexte($page){
        $_infoArray = array();
        try {
            $query="select * from articles";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':page',$page,PDO::PARAM_STR);
            $resultset->execute();
            while($data = $resultset->fetch()){
                $_infoArray[] = new InfoTexte($data);
            }
            return $_infoArray;
        }catch(PDOException $e){
            print "Erreur ".$e->getMessage();
        }       
       
    }
    
     public function updateArticle($champ,$nouveau,$id){ 
         
        try {
            $query='UPDATE articles set '.$champ.' = "'.UTF8_DECODE($nouveau).'" where ID_ARTICLE ='.$id.'';  
            print $query;
            $resultset = $this->_db->prepare($query);
            $resultset->execute();            
            
        }catch(PDOException $e){
            print $e->getMessage();
        }
    }
    
    public function addArticle(array $data) {

        $query = "insert into articles (NOM,FK_CATEGORIE,PRIX,IMAGE,DESCRIPTION) values (:nom,:fk_categorie,:prix,:image,:description)";

        try {
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':nom', $data[0], PDO::PARAM_STR);
            $resultset->bindValue(':fk_categorie', $data[1], PDO::PARAM_STR);
            $resultset->bindValue(':prix', $data[2], PDO::PARAM_STR);
            $resultset->bindValue(':image', $data[3], PDO::PARAM_STR);
            $resultset->bindValue(':description', $data[4], PDO::PARAM_STR);
            
            $resultset->execute();
            //$retour = $resultset->fetchColumn(0);
            //return $retour;
        } catch (PDOException $e) {
            print "<br/>Echec de l'insertion";
            print $e->getMessage();
        }
    }
    
    public function supprArticle($id){
        try{
            $query = "delete from articles where ID_ARTICLE = ".$id;
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            
        }catch(PDOException $e){
            print "<br/>Echec de la suppression";
            print $e->getMessage();
        }
        
    }
}
