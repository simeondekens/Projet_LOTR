<?php

/**
 * Verifie si le panier existe, le créé sinon
 * @return booleen
 */
function creationPanier(){
   if (!isset($_SESSION['panier'])){
        $_SESSION['panier']=array();
        $_SESSION['panier']['ID_ARTICLE'] = array();
        $_SESSION['panier']['NOM'] = array();
        $_SESSION['panier']['PRIX'] = array();
        $_SESSION['panier']['IMAGE'] = array();
        $_SESSION['panier']['QTE'] = array(); 
        $_SESSION['panier']['verrou'] = false;
   }
   return true;
}


/**
 * Ajoute un article dans le panier
 */
function ajouterArticle($id_article,$nom,$prix,$image,$qte){

   //Si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //Si le produit existe déjà on ajoute seulement la quantité
      $positionProduit = array_search($id_article,  $_SESSION['panier']['ID_ARTICLE']);

      if ($positionProduit !== false)
      {
         $_SESSION['panier']['QTE'][$positionProduit] += $qte ;
      }
      else
      {
         //Sinon on ajoute le produit
         array_push($_SESSION['panier']['ID_ARTICLE'],$id_article);
        array_push($_SESSION['panier']['NOM'],$nom);
        array_push($_SESSION['panier']['PRIX'],$prix);
        array_push($_SESSION['panier']['IMAGE'],$image);
        array_push($_SESSION['panier']['QTE'],$qte);
      }
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}



/**
 * Modifie la quantité d'un article
 */
function modifierQteArticle($id_article,$qte){
   //Si le panier éxiste
   if (creationPanier() && !isVerrouille())
   {
      //Si la quantité est positive on modifie sinon on supprime l'article
      if ($qte > 0)
      {
         //Recharche du produit dans le panier
         $positionProduit = array_search($id_article, $_SESSION['panier']['ID_ARTICLE']);

         if ($positionProduit !== false)
         {
            $_SESSION['panier']['QTE'][$positionProduit] = $qte ;
         }
      }
      else
      supprimerArticle($id_article);
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

/**
 * Supprime un article du panier
 */
function supprimerArticle($id_article){
   //Si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //Nous allons passer par un panier temporaire
        $tmp=array();
        $tmp['ID_ARTICLE'] = array();
        $tmp['NOM'] = array();
        $tmp['PRIX'] = array();
        $tmp['IMAGE'] = array();
        $tmp['QTE'] = array(); 
        $tmp['verrou'] = $_SESSION['panier']['verrou'];
       

      for($i = 0; $i < count($_SESSION['panier']['ID_ARTICLE']); $i++)
      {
         if ($_SESSION['panier']['ID_ARTICLE'][$i] !== $id_article)
         {
             array_push( $tmp['ID_ARTICLE'],$_SESSION['panier']['ID_ARTICLE'][$i]);
             array_push( $tmp['NOM'],$_SESSION['panier']['NOM'][$i]);
             array_push( $tmp['PRIX'],$_SESSION['panier']['PRIX'][$i]);
             array_push( $tmp['IMAGE'],$_SESSION['panier']['IMAGE'][$i]);
             array_push( $tmp['QTE'],$_SESSION['panier']['QTE'][$i]);
         }

      }
      //On remplace le panier en session par notre panier temporaire à jour
      $_SESSION['panier'] =  $tmp;
      //On efface notre panier temporaire
      unset($tmp);
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}


/**
 * Montant total du panier
 */
function MontantGlobal(){
   $total=0;
   for($i = 0; $i < count($_SESSION['panier']['ID_ARTICLE']); $i++)
   {
      $total += $_SESSION['panier']['QTE'][$i] * $_SESSION['panier']['PRIX'][$i];
   }
   return $total;
}


/**
 * Fonction de suppression du panier
 */
function supprimePanier(){
   unset($_SESSION['panier']);
}

/**
 * Permet de savoir si le panier est verrouillé
 */
function isVerrouille(){
   if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
   return true;
   else
   return false;
}

/**
 * Compte le nombre d'articles différents dans le panier
 */
function compterArticles()
{
   if (isset($_SESSION['panier']))
   return count($_SESSION['panier']['ID_ARTICLE']);
   else
   return 0;
}

?>
