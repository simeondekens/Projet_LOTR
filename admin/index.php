<!DOCTYPE html>
<?php
    include './lib/php/listeinclude.php';
    $cnx = Connexion::getInstance($dsn, $user, $pass);
    session_start();
?>
    <html>

    <head>
        <meta charset="UTF-8">

        <title>gtBase</title>

        <!-- Style CSS -->
        <link href="./lib/css/style.css" rel="stylesheet">

        <!-- Bootstrap core CSS -->
        <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Spectral+SC" rel="stylesheet">

    </head>

    <body>
        <!-- Navigation -->
        <nav style="font-family: 'Spectral+SC'; font-size: 25px;" class="navbar navbar sticky-top navbar-expand-lg navbar-dark bg-dark ">
            <div class="container">
                <a class="navbar-brand" href="index.php?page=accueil.php" style="font-size: 25px;"><img src="../images/LoTR_projet_pics/icon_ring_2.png" alt="Ring icon"> LoTR shop</a>
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
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=services.php">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=contact.php">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">

                <!-- MENU -->
                <div class="col-sm-2">
                    <nav>
                        <?php
                        if (isset($_SESSION['admin'])) {
                            if (file_exists("./lib/php/admin_menu.php")) {
                                include("./lib/php/admin_menu.php");
                            }
                            else print "Erreur, admin_menu.php introuvable.";
                        }
                        ?>
                    </nav>
                </div>

                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-11">
                            <?php if (isset($_SESSION['admin'])) {
                                ?>
                            <a href="index.php?page=disconnect.php" class="float-right">
                                    Deconnexion
                                </a>
                            <?php }
                            ?>
                        </div>
                    </div>
                    <section>
                        <?php
                        //on arrive sur le site
                        if (!isset($_SESSION['admin'])) {
                            $_SESSION['page'] = "./pages/admin_login.php";
                        } else {
                            /* le contenu change en fonction de la navigation */
                            if (!isset($_SESSION['page'])) {
                                $_SESSION['page'] = "./pages/accueil_admin.php";
                            } else {

                                if (isset($_GET['page'])) {
                                    //print $_GET['page'];
                                    $_SESSION['page'] = "./pages/" . $_GET['page'];
                                }
                            }
                        }
                            //print $_SESSION['page'];  
                            if (file_exists($_SESSION['page'])) {
                                include $_SESSION['page'];
                            } else {
                                print "OUPS!!!!!";
                            }
                        ?>
                    </section>
                    <footer>
                        <?php
                        if (file_exists("./lib/php/p_footer.php")) {
                            include("./lib/php/p_footer.php");
                        }
                        ?>
                    </footer>
                </div>
            </div>
        </div>
    </body>

    </html>
