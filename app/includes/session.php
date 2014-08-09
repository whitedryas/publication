<?php
/*namespace Session;*/

require_once 'app/modele/entite/Utilisateur.php';
session_start();

function isIdentifie(){
    return isset($_SESSION['utilisateur']);
}

function getFirewall($autorisation){
    return (isIdentifie() && $_SESSION['utilisateur']->hasAutorisation($autorisation));
}

function isApprobateur(){
    return (isIdentifie() && $_SESSION['utilisateur']->hasAutorisation('APPROBATEUR')); 
}


//Les tokens sont utilisés pour 
//Vous pouvez lui passer en paramètre optionnel un nom pour différencier les formulaires


