<h2 id="titre">Tableau dynamique</h2>

<?php
$obj = new VueArticleDB($cnx);
$liste = $obj->getVueArticle();
$nbrG = count($liste);
//var_dump($liste);
?>

    <table class="table-responsive">
        <tr>
            <th class="ecart">Id</th>
            <th class="ecart">Categorie</th>
            <th class="ecart">Nom</th>
            <th class="ecart">Prix</th>
            <th class="ecart">Description</th>
        </tr>
        <?php
    for ($i = 0; $i < $nbrG; $i++) {
        ?>
            <tr>
                <td class="ecart">
                    <?php print $liste[$i]['ID_ARTICLE']; ?>
                </td>
                <td class="ecart">
                    <?php print utf8_encode($liste[$i]['CATEGORIE']); ?>
                </td>
                <td>
                    <span contenteditable="true" name="nom" class="ecart" id="<?php print $liste[$i]['ID_ARTICLE']; ?>">
                    <?php print utf8_encode($liste[$i]['NOM']); ?>
                </span>
                </td>
                <td>
                    <span contenteditable="true" name="prix" class="ecart" id="<?php print $liste[$i]['ID_ARTICLE']; ?>">
                    <?php print $liste[$i]['PRIX']; ?>
                </span>
                </td>
                <td>
                    <span contenteditable="true" name="description" class="ecart" id="<?php print $liste[$i]['ID_ARTICLE']; ?>">
                    <?php print UTF8_ENCODE($liste[$i]['DESCRIPTION']); ?>
                </span>
                </td>
            </tr>
            <?php
    }
    ?>
    </table>
