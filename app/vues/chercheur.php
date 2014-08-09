<?php

if (isset($_GET['action'])){
	switch ($action = filter_input(INPUT_GET,'action', FILTER_SANITIZE_STRIPPED)) {
		case "ajouter":
			include ACTIONS.'ajouter.php';
			break;
		case "liste":
                        $controleurs['publication']->listerPourChercheur($_SESSION['utilisateur']->getIdUtilisateur());
//			include VUES.'chercheur/liste.php';
			break;
		case "editer":
			include ACTIONS.'editer.php';
			break;
		default:
			include VUES.'404.php';
			break;
	}
}else{
	include VUES.'404.php';
}
?>