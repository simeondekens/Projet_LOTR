<?php

class VueArticleDB {

    private $_db;

    function __construct($_db) {
        $this->_db = $_db;
    }

//liste des gâteaux correspondant au choix du type dans liste déroulante
    function getVueArticleType($id) {
        try {
            $query = "SELECT * FROM vue_article where id_categorie=:id_categorie";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id_categorie', $id);
            $resultset->execute();
            $data = $resultset->fetchAll();
//var_dump($data);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_infoArray[] = $data;
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        return $_infoArray;
    }

    function getVueArticle() {
        try {
            $query = "SELECT * FROM vue_article order by categorie,nom";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            $data = $resultset->fetchAll();
//var_dump($data);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_infoArray[] = $data;
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        return $_infoArray;
    }

    function getVueArticleProduit($id) {
        try {
            $query = "SELECT * FROM vue_article where id_article=:id_article";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id_article', $id);
            $resultset->execute();
            $data = $resultset->fetchAll();
//var_dump($data);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_infoArray[] = $data;
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        return $_infoArray;
    }

}
