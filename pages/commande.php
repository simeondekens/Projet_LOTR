<h2>Commander</h2>
<?php
if (!isset($_GET['id']) && !isset($_SESSION['id_commande'])) {
    ?>
    <p>Pour commander, choisissez un article.</p>
    <?php
} else if (isset($_GET['id'])) {
    $_SESSION['id_commande'] = $_GET['id'];
}
if (isset($_SESSION['id_commande'])) {
    $article = new VueArticleDB($cnx);
    $liste = $article->getVueArticleProduit($_SESSION['id_commande']);

    // TRAITEMENT DU FORMULAIRE
    if (isset($_GET['commander'])) {
        //permet d'extraire les champs du tableau $_GET pour simplifier
        extract($_GET, EXTR_OVERWRITE);
        if (empty($email1) || empty($email2) || empty($password) || empty($nom) || empty($prenom)){
            $erreur = "Veuillez remplir tous les champs";
        } else {
            $commande = new CommandeDB($cnx);
            $client = new ClientDB($cnx);
            $c = $client->getClient($email1);
            
            if($c == null){
                $client->addClient($_GET);
                $c = $client->getClient($email1);
            }
            
                $fk_client = $c[0]['ID_CLIENT'];
                $fk_produit = $_SESSION['id_commande'];
                $total = $liste[0]['PRIX'];
                $date = date("m.d.y");
                
                $array = array($fk_client,$fk_produit,$total,$date);
                //VAR_DUMP($array);
                
                $commande->addCommande($array);
            }
            
            
        }
    }
    ?>
        <div class="row">
            <div class="col-sm-2">
                <?php print $liste[0]['NOM']; ?>
            </div>
            <div class="col-sm-2">
                <?php print $liste[0]['PRIX']; ?>€
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-4 erreur">
                    <?php
                if (isset($erreur)) {
                    print $erreur;
                }
                ?>
                </div>
            </div>
            <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get" id="form_commande">

                <div class="row">
                    <div class="col-sm-2"><label for="email1">Email</label></div>
                    <div class="col-sm-4">
                        <input type="email" id="email1" name="email1" placeholder="aaa@aaa.aa" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2"><label for="email2">Confirmez votre email</label></div>
                    <div class="col-sm-4">
                        <input type="email" id="email2" name="email2" placeholder="aaa@aaa.aa" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2"><label for="password">Password</label></div>
                    <div class="col-sm-4">
                        <input type="password" id="password" name="password" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2"><label for="nom">Nom</label></div>
                    <div class="col-sm-4">
                        <input type="text" name="nom" id="nom" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2"><label for="prenom">Prénom</label></div>
                    <div class="col-sm-4">
                        <input type="text" name="prenom" id="prenom" />
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-sm-4">
                        <input type="submit" name="commander" id="commander" value="Finaliser ma commande" class="pull-right" />&nbsp;
                        <input type="reset" id="reset" value="Annuler" class="pull-left" />
                    </div>
                </div>
            </form>
        </div>
