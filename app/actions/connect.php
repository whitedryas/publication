<?php
require_once '../../autoload.php';
include INCLUDES.'config.php';
/* pour le passage d'un jeton sécurité sur le formulaire" */
include INCLUDES.'token.php';
require CONTROLEURS.'Authentification.php';

if(is_null($controleurs['authentification'] )){
    $controleurs['authentification'] = new Authentification($dbh);
}

if (isset($_POST['identifiant']) && isset($_POST['motDePasse'])) {


    //Verification de la protection contre attaque CRSF (10 min pour valider)
    if (verifier_token(600, 'connexion')) {
        /**
         * Nettoyer les données du formulaire
         */
        trim($_POST['identifiant']);
        trim($_POST['motDePasse']);
        $identifiant = filter_input(INPUT_POST, 'identifiant', FILTER_SANITIZE_STRING);
        $motDePasse = filter_input(INPUT_POST, 'motDePasse', FILTER_SANITIZE_STRING);
        $user = $controleurs['authentification']->connect($identifiant, $motDePasse);

        if ($user instanceof Utilisateur) {

            //on efface les erreurs précedemment enregistrées
            unset($_SESSION['erreurs']);

            //on enregistre l'utilisateur en session
            $_SESSION['utilisateur'] = $user;
            if ($user->hasAutorisation('APPROBATEUR')) {
                redirectionVersPage('approbateur', 'liste');
            }
            redirectionVersPage('chercheur', 'liste');
        } else {
            $_SESSION['erreurs'] = 'Identifiant ou mot de passe incorrect';
            redirectionVersPage('publique', 'connect');
        }
    } else {
        $_SESSION['erreurs'] = 'Temps validation dépassé';
        redirectionVersPage('publique', 'connect');
    }
}

