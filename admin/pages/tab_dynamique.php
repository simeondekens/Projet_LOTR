<h2 id="titre">Tableau dynamique</h2>

<?php
$obj = new Vue_GateauxDB($cnx);
$liste = $obj->getVue_gateau();
$nbrG = count($liste);
//var_dump($liste);
?>

<table class="table-responsive">
    <tr>
        <th class="ecart">Id</th>
        <th class="ecart">Thème</th>
        <th class="ecart">Nom</th>
        <th class="ecart">Prix</th>
    </tr>
    <?php
    for ($i = 0; $i < $nbrG; $i++) {
        ?>
        <tr>
            <td class="ecart"><?php print $liste[$i]['ID_GT_GATEAU']; ?></td>
            <td class="ecart"><?php print utf8_encode($liste[$i]['TYPE_GATEAU']); ?></td>
            <td>
                <span contenteditable="true" name="nom_gateau" class="ecart" id="<?php print $liste[$i]['ID_GT_GATEAU']; ?>">
                    <?php print utf8_encode($liste[$i]['NOM_GATEAU']); ?>
                </span>
            </td>
            <td>
                <span contenteditable="true" name="prix_unitaire" class="ecart" id="<?php print $liste[$i]['ID_GT_GATEAU']; ?>">
                    <?php print $liste[$i]['PRIX_UNITAIRE']; ?>
                </span>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
