<?php

require_once MODELE . 'TblPublications.php';

class PublicationController {

    private $modele;

    public function __construct($connexion) {
        $this->modele = new TblPublications($connexion);
    }

    public function listerPourApprobateur($idGroupeApprobateur) {
        
       /* TO DO Controler si le formulaire a été validé */ 
        if(isset($_POST['nbPublications']) && isApprobateur()){
            $nbPublications= filter_input(INPUT_POST, 'nbPublications');
            $statut = filter_input(INPUT_POST, 'statut');
           // die($statut);
            $idApprobateur =$_SESSION['utilisateur']->getIdUtilisateur();
            //die($idApprobateur);
            for($i=0; $i< $nbPublications; $i++){
                //on vérifie pour chaque publication que la case est cochée
                if($_POST['idPublication']){
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

    public function listerPourChercheur($idChercheur) {
        $publications = $this->modele
                ->listerPublicationsParChercheur($idChercheur);
        $publications = $this->trouverLesAuteursParListeDePublications($publications);

        return render_template('chercheur', 'liste', array('publications' => $publications));
    }
    
    public function approuverUnePublication($idPublication){
        $details = $this->detaillerUnePublication($idPublication);
        
        //si le formulaire a déjà été validé        
        if(isset($_POST['statut']) && isApprobateur()){
            
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

    public function detaillerUnePublication($idPublication) {

        $publication = $this->modele
                ->detaillerUnePublication($idPublication);

        if (!$publication) {
            return render_template('publique', 'inexistante');
        } else {
            $auteurs = $this->modele->retrouverAuteursParPublication($idPublication);
            return array('publication' => $publication,  'auteurs' => $auteurs);
        }
    }

    private function trouverLesAuteursParListeDePublications($publications) {
        for ($i = 0; $i < count($publications); $i++) {
            $publications[$i]['auteurs'] = $this->modele->retrouverAuteursParPublication($publications[$i]['IDpublication']);
        }
        return $publications;
    }

}
