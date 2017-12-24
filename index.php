<!DOCTYPE html>
<?php
    include('./admin/lib/php/listeInclude.php');
    include_once("./lib/php/fonction_panier.php");

    $cnx = Connexion::getInstance($dsn, $user, $pass);

    session_start();
?>

    <html>

    <head>
        <meta charset="UTF-8">

        <title>LoTR Shop</title>

        <!-- Style CSS -->
        <link href="./lib/css/style.css" rel="stylesheet">

        <!-- Bootstrap core CSS -->
        <link href="admin/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">



        <link href="https://fonts.googleapis.com/css?family=Spectral+SC" rel="stylesheet">

    </head>

    <body>
        <!-- Navigation -->
        <nav style="font-family: 'Spectral+SC'; font-size: 25px;" class="navbar navbar sticky-top navbar-expand-lg navbar-dark bg-dark ">
            <div class="container">
                <a class="navbar-brand" href="index.php?page=accueil.php" style="font-size: 25px;"><img src="./images/LoTR_projet_pics/icon_ring_2.png" alt="Ring icon"> LoTR shop</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=accueil.php">Accueil
                            <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=a_propos.php">A propos</a>
                        </li>
                        <!-- item de la navbar qui ne s'affiche que si la session admin n'existe pas -->
                        <?php if(!isset($_SESSION['admin'])){ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./admin/index.php">Administration</a>
                        </li>
                        <?php } ?>
                        <!------->

                        <!-- Item de la navbar qui ne s'affiche que si la session admin existe -->
                        <?php if (isset($_SESSION['admin'])) { ?>
                        <li>
                            <a class="nav-link" href="./admin/index.php?page=disconnect.php">Deconnexion</a>
                        </li>
                        <?php } ?>
                        <!-------->


                    </ul>
                </div>
            </div>
        </nav>

        <!-- container -->
        <div class="container">
            <div class="row">

                <!-- MENU -->
                <div class="col-lg-3">
                    <?php 
                        if (isset($_SESSION['admin'])) {
                            if (file_exists("./admin/lib/php/admin_menu.php")) {
                                include("./admin/lib/php/admin_menu.php");
                            }
                            else print "Erreur, admin_menu.php introuvable.";
                        }
                        else if(file_exists("./lib/php/p_menu.php")){
                            include("./lib/php/p_menu.php");
                        }
                        else print "Erreur, p_menu.php introuvable.";
                    ?>
                </div>
                <!-- col-lg-3 -->

                <div class="col-lg-9">
                    <?php 
                        if (!isset($_SESSION['page'])) {
                            $_SESSION['page'] = "./pages/accueil.php";
                        }
                        if (isset($_GET['page'])) {
                            $_SESSION['page'] = "./pages/" . $_GET['page'];
                        }
                        $path = $_SESSION['page'];
                        if (file_exists($_SESSION['page'])) {

                            include $_SESSION['page'];
                        } else {
                            print"Oups.. La page demandée n'existe pas !  " . $path;
                        }
                    
                    
                    
                    if(file_exists("./lib/php/p_footer.php")){
                        include("./lib/php/p_footer.php");
                    }
                        ?>


                </div>
                <!-- col-lg-9 -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->




        <script src="./admin/lib/jquery/jquery.min.js"></script>
        <script src="./admin/lib/jquery/gt_functionsAjax.js"></script>
        <script type="text/javascript" src="./admin/lib/jquery/dist/jquery.validate.js"></script>
        <script src="./admin/lib/jquery/gt_functionsVal.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    </body>

    </html>
