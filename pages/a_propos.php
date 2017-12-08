<?php
   $info = new InfoTexteDB($cnx);
    $texte = $info->getInfoTexte("a_propos");

?>
    <div class="a-propos-wrap">
        <div class="card col-lg-6 offset-lg-3">
            <div class="card-body">
                <h4 class="card-title">
                    A propos
                </h4>
                <p class="card-text">
                    <?php print utf8_encode($texte[0]->TEXTE); ?>
                </p>
            </div>
        </div>
    </div>
