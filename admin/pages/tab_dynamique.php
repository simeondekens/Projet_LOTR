<h2 id="titre">Tableau dynamique</h2>

<?php
$obj = new VueArticleDB($cnx);
$liste = $obj->getVueArticle();
$nbrG = count($liste);
//var_dump($liste);
?>

    <table class="table">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Id</th>
            <th scope="col">Categorie</th>
            <th scope="col">Nom</th>
            <th scope="col">Prix</th>
            <th scope="col">Description</th>
        </tr>
        <?php
    for ($i = 0; $i < $nbrG; $i++) {
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
                    <span contenteditable="true" name="nom" id="<?php print $liste[$i]['ID_ARTICLE']; ?>">
                    <?php print utf8_encode($liste[$i]['NOM']); ?>
                </span>
                </td>
                <td>
                    <span contenteditable="true" name="prix" id="<?php print $liste[$i]['ID_ARTICLE']; ?>">
                    <?php print $liste[$i]['PRIX']; ?>
                </span>
                </td>
                <td>
                    <span contenteditable="true" name="description" id="<?php print $liste[$i]['ID_ARTICLE']; ?>">
                    <?php print UTF8_ENCODE($liste[$i]['DESCRIPTION']); ?>
                </span>
                </td>
            </tr>
            <?php
    }
    ?>
    </table>
