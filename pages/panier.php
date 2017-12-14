<?php
include_once("../lib/php/fonction_panier.php");
session_start();

$erreur = false;

$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
if($action !== null)
{
   if(!in_array($action,array('ajout', 'suppression', 'refresh')))
   $erreur=true;

    //récuperation des variables en POST ou GET
    $id = (isset($_POST['id'])? $_POST['id']: (isset($_GET['id'])? $_GET['id']:null ));
    $n = (isset($_POST['n'])? $_POST['n']: (isset($_GET['n'])? $_GET['n']:null ));
    $p = (isset($_POST['p'])? $_POST['p']: (isset($_GET['p'])? $_GET['']:null ));
    $img = (isset($_POST['img'])? $_POST['img']: (isset($_GET['img'])? $_GET['img']:null ));
    $q = (isset($_POST['q'])? $_POST['q']: (isset($_GET['q'])? $_GET['q']:null ));

   //Suppression des espaces verticaux
   $id = preg_replace('#\v#', '',$id);
   $n = preg_replace('#\v#', '',$n);
   $img = preg_replace('#\v#', '',$img);
    
   //On verifie que $p soit un float
   $p = floatval($p);

   //On traite $q qui peut etre un entier simple ou un tableau d'entier
    
   if (is_array($q)){
      $QteArticle = array();
      $i=0;
      foreach ($q as $contenu){
         $QteArticle[$i++] = intval($contenu);
      }
   }
   else
   $q = intval($q);
    
}

if (!$erreur){
   switch($action){
      Case "ajout":
         ajouterArticle($id,$n,$p,$img,$q);
         break;

      Case "suppression":
         supprimerArticle($id);
         break;

      Case "refresh" :
         for ($i = 0 ; $i < count($QteArticle) ; $i++)
         {
            modifierQteArticle($_SESSION['panier']['ID_ARTICLE'][$i],round($QteArticle[$i]));
         }
         break;

      Default:
         break;
   }
}

echo '<?xml version="1.0" encoding="utf-8"?>'; ?>

    <form method="post" action="panier.php">
        <table style="width: 400px">
            <tr>
                <td colspan="4">Votre panier</td>
            </tr>
            <tr>
                <td>Nom</td>
                <td>Prix</td>
                <!--          <td>Image</td> -->
                <td>Qte</td>
                <td>Action</td>
            </tr>


            <?php
	if (creationPanier())
	{
	   $nbArticles=count($_SESSION['panier']['ID_ARTICLE']);
	   if ($nbArticles <= 0)
	   echo "<tr><td>Votre panier est vide </ td></tr>";
	   else
	   {
	      for ($i=0 ;$i < $nbArticles ; $i++)
	      {
	         echo "<tr>";
	         echo "<td>".UTF8_ENCODE($_SESSION['panier']['NOM'][$i])."</ td>";
             echo "<td>".htmlspecialchars($_SESSION['panier']['PRIX'][$i])."</ td>";
            //echo "<td><img alt='image' src='".htmlspecialchars($_SESSION['panier']['IMAGE'][$i])."'/></ td>";
	         echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['QTE'][$i])."\"/></td>";
	         echo "<td><a href=\"".htmlspecialchars("panier.php?action=suppression&l=".rawurlencode($_SESSION['panier']['ID_ARTICLE'][$i]))."\">Supprimer</a></td>";
	         echo "</tr>";
	      }

	      echo "<tr><td colspan=\"2\"> </td>";
	      echo "<td colspan=\"2\">";
	      echo "Total : ".MontantGlobal();
	      echo "</td></tr>";

	      echo "<tr><td colspan=\"4\">";
	      echo "<input type=\"submit\" value=\"Rafraichir\"/>";
	      echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";

	      echo "</td></tr>";
	   }
	}
	?>
        </table>
    </form>
