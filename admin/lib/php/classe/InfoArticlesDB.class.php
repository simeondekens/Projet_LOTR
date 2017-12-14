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
}
