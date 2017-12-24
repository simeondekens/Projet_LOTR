<?php 
    $obj = new VueArticleDB($cnx);
    $liste = $obj->getVueArticle();
    $cpt = count($liste);
    
    $art = new InfoArticlesDB($cnx);



    if(isset($_POST['supprimer'])){
        extract($_POST, EXTR_OVERWRITE);
        
        //On vérifie quelles cases ont été cochées
        print "suppression en cours";
        for($j = 0; $j < $cpt ; $j++){
            if(isset($_POST[$liste[$j]['ID_ARTICLE']])){
                //print $liste[$j]['ID_ARTICLE'];
                $id = $liste[$j]['ID_ARTICLE'];
                $art->supprArticle($id);
            }
        }
        header("Refresh:0");
        
    }

?>

<form action="<?php print $_SERVER[ 'PHP_SELF']; ?>" method="post" id="form_delete" class="col-md-12">
    <div class="form-group">
        <table class="table">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Id</th>
                <th scope="col">Categorie</th>
                <th scope="col">Nom</th>
                <th scope="col">Prix</th>
                <th scope="col">Description</th>
                <th scope="col">////</th>
            </tr>
            <?php
    for($i = 0 ; $i < $cpt ; $i++){
        ?>
                <tr>
                    <th scope="row">
                        <?php print $i+1; ?>
                    </th>
                    <td>
                        <?php print $liste[$i]['ID_ARTICLE']; ?>
                    </td>
                    <td>
                        <?php print utf8_encode($liste[$i]['CATEGORIE']); ?>
                    </td>
                    <td>
                        <?php print utf8_encode($liste[$i]['NOM']); ?>
                    </td>
                    <td>
                        <?php print $liste[$i]['PRIX']; ?>
                    </td>
                    <td>
                        <?php print UTF8_ENCODE($liste[$i]['DESCRIPTION']); ?>
                    </td>
                    <td>
                        <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" id="<?php print $liste[$i]['ID_ARTICLE']; ?>" name="<?php print $liste[$i]['ID_ARTICLE']; ?>">
                </label>
                    </td>
                </tr>
                <?php
    }
        
        ?>

        </table>
    </div>
    <div class="form-group">
        <button type="submit" id="supprimer" name="supprimer" class="btn btn-primary">Supprimer les éléments sélectionnés</button>
    </div>
</form>
