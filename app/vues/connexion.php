<?php // $token = generer_token('connexion'); ?>
<?php include 'app/includes/token.php';
        $token = generer_token('connexion');
        include HEADER; ?>	
<h1 class="title">Se connecter</h1>
<div class="region region-content">
    <div id="block-system-main" class="block block-system">
        <div class="content">
            <form id="connexion" action="app/actions/connect.php" method="post">
                <label>Identifiant</label><input type="text" name="identifiant" value="" /><br />
                <label>Mot de passe</label><input type="password" name="motDePasse" value="" />	<br />
                <a href="" >Mot de passe oublié ?</a><br />
                <input type="submit" name="valider" value="Valider" />                
                <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
                <div class="alerte">
                    <?php if (isset($_SESSION['erreurs'])) {
                        echo $_SESSION['erreurs'];
                    } ?>
                </div>
            </form>                  

        </div>
    </div>
</div>
<?php include FOOTER ?>