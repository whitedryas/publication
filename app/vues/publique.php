<?php
if (isset($_GET['action'])) {
    switch ($action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRIPPED)) {
        case "connect":
            include VUES . 'connexion.php';
            break;
        case "disconnect":
            unset($_SESSION['utilisateur']);
            session_destroy();
            include VUES . 'recherche.php';
            break;
        case "recherche":
            include VUES . 'recherche.php';
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
        case "result":
            //echo "result";
            include VUES . 'result.php';
            break;
        default:
            include VUES . '404.php';
            break;
    }
} else {
    include VUES . '404.php';
}