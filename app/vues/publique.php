<?php
if (isset($_GET['action'])){
	switch ($action = filter_input(INPUT_GET,'action', FILTER_SANITIZE_STRIPPED)) {
		case "connect":
			include VUES.'connexion.php';
			break;
                case "disconnect":
                        unset($_SESSION['utilisateur']);
                        session_destroy();
                    	include VUES.'recherche.php';
			break;
		case "recherche":
			include VUES.'recherche.php';
			break;
		case "detail":
			include VUES.'detail.php';
			break;
		default:
			include VUES.'404.php';
			break;
	}
}else{
	include VUES.'404.php';
}

