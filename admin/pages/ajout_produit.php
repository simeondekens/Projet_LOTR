<?php
   $info2 = new InfoArticlesDB($cnx);
    $article = $info2->getInfoTexte("magasin");
    $cpt = count($article);

    $info = new InfoCatDB($cnx);
    $categories = $info->getInfoTexte("magasin");
    $cpt2 = count($categories);
  

    // TRAITEMENT DU FORMULAIRE
    if (isset($_POST['ajouter'])) {
        //permet d'extraire les champs du tableau $_POST pour simplifier
        extract($_POST, EXTR_OVERWRITE);
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $type = $_POST['type'];
        if(isset($_FILES['image'])){
            $image = $_FILES['image']['name'];
            $image2 = $_FILES['image']['tmp_name'];
            $ext = $_FILES['image']['type'];
            $extension_upload = strtolower(  substr(  strrchr($ext, '.')  ,1)  );
        }
        
        
        
        if (empty($nom) || empty($description) || empty($prix) || empty($type) || empty($_FILES['image'])){
            $erreur = "Veuillez remplir tous les champs";
            print $erreur;
            
        } else {
            //Transfert de l'image uploadée
            $path = "../images/LoTR_projet_pics/".$image.".".$extension_upload;
            
            //On vérifie si l'image n'est pas déjà présente dans le répertoire, sinon, on la transfère
            if(!file_exists($path)){
               $resultat = move_uploaded_file($image2,$path); 
            }
            
            
            $array = array($nom,$type,$prix,$image,$description);
            $info2->addArticle($array);           
            
            }
            
            
        }



?>
    <div class="row">
        <h2 id="titre">Ajouter un produit</h2>
    </div>


    <div class="row">
        <!-- Si ça ne marche pas, retirer les attributs enctype, mettre method post et action PHP_SELF[] -->
        <form action="<?php print $_SERVER[ 'PHP_SELF']; ?>" method="post" id="form_commande " class="col-md-12 " enctype="multipart/form-data">
            <div class="form-group ">
                <label for="nom ">Nom de l'article: </label>
                <input class="form-control" type="text " id="nom " name="nom" placeholder="Nom de l 'article">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" type="text" id="description" name="description" placeholder="Description de l'article" rows="6"></textarea>
            </div>
            <div class="form-group ">
                <label for="prix ">Prix</label>
                <input class="form-control" type="number " id="prix" name="prix">
            </div>
            <div class="form-group ">
                <label for="type ">Type</label>
                <select class="form-control" type="number" id="type" name="type">
                      <?php 
                        for($i=0; $i<$cpt2; $i++){
                            ?>
                            <option value="<?php print $categories[$i]->ID_CATEGORIE; ?>">
            <?php
                                print utf8_encode($categories[$i]->CATEGORIE);
                            ?>
                </option>
                <?php
                        }
                     ?>
                    </select>
            </div>
            <div class="form-group">
                <label for="image">Selectionnez une image</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>

            <div class="form-group">
                <button type="submit" id="ajouter" name="ajouter" class="btn btn-primary">Ajouter!</button>
            </div>

        </form>
    </div>
