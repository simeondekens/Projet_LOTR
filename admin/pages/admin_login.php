<?php
if (isset($_POST['submit_login'])) {
    $log = new AdminDB($cnx);
    $admin = $log->isAdmin($_POST['login'], $_POST['password']);

    if (is_null($admin)) {
        $message = "<br/>Données incorrectes";
    } else {
        $_SESSION['admin'] = 1;
        $_message = "authentifié !";
        ?>
    <meta http-equiv="refresh" : content="0;url=index.php?page=accueil_admin.php">
    <?php
    }
}
?>
        <section id="message">
            <?php if (isset($message)) print $message; ?>
        </section>
        <div class="container" id="inline">
            <form action="<?php print $_SERVER['PHP_SELF']; ?>" method='post' id="form_auth_">
                <div class="row">
                    <div class="col-sm-offset-1 txt150 txtGras">Authentification requise<br/><br/></div>
                </div>
                <!-- card -->
                <div class="col-md-10 card auth">
                    <div class="row">

                        <div class="col-sm-4 center"><br/>Login : </div>
                        <div class="col-sm-8"><br/><input type="text" id="login_" name="login" /></div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-sm-4 txtRouge txtGras">Mot de passe :</div>
                        <div class="col-sm-8"><input type="password" id="password_" name="password" /></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10"><br/>
                            <input type="submit" name="submit_login" id="submit_login_" value="Login" />&nbsp;&nbsp;&nbsp;
                            <input type="reset" id="annuler" value="Annuler" /><br/><br/>
                        </div>

                    </div>
                </div>
                <!-- card -->
            </form>
        </div>
