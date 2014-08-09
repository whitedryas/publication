<?php

/**
 * Description of Utilisateur
 *
 */
class Utilisateur {
    private $idUtilisateur;
    private $nomUtilisateur;
    private $identifiant;
//    private $motDePasse;
    private $emailUtilisateur;
    private $IDgroupe;
    private $autorisations;
    
    function __construct($idUtilisateur, $nomUtilisateur, $identifiant, $emailUtilisateur, $groupe, $autorisations) {
        $this->idUtilisateur = $idUtilisateur;
        $this->nomUtilisateur = $nomUtilisateur;
        $this->identifiant = $identifiant;
        $this->emailUtilisateur = $emailUtilisateur;
        $this->IDgroupe = $groupe;
        $this->autorisations = $autorisations;    
      
    }
    
    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }
    
    public function getNomUtilisateur() {
        return $this->nomUtilisateur;
    }

    public function getIdentifiant() {
        return $this->identifiant;
    }

//    public function getMotDePasse() {
//        return $this->motDePasse;
//    }

    public function getEmailUtilisateur() {
        return $this->emailUtilisateur;
    }

    public function getIDgroupe() {
        return $this->IDgroupe;
    }

    public function getAutorisations() {
        return $this->autorisations;
    }
//
//    public function setNomUtilisateur($nomUtilisateur) {
//        $this->nomUtilisateur = $nomUtilisateur;
//    }
//
//    public function setIdentifiant($identifiant) {
//        $this->identifiant = $identifiant;
//    }
//
//    public function setEmailUtilisateur($emailUtilisateur) {
//        $this->emailUtilisateur = $emailUtilisateur;
//    }
//
//    public function setGroup($group) {
//        $this->IDgroup = $IDgroup;
//    }

    public function setAutorisations($autorisations) {
        $this->autorisations = $autorisations;
    }

    public function hasAutorisation($autorisation) {
        return in_array($autorisation, $this->autorisations);
    }

}
