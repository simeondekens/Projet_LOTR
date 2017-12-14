<?php
   $info = new InfoArticlesDB($cnx);
    $article = $info->getInfoTexte("magasin");
    $cpt = count($article);

    $info = new InfoCatDB($cnx);
    $categories = $info->getInfoTexte("magasin");
    $cpt2 = count($categories);
    
?>


    <div class="col-lg-9">

        <div class="row">
            <?php for($i=0; $i<$cpt;$i++){ ?>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="./images/LoTR_projet_pics/<?php print $article[$i]->IMAGE; ?>" alt="<?php print $article[$i]->IMAGE; ?>" ></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="./pages/panier.php?action=ajout&amp;id=<?php print $article[$i]->ID_CATEGORIE; ?>&amp;n=" <?php print UTF8_ENCODE($article[$i]->NOM); ?>"&amp;p="<?php print $article[$i]->PRIX; ?>"&amp;img="<?php print $article[$i]->IMAGE; ?>"&amp;q=1" onclick="window.open(this.href, '', 
'toolbar=no, location=no, directories=no, status=yes, scrollbars=yes, resizable=yes, copyhistory=no, width=600, height=350'); return false;">
                            
                            <?php print UTF8_ENCODE($article[$i]->NOM); ?>
                            </a>
                        </h4>
                        <h5>
                            <?php 
                                for($j=0; $j<$cpt2; $j++){
                                    if($article[$i]->FK_CATEGORIE == $categories[$j]->ID_CATEGORIE){
                                        print UTF8_ENCODE($categories[$j]->CATEGORIE);
                                    }
                                }
                            ?>
                        </h5>
                        <h5>
                            <?php  print $article[$i]->PRIX; ?>€
                        </h5>
                        <p class="card-text">
                            <?php print UTF8_ENCODE($article[$i]->DESCRIPTION); ?>

                        </p>
                    </div>

                </div>
            </div>
            <?php   } ?>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.col-lg-9 -->
