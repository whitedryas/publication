<?php
require CONTROLEURS.'PublicationController.php';
//die(CONTROLEURS);
//$user ='severine';
//$pass= 'S3v3rin3';
//$database = 'D605';


$user ='appli';
$pass= 'b6aU6Sfvx6caGSme';
$database = 'appli';
$host = 'localhost';
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_PERSISTENT => true
);

/**
 * verification de la base
 */
try {
    $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $database, $user, $pass, $options);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}


/** appel aux controleur **/
$controleurs =array();
$controleurs['publication'] = new PublicationController($dbh);

/**
 * affichage d'un template
 * */
function render_template($vue, $action, $variables){
    extract($variables);
    ob_start();
    require VUES.$vue.'/'.$action.'.php';
    $contenu = ob_get_contents();
//   ob_end_clean();
    return $contenu;
}

/**
 * function de redirction
 */
function redirectionVersPage($vue, $action){
    //$serveur_dir = $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/';
    $serveur_dir = $_SERVER['HTTP_HOST'].'/index.php';
    $vue= 'vue='.$vue;
    $action= '&action='.$action;
    header('Location: http://' . $serveur_dir . '?' .$vue. $action);
    exit();
}


