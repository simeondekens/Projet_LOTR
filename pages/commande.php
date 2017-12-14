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
             
                $client->addClient($_GET);  
                $c = $client->getClient($email1);
                //print VAR_DUMP($c);
                //print $c[0]['ID_CLIENT'];
                $fk_client = $c[1]['ID_CLIENT'];
            
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
            <div class="col-sm-5">
                <?php print $liste[0]['NOM']; ?>
            </div>
            <div class="col-sm-5">
                <?php print $liste[0]['PRIX']; ?>€
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 erreur">
                <?php
                if (isset($erreur)) {
                    print $erreur;
                }
                ?>
            </div>
        </div>
        <div class="row">
            <form action="<?php print $_SERVER[ 'PHP_SELF']; ?>" method="get" id="form_commande">

                <div class="form-group">
                    <label for="email1">Email</label>
                    <input class="form-control" type="email" id="email1" name="email1" placeholder="Entrez votre email.">
                </div>
                <div class="form-group">
                    <label for="email2">Confirmez votre email</label>
                    <input class="form-control" type="email" id="email2" name="email2" placeholder="Confirmez votre email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" id="password" name="password">
                </div>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input class="form-control" type="text" name="nom" id="nom">
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input class="form-control" type="text" name="prenom" id="prenom">
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" id="commander" name="commander" class="btn btn-primary">Commander</button>
                    </div>
                    <div class="col-md-6">
                        <button type="reset" id="reset" name="commander" class="btn btn-secondary">Annuler</button>
                    </div>
                </div>
            </form>
        </div>
