        <script type="text/javascript" charset="utf8" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui/external/jquery/jquery.js"></script>
        <script type="text/javascript" src="js/jquery-ui/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui/jquery.ui.datepicker-fr.js"></script>
        <script type="text/javascript" src="js/default-datepicker.js"></script>
        <script type="text/javascript" src="js/recherche.js"></script>
        <script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf8" src="js/default-DataTable.js"></script>
        <?php if(!is_null($action)&& $action=='liste'):?>
                <!--<script type="text/javascript" charset="utf8" src="js/liste.js"></script>-->
                <?php if(!is_null($vue)):?>
                   <?php if($vue=='approbateur') :?> 
                    <script type="text/javascript" charset="utf8" src="js/attente-validation.js"></script>                
                    <?php elseif($vue=='chercheur'): ?>
                            <script type="text/javascript" charset="utf8" src="js/mes-publications.js"></script>
                 <?php endif ?>
              <?php endif ?>
            <?php elseif(!is_null($action)&& ($action=='result' || $action=='recherche')): ?>
            <script type="text/javascript" charset="utf8" src="js/mes-publications.js"></script>
            <script>
                  $(function() {
                    var listeAuteurs = [
                      <?php
                      $modele = new TblPublications($dbh);
                      $auteurs = $modele->listeChampTable("CONCAT_WS(' ', nomAuteur, prenomAuteur )","tblAuteurs");
                      $listeAuteurs = "";
                      foreach($auteurs as $auteur){
                          $listeAuteurs = $listeAuteurs . "'" . $auteur[0] . "',";
                      }
                      echo substr($listeAuteurs,0,strlen($listeAuteurs)-1);
                      ?>
                    ];
                    
                    var listeTitreLivre = [
                      <?php
                      $titresLivre = $modele->listeChampTable("titreLivre","tblPublications");
                      $listeTitreLivre = "";
                      foreach($titresLivre as $titreLivre){
                          $listeTitreLivre = $listeTitreLivre . "'" . addslashes($titreLivre[0]) . "',";
                      }
                      echo substr($listeTitreLivre,0,strlen($listeTitreLivre)-1);
                      ?>
                    ];
                    
                    var listeEditeurs = [
                      <?php
                      $editeurs = $modele->listeChampTable("editeur","tblPublications");
                      $listeEditeurs = "";
                      foreach($editeurs as $editeur){
                          $listeEditeurs = $listeEditeurs . "'" . addslashes($editeur[0]) . "',";
                      }
                      echo substr($listeEditeurs,0,strlen($listeEditeurs)-1);
                      ?>
                    ];
                    
                    $( "#auteurs" ).autocomplete({source: listeAuteurs});
                    $( "#auteurs" ).autocomplete( "option", "autoFocus", true );
                    $( "#auteurs" ).autocomplete( "option", "position", { my : "left top", at: "left bottom" } );
                    
                    $( "#titreLivre" ).autocomplete({source: listeTitreLivre});
                    $( "#titreLivre" ).autocomplete( "option", "autoFocus", true );
                    $( "#titreLivre" ).autocomplete( "option", "position", { my : "left top", at: "left bottom" } );
                    
                    $( "#editeurs" ).autocomplete({source: listeEditeurs});
                    $( "#editeurs" ).autocomplete( "option", "autoFocus", true );
                    $( "#editeurs" ).autocomplete( "option", "position", { my : "left top", at: "left bottom" } );
                  });
            </script>
        <?php endif ?>