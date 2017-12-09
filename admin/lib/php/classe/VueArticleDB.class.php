<?php

class VueArticleDB {

    private $_db;

    function __construct($_db) {
        $this->_db = $_db;
    }

//liste des gâteaux correspondant au choix du type dans liste déroulante
    function getVueArticleType($id) {
        try {
            $query = "SELECT * FROM VUE_ARTICLE where id_type=:id_type";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id_type', $id);
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
            $query = "SELECT * FROM VUE_ARTICLE order by type_article,nom_article";
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
            $query = "SELECT * FROM VUE_ARTICLE where id_article=:id_article";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id_gateau', $id);
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
