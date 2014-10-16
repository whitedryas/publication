<?php
/**
 * Définition des constantes d'acces au fichiers dans l'arborescence
 * 
 **/
define("RACINE", __DIR__.'/');
define("VUES", RACINE.'app/vues/');
define("UPLOAD", RACINE.'fichiers/');

define("INCLUDES", RACINE.'app/includes/');
define("HEADER", INCLUDES.'header.php');
define("FOOTER", INCLUDES.'footer.php');

define("ACTIONS", RACINE.'app/actions/');
define("CONTROLEURS", ACTIONS.'controleurs/');

define("MODELE", RACINE.'app/modele/');
define("ENTITE", MODELE.'entite/');

