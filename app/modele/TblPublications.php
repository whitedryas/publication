<?php

/**
 * Description of TblPublications
 */
class TblPublications {

    private $connexion;
    private $table = 'tblPublication';

    //private $alias = '';

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

    public function detaillerUnePublication($IDPublication) {
        $stmt = $this->connexion->prepare(
                "SELECT *"
                . "FROM tblPublications pub "
                . "WHERE pub.IDpublication=:IDpublication"
        );
        $stmt->bindParam(':IDpublication', $IDPublication);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function changerStatutDeLaPublication($IDPublication, $choixApprobateur, $IDapprobateur) {
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

    public function editerPublication($IDPublication, $donnees) {
        $requete = "UPDATE tblPublications SET ";
        foreach ($donnees as $key => $value) {
            $requete .= $key . " = :" . $key . ",";
        }
        $requete .= " dateSoumission = CURRENT_TIMESTAMP WHERE IDpublication = :IDpublicationCourante ;";
        //echo $requete;
        $stmt = $this->connexion->prepare($requete);


        foreach ($donnees as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        $stmt->bindParam(':IDpublicationCourante', $IDPublication);
        $stmt->execute();
    }

    public function retrouverAuteursParPublication($IDPublication) {
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

    public function listeChampTable($champ, $table) {
        $stmt = $this->connexion->prepare(
                "SELECT DISTINCT " . $champ . "
                    FROM " . $table . "
                    WHERE " . $champ . " IS NOT NULL
                    ORDER BY " . $champ
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * 
     * @param tableau $criteres tableau pour les critères de recherches 
     */
    public function resultatRecherche($criteres) {
        /* TODO voir pour plusieurs mots dans titre ou motsCles */
        /* TODO créer un jeu de tests plus conséquent */
        $rqt = "SELECT DISTINCT tblPublications.*,tblGroupes.nomGroupe
                 FROM tblAuteurs
                 JOIN tblAuteursPublications
                 ON tblAuteurs.IDauteur = tblAuteursPublications.IDauteur
                 JOIN tblPublications
                 ON tblPublications.IDpublication = tblAuteursPublications.IDpublication
                 JOIN tblUtilisateurs
                 ON  tblPublications.soumisPar = tblUtilisateurs.IDutilisateur
                 JOIN tblGroupes
                 ON tblUtilisateurs.IDgroupe = tblGroupes.IDgroupe
                 WHERE tblPublications.statut='Validé' AND ";
        for ($i = 0; $i < count($criteres) - 2; $i++) {
            switch ($criteres[$i]['name']) {
                case "estPublique":
                    $rqt = $rqt . $criteres[$i]['name'] . "=" . $criteres[$i]['value'] . " AND ";
                    break;
                default:
                    $rqt = $rqt . $criteres[$i]['name'] . " LIKE '%" . $criteres[$i]['value'] . "%' AND ";
            }
        }

        if ($criteres[9]['value'] != '' && $criteres[10]['value'] != '') {
            $rqt = $rqt . "dateRedaction BETWEEN STR_TO_DATE('" . $criteres[9]['value'] . "', '%d/%m/%Y') AND STR_TO_DATE('" . $criteres[10]['value'] . "', '%d/%m/%Y') AND ";
        }

        $rqt = substr($rqt, 0, strlen($rqt) - 5);
        //echo $rqt;
        $stmt = $this->connexion->prepare($rqt);
        $stmt->execute();
        $publications = $stmt->fetchAll();
        for ($i = 0; $i < count($publications); $i++) {
            $publications[$i]['auteurs'] = $this->retrouverAuteursParPublication($publications[$i]['IDpublication']);
        }
        return $publications;
    }

    private function verifierAuteur($auteur) {
        $trouve = 0;
        $stmt = $this->connexion->prepare(
                "SELECT IDauteur FROM tblPublications "
                . "WHERE nomAuteur = :nomAuteur"
                . "AND prenomAuteur = :prenomAuteur;"
        );
        $identiteAuteur = explode(" ", $auteur);
        $nomAuteur = $auteur[0];
        $prenomAuteur = $auteur[1];
        $stmt->bindParam(':nomAuteur', $nomAuteur);
        $stmt->bindParam(':prenomAuteur', $nomAuteur);
        $trouve = $stmt->execute(); 
        return $trouve;
    }

    private function ajouterAuteur($auteur) {
        $identiteAuteur = explode(" ", $auteur);
        $nomAuteur = $auteur[0];
        $prenomAuteur = $auteur[1];
        $stmt = $this->connexion->prepare(
                "INSERT INTO tblPublications(nomAuteur, prenomAuteur) VALUES (:nomAuteur, :prenomAuteur);"
        );
        $stmt->bindParam(':nomAuteur', $nomAuteur);
        $stmt->bindParam(':prenomAuteur', $nomAuteur);
        $stmt->execute();
        $stmt = $this->connexion->prepare(
                "SELECT IDauteur WHERE nomAuteur=:nomAuteur and prenomAuteur=:prenomAuteur);"
        );
        $stmt->bindParam(':nomAuteur', $nomAuteur);
        $stmt->bindParam(':prenomAuteur', $nomAuteur);
        return $stmt->execute();
    }

    private function lierPublicationAuteur($IDpublication, $IDauteur, $rang) {
        $stmt = $this->connexion->prepare(
                "INSERT INTO tblAuteursPublications(IDpublication, IDauteur, rang) VALUES (:IDpublication, :IDauteur, :rang);"
        );
        $stmt->bindParam(':IDpublication', $IDpublication);
        $stmt->bindParam(':IDauteur', $IDauteur);
        $stmt->bindParam(':rang', $rang);
        $stmt->execute();
    }

    private function delierAuteurs($IDpublication) {
        $stmt = $this->connexion->prepare(
                "DELETE FROM tblAuteursPublications WHERE IDpublication= :IDpublication);"
        );
        $stmt->bindParam(':IDpublication', $IDpublication);
        $stmt->execute();
    }

    /**
     * Pour mettre à jour une liste d'auteurs
     * on commence par delier tous les auteurs à la publication existante
     * puis vérifie que les auteurs sont déjà en base 
     * sinon on les ajoute
     * puis on lie la nouvelle liste d'auteur à la publication
     */
    public function mettreAJourAuteurs($IDpublication, $listeAuteurs) {
        $this->delierAuteurs($IDpublication);
        foreach ($listeAuteurs as $i => $auteur) {            
            if ($this->verifierAuteur(trim($auteur))> 0) {
                 $this->ajouterAuteur(trim($auteur));
            }
            $this->lierPublicationAuteur($IDpublication, $this->verifierAuteur(trim($auteur)), $i+1); ;
        }
    }

}
