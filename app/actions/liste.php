<?php
include_once MODELE.'TblPublications.php';
include_once ENTITY.'Utilisateur.php';
$model= array();
$model['publications']= new TblPublications($dbh);


if (isset($_GET['vue'])){
	switch (filter_input(INPUT_GET, 'vue', FILTER_SANITIZE_STRIPPED)){
		case "publique":
			include VUES.'publique.php';
			break;
		case "approbateur":   
//                        $publications = $model['publications']
//                                        ->listerPublicationsEnAttenteValidation($_SESSION['utilisateur']->getIDgroupe());
                        include VUES.'approbateur/liste.php';
//                        render_template('approbateur', 'liste', array("publications" => $publications));
			break;
		case "chercheur":
                       include VUES.'chercheur.php';
			break;
		default:
			include VUES.'404.php';
			break;
	}
}else{
	include VUES.'recherche.php';
}