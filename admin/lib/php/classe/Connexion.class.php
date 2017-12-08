<?php

class Connexion {
    private static $_instance = null;
    
    public static function getInstance($dsn, $user, $pass){
        if(!self::$_instance){
            try{
                self::$_instance = new PDO($dsn, $user, $pass);
                //self::$_instance->setAttribute(PDO::ATTR_ERRMODE,PDO::ATTR_ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                print "Echec de connection" .$e->getMessage();
            }
        }
        return self::$_instance;
    }
}
