<?php

/**
 * Description of TblPublications
 */
class TblPublications {

    private $connexion;
    private $table = 'tblPublication';
    private $alias = '';

    public function __construct($db) {
        $this->connexion = $db;
    }

    /**
     * 
     * @param type $IDGroupeApprobateur / l'ID du groupe supervisé par l'approbateur connecté
     */
    public function listerPublicationsEnAttenteValidation($IDGroupeApprobateur) {
        $stmt = $this->connexion->prepare(
                "SELECT pub.IDpublication, 
                           pub.titre, pub.typeArticle type, 
                           pub.dateSoumission soumis_le,
                           users.nomUtilisateur soumis_par
            FROM tblPublications pub
            INNER JOIN tblUtilisateurs users
            ON pub.soumisPar = users.IDutilisateur
            WHERE users.IDgroupe = :IDgroupeDeLapprobateurConnecte
            AND pub.statut = 'En attente'
            ORDER BY pub.dateSoumission");
        $stmt->bindParam(':IDgroupeDeLapprobateurConnecte', $IDGroupeApprobateur);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function listerPublicationsParChercheur($IDChercheur) {
        $stmt = $this->connexion->prepare(
                " SELECT DISTINCT *
                    FROM tblPublications pub                 
                    WHERE soumisPar = :IDchercheurConnecte
                    ORDER BY dateSoumission DESC;"
        );
        $stmt->bindParam(':IDchercheurConnecte', $IDChercheur);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function detaillerUnePublication($IDPublication){
        $stmt = $this->connexion->prepare(
                "SELECT *"
                . "FROM tblPublications pub "
                . "WHERE pub.IDpublication=:IDpublication"
        );
        $stmt->bindParam(':IDpublication', $IDPublication);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function changerStatutDeLaPublication($IDPublication, $choixApprobateur, $IDapprobateur){
        $stmt = $this->connexion->prepare(
                "UPDATE tblPublications "
                . "SET statut = :choixApprobateur, "
                    . "approuvePar = :IDapprobateurConnecte, "
                    . "dateApprobation = CURDATE() "
                . "WHERE IDpublication=:IDpublicationCourante;"                
                );
       $stmt->bindParam(':IDpublicationCourante', $IDPublication);
       $stmt->bindParam(':choixApprobateur', $choixApprobateur, PDO::PARAM_STR);
       $stmt->bindParam(':IDapprobateurConnecte', $IDapprobateur);
       $stmt->execute();
//       if(!$stmt->execute()){die('Erreur' .$stmt->debugDumpParams());}
//       $stmt->debugDumpParams();
    }
    
    public function retrouverAuteursParPublication($IDPublication){
        $stmt = $this->connexion->prepare(
                   "SELECT CONCAT_WS(' ', aut.nomAuteur, aut.prenomAuteur ) as auteur
                    FROM tblAuteurs aut
                    INNER JOIN tblAuteursPublications ap
                    ON aut.IDauteur = ap.IDauteur
                    WHERE ap.IDpublication = :IDpublication
                    ORDER BY ap.rang;"
             );
        $stmt->bindParam(':IDpublication', $IDPublication);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @param type $alias, l'alias  à utiliser pour la table
     * @param type $attributs, les attributs a aller chercher dans cette table
     * @param type $where, tableaux
     */
    private function creerSelect($alias, $attributs) {
        $this->alias = $alias;
        $requete = 'SELECT' . implode(',', $pieces) . 'FROM' . $this->table . ' ' . $alias;
    }

    private function innerJoin($joinAlias, $joinTable) {
        
    }

}
