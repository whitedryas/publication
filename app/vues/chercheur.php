<?php

if (isset($_GET['action'])){
	switch ($action = filter_input(INPUT_GET,'action', FILTER_SANITIZE_STRIPPED)) {
		case "ajouter":
                        $controleurs['publication']->ajouterUnePublication();
			//include ACTIONS.'ajouter.php';
			break;
		case "liste":
                        $controleurs['publication']->listerPourChercheur($_SESSION['utilisateur']->getIdUtilisateur());
//			include VUES.'chercheur/liste.php';
			break;
                //MAJ du 31/10/2014
                case "detail":
                    if(isset($_GET['id'])){
                        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
                        $controleurs['publication']->afficherPublication($id);
                    }  else {
                        include VUES.'404.php';
                    }
                    break;
                //FIN MAJ du 31/10/2014
		case "editer":
                        if(isset($_GET['id'])){
                            $idPublication = filter_input(INPUT_GET,'id');
                            $controleurs['publication']->editerUnePublication($idPublication);
                        }else{
                            $controleurs['publication']->listerPourChercheur($_SESSION['utilisateur']->getIdUtilisateur());  
                        }
			//include ACTIONS.'editer.php';
			break;
		default:
			include VUES.'404.php';
			break;
	}
}else{
	include VUES.'404.php';
}
?>