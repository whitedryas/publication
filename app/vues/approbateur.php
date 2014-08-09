<?php
if (isset($_GET['action'])){
	switch ($action = filter_input(INPUT_GET,'action', FILTER_SANITIZE_STRIPPED)) {
		case "detail":
                        if(isset($_GET['id'])){
                            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
                            $controleurs['publication']->detaillerUnePublication($id);
                        }  else {
                            include VUES.'404.php';
                        }			
			break;
		case "liste":   
                        $controleurs['publication']->listerPourApprobateur($_SESSION['utilisateur']->getIDgroupe());
//			include ACTIONS.'liste.php';
			break;
		case "approuver":
                        if(isset($_GET['id'])){
                            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
                            $controleurs['publication']->approuverUnePublication($id);
                        }  else {
                            include VUES.'404.php';
                        }
			break;
		case "rejeter":
			include ACTIONS.'rejeter.php';
			break;
		default:
			include VUES.'404.php';
			break;
	}
}else{
	include VUES.'404.php';
}
?>