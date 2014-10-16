<?php
/** Evaluer la racine du site*/
//define("RACINE", __DIR__.'/');
//require_once 'app/includes/autoload.php';

require_once 'autoload.php';
include 'app/includes/config.php';
/**
 * inclure la session et l'utilisateur AVANT tout code html */
include INCLUDES.'session.php';

//include 'app/includes/header.php';

if (isset($_GET['vue'])){
	switch ($vue= filter_input(INPUT_GET, 'vue', FILTER_SANITIZE_STRIPPED)){
		case "publique":
			include VUES.'publique.php';
			break;
		case "approbateur":
                        if(getFirewall('APPROBATEUR')){
                            include VUES.'approbateur.php';
                        }else{
                            include VUES.'403.php';
                        }
			break;
		case "chercheur":
                        if(getFirewall('CHERCHEUR')){
                            include VUES.'chercheur.php';
                        }else{
                            include VUES.'403.php';
                        }			
			break;
		default:
			include VUES.'404.php';
			break;
	}
}else{
	include VUES.'recherche.php';
}

//include 'app/includes/footer.php';
