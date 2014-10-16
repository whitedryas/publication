 	<?php include 'app/includes/header.php'; ?>		
        <h1 class="title">Recherche et consultation des publications</h1> 
            <?php if(isIdentifie()): ?>
                Utilisateur identifié; <?php echo $_SESSION['utilisateur']->getNomUtilisateur(); ?> <br/>
            <?php endif ?>
            <?php if(isApprobateur()): ?>
                Utilisateur est Approbateur; <br/>
            <?php endif ?>
            <div class="region region-content">
                    <div id="block-system-main" class="block block-system">
                            <div class="content">
                                    <div id="node-5" class="node node-page" about="#" typeof="foaf:Document">
                                            <form id="filtre" action="index.php?vue=publique&action=result" method="post"> 
                                            <h3>Filtre</h3>
                                                    <fieldset>
                                                            <label>Equipe</label>
                                                            <select id="equipe" name="equipe">
                                                                <option value="">Choisissez</option>
                                                                <option value="COS">COS</option>
                                                                <option value="COVE">COVE</option>
                                                                <option value="GOC">GOC</option>
                                                                <option value="PR">PR</option>
                                                                <option value="SDMA">SDMA</option>
                                                            </select>
                                                            <label>Langue</label>
                                                            <select id="langue" name="langue">
                                                                <option value="">Choisissez</option>
                                                                <option value="FR">FR</option>
                                                                <option value="EN">EN</option>
                                                            </select>
                                                            <label>Type</label>
                                                            <select id="type" name="type">
                                                                <option value="">Choisissez</option>
                                                                <option value="Article de journal">Article de journal</option>
                                                                <option value="Livre">Livre</option>
                                                                <option value="Chapitre de livre">Chapitre de livre</option>
                                                                <option value="Conférence internationale">Conférence internationale</option>
                                                                <option value="Conférence nationale">Conférence nationale</option>
                                                            </select>
                                                            <label>Publique</label><input id="publique" type="checkbox" name="publique" />
                                                    </fieldset>
                                                    <fieldset>
                                                            <label>Titre</label><input id="titre" name="titre" type="text">
                                                            <div class="ui-widget"><label for="auteurs">Auteur</label><input id="auteurs" name="auteur" type="text"></div>
                                                            <div class="ui-widget"><label for="editeurs">Editeur</label><input id="editeurs" name="editeur" type="text"></div>
                                                            <div class="ui-widget"><label for="titreLivre">Titre revue ou conférence</label><input id="titreLivre" name="titreLivre" type="text"></div>	
                                                    </fieldset>
                                                    <fieldset>
                                                            <label>Mots-clé</label><input id="keyword" name="keyword" type="text">	
                                                            <label>Entre le:</label><input id="date-deb" onChange="verifDate($('#date-deb').val(),$('#date-fin').val())" name="dateDebut" type="text">
                                                            <label>Et le :</label><input id="date-fin" onChange="verifDate($('#date-deb').val(),$('#date-fin').val())" name="dateFin" type="text">
                                                            <button id="valider" type="submit">Lancer la recherche</button>
                                                            <button id="reset" type="button" onClick="resetForm()">Reset</button>
                                                    </fieldset>		
                                            </form>
                                            <p id="warning" style="color:#FF0000; display: none;">Vérifiez les dates !</p>
                                            <div class="clearboth"><!----></div>
                                            <h3>Résultats de la recherche</h3>
                                            <div class="content clearfix">
                                                    <div class="field field-name-body field-type-text-with-summary field-label-hidden">
                                                            <div class="field-items">
                                                                    <div class="field-item even" property="content:encoded">
                                                                    </div>
                                                            </div>
                                                    </div>
                                            </div>
                                            <div class="clearfix">
                                            <div class="links"></div>
                                            </div>
                                    </div>
                            </div>
                    </div>
            </div>
               <?php include 'app/includes/footer.php'; ?>