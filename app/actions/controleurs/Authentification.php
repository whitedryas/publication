<?php
require_once '../modele/entite/Utilisateur.php';

/**
 * Description of Authentification
 * Utilisé pour vérifié la présence en base de l'utilisateur
 * et lui définier ses droits par rapport à son groupe
 */
class Authentification {
    /**
     *
     * @var type : connexion à la 
     */
    private $conn;
    
    
    function __construct($conn) {
        $this->conn = $conn;
    } 
    
    function connect($username, $password){
        $stmt =  $this->conn->prepare("SELECT * FROM tblUtilisateurs "
                     . "WHERE identifiant=:username and motDePasse=:password");
        $stmt->bindParam(':username',  $username);
        $stmt->bindParam(':password',  $password);
        $stmt->execute();
        if(!$user = $stmt->fetch()){
            return 'Identifiant ou mot de passe inconnu';
        }  
       //si l'utilisateur est dans la base, c'est au moins un chercheur;
       $user['autorisations'] = array('CHERCHEUR');
       
       /**
        * on recherche son groupe 
        */
       $stmt= $this->conn->prepare("SELECT * FROM tblGroupes WHERE IDgroupe= :idGroupe");
       $stmt->bindParam('idGroupe', $user['IDgroupe']);
       $stmt->execute();
       if(!$group= $stmt->fetch()){
           return "L'utilisateur ".$user['nomUtilisateur'] ."n'est pas affilié à un groupe"; 
       }
//       $user['groupe']= $group['nomGroupe'];
       
       /**
        * On détermine s'il est validateur 
        * son Id correspnd à l'ID du responsable du groupe
        */
       if($user['IDutilisateur']==$group['IDresponsable']){
           array_push($user['autorisations'], 'APPROBATEUR');
       }
       
        return new Utilisateur($user['IDutilisateur'],$user['nomUtilisateur'], $user['identifiant'], $user['emailUtilisateur'], $user['IDgroupe'], $user['autorisations']);
    }
}
