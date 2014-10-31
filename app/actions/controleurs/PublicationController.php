<?php

require_once MODELE . 'TblPublications.php';

class PublicationController {

    private $modele;
    private $typesArticle = array(
        "article" => "Article de journal",
        "livre" => "Livre",
        "chapitre" => "Chapitre de livre",
        "internationale" => "Conférence internationale",
        "nationale" => "Conférence nationale"
    );
    private $langues = array("fr" => "FR", "en" => "EN");

    public function __construct($connexion) {
        $this->modele = new TblPublications($connexion);
    }

    /*     * *
     * ACTIONS SPECIFIQUES A L'APPROBATEUR
     * * */

    public function listerPourApprobateur($idGroupeApprobateur) {

        /* TO DO Controler si le formulaire a été validé */
        if (isset($_POST['nbPublications']) && isApprobateur()) {
            $nbPublications = filter_input(INPUT_POST, 'nbPublications');
            $statut = filter_input(INPUT_POST, 'statut');
            // die($statut);
            $idApprobateur = $_SESSION['utilisateur']->getIdUtilisateur();
            //die($idApprobateur);
            for ($i = 0; $i < $nbPublications; $i++) {
                //on vérifie pour chaque publication que la case est cochée
                if ($_POST['idPublication']) {
                    $idPublication = filter_input(INPUT_POST, 'idPublication');
                    //changer le 
                    $this->modele->changerStatutDeLaPublication($idPublication, $statut, $idApprobateur);
                }
            }
        }

        $publications = $this->modele
                ->listerPublicationsEnAttenteValidation($idGroupeApprobateur);


        return render_template('approbateur', 'liste', array('publications' => $publications));
    }

    public function approuverUnePublication($idPublication) {
        $details = $this->detaillerUnePublication($idPublication);

        //si le formulaire a déjà été validé        
        if (isset($_POST['statut']) && isApprobateur()) {

            // on change le statut de la publication selon le choix de l'approbateur
            $IdApprobateur = $_SESSION['utilisateur']->getIdUtilisateur();
            $statut = filter_input(INPUT_POST, 'statut');
            $this->modele->changerStatutDeLaPublication($idPublication, $statut, $IdApprobateur);

            // on retourne vers la liste de l'approbateur
            $publications = $this->modele
                    ->listerPublicationsEnAttenteValidation($_SESSION['utilisateur']->getIDgroupe());
            return render_template('approbateur', 'liste', array('publications' => $publications));
        }

        //sinon on affiche le détail de la publication demandée
        $publication = $details['publication'];
        $auteurs = $details['auteurs'];
        return render_template('approbateur', 'approuver', array(
            'publication' => $publication,
            'auteurs' => $auteurs
        ));
    }

    /*     * ******************************* */
    /* ACTIONS SPECIFIQUES AU CHERCHEUR
      /************************************ */

    public function listerPourChercheur($idChercheur) {
        $publications = $this->modele
                ->listerPublicationsParChercheur($idChercheur);
        $publications = $this->trouverLesAuteursParListeDePublications($publications);

        return render_template('chercheur', 'liste', array('publications' => $publications));
    }

    public function editerUnePublication($idPublication) {
        $details = $this->detaillerUnePublication($idPublication);
        $action = filter_input(INPUT_GET, 'action');
        $idConnecte = $_SESSION['utilisateur']->getIdUtilisateur();

        //on vérifie que le connecté est bien le soumissionnaire
        if ($details['publication']['soumisPar'] == $idConnecte) {
            if (isset($_POST['titre'])) {
                $details = $this->validerLeFormulaire($details, $action);
            }
            return render_template('chercheur', 'editer', array(
                'publication' => $details['publication'],
                'auteurs' => $details['auteurs'],
                'options' => $this->typesArticle,
                'langues' => $this->langues));
        }
    }

    public function ajouterUnePublication() {
        $details = array();
        $action = filter_input(INPUT_GET, 'action');
        if (isset($_POST['titre'])) {
            return $this->validerLeFormulaire($details, $action);
            
        }
        return render_template('chercheur', 'ajouter', array(
            'options' => $this->typesArticle,
            'langues' => $this->langues));
    }

    /*     * ******************** */
    /* ACTIONS COMMUNES
      /************************ */

    private function validerLeFormulaire($details, $action) {
        $idConnecte = $_SESSION['utilisateur']->getIdUtilisateur();
        if(!empty($details)){
            $idPublication = $details['publication']['IDpublication'];        
        }
        $donnees = array();
        foreach ($_POST as $key => $value) {
            if ($key != 'auteurs' && $key != 'MAX_FILE_SIZE') {
                $donnees[$key] = filter_input(INPUT_POST, $key);
            }
        }

        //retraitement de certaines données
        if ($donnees['estPublique'] == 'on') {
            $donnees['estPublique'] = 1;
        } else {
            $donnees['estPublique'] = 0;
        }
        $date = explode('/', $donnees['dateRedaction']);
        $date = new DateTime($date[2] . '-' . $date[1] . '-' . $date[0]);
        $listeAuteurs = filter_input(INPUT_POST, 'auteurs');
        $donnees['dateRedaction'] = $date->format('Y-m-d');
        
        //die($donnees['dateRedaction']);
        $donnees['typeArticle'] = $this->typesArticle[$donnees['typeArticle']];

        /** téléchargement du fichier * */
        $donnees["urlDoc"] = UPLOAD .  str_replace(' ', '_', $donnees["titre"]) . '_' . $donnees["version"];
        $this->telechargerFichier('url', $donnees["urlDoc"]);
        if($action == 'editer'){
            $this->modele->editerPublication($idPublication, $donnees);
        }elseif ($action == 'ajouter')  {
            $donnees["soumisPar"] = $idConnecte;//            
            $publication = $this->modele->ajouterPublication($donnees);
            var_dump($publication); 
            $idPublication = $publication['IDpublication'];
        } 
        /*         * mise à jour des auteurs * */
        $this->mettreAJourAuteurs($idPublication, $listeAuteurs);
        $details = $this->detaillerUnePublication($idPublication);        
        redirectionVersPage('chercheur', 'liste');
        //return $details;
    }

    private function detaillerUnePublication($idPublication) {

        $publication = $this->modele
                ->detaillerUnePublication($idPublication);

        if (!$publication) {
            return render_template('publique', 'inexistante', array());
        } else {
            $auteurs = $this->modele->retrouverAuteursParPublication($idPublication);
            return array('publication' => $publication, 'auteurs' => $this->listerLesAuteurs($auteurs));
        }
    }

    private function listerLesAuteurs($auteurs) {
        $liste = array();
        foreach ($auteurs as $auteur) {
            array_push($liste, $auteur["auteur"]);
        }

        return implode(',', $liste);
    }

    /**
     * 
     * @param type $IDPublication
     * @param type $listeAuteurs: liste d'auteurs, chaine de caractère
     */
    private function mettreAJourAuteurs($IDPublication, $listeAuteurs) {
        //comparer la liste avec les auteurs en base
        $detailsPub = $this->detaillerUnePublication($IDPublication);
        $auteursEnBase = explode(',', $detailsPub['auteurs']);
        $listeAuteurs = explode(',', $listeAuteurs);
        $identique = true;
        if (sizeof($auteursEnBase) != sizeof($listeAuteurs)) {
            $identique = false;
        }
        $i = 0;
        while ($identique && $i < sizeof($auteursEnBase)) {
            if (trim($auteursEnBase[$i]) != trim($listeAuteurs[$i])) {
                $identique = false;
            }
            $i+=1;
        }

        //print_r($listeAuteurs) ;
        // mettre à jour si la liste est différente
        if (!$identique) {
            //die('here');
            $this->modele->mettreAJourAuteurs($IDPublication, $listeAuteurs);
        }
    }

    private function trouverLesAuteursParListeDePublications($publications) {
        for ($i = 0; $i < count($publications); $i++) {
            $publications[$i]['auteurs'] = $this->modele->retrouverAuteursParPublication($publications[$i]['IDpublication']);
        }
        return $publications;
    }

    private function telechargerFichier($index, $destination, $maxsize = FALSE, $extensions = FALSE) {
        //Test1: fichier correctement uploadé
        if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0)
            return FALSE;
        //Test2: taille limite
        if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize)
            return FALSE;
        //Test3: extension
        $ext = substr(strrchr($_FILES[$index]['name'], '.'), 1);
        if ($extensions !== FALSE AND !in_array($ext, $extensions))
            return FALSE;
        //Déplacement
        return move_uploaded_file($_FILES[$index]['tmp_name'], $destination);
    }

}
