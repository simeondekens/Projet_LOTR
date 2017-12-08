<?php
//InfoClient.class.php

class InfoTexte {
    private $_attributs_de_bd = array();
    
    public function __construct(array $data){
        $this->hydrate($data);
    }
    
    //hydrater = donner des valeurs aux attributs de l'objet
    private function hydrate(array $data){
        //$key = nom du champ; $value = sa valeur
        foreach($data as $key => $value){
            $this->$key = $value;
        }
    }
    
    //getter
    public function __get($name) {
        if(isset($this->_attributs_de_bd[$name])){
            return $this->_attributs_de_bd[$name];
        }
    }
    //setter
    public function __set($nom,$valeur){
        $this->_attributs_de_bd[$nom] = $valeur;
    }
    
    public function faireQqch(){
        print "";
    }
    
}
