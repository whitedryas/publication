<?php include HEADER; ?>		
<h1 class="title">Recherche et consultation des publications</h1> 
<?php if (isIdentifie()): ?>
    Utilisateur identifié; <?php echo $_SESSION['utilisateur']->getNomUtilisateur(); ?> <br/>
<?php endif ?>
<?php if (isApprobateur()): ?>
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
                            <option <?php if ($_POST['equipe'] == "COS") : echo "selected='selected'";
endif ?> value="COS">COS</option>
                            <option <?php if ($_POST['equipe'] == "COVE") : echo "selected='selected'";
endif ?> value="COVE">COVE</option>
                            <option <?php if ($_POST['equipe'] == "GOC") : echo "selected='selected'";
endif ?> value="GOC">GOC</option>
                            <option <?php if ($_POST['equipe'] == "PR") : echo "selected='selected'";
endif ?> value="PR">PR</option>
                            <option <?php if ($_POST['equipe'] == "SDMA") : echo "selected='selected'";
endif ?> value="SDMA">SDMA</option>
                        </select>
                        <label>Langue</label>
                        <select id="langue" name="langue">
                            <option value="">Choisissez</option>
                            <option <?php if ($_POST['langue'] == "FR") : echo "selected='selected'";
endif ?> value="FR">FR</option>
                            <option <?php if ($_POST['langue'] == "EN") : echo "selected='selected'";
endif ?> value="EN">EN</option>
                        </select>
                        <label>Type</label>
                        <select id="type" name="type">
                            <option value="">Choisissez</option>
                            <option <?php if ($_POST['type'] == "Article de journal") : echo "selected='selected'";
endif ?> value="Article de journal">Article de journal</option>
                            <option <?php if ($_POST['type'] == "Livre") : echo "selected='selected'";
endif ?> value="Livre">Livre</option>
                            <option <?php if ($_POST['type'] == "Chapitre de livre") : echo "selected='selected'";
endif ?> value="Chapitre de livre">Chapitre de livre</option>
                            <option <?php if ($_POST['type'] == "Conférence internationale") : echo "selected='selected'";
endif ?> value="Conférence internationale">Conférence internationale</option>
                            <option <?php if ($_POST['type'] == "Conférence nationale") : echo "selected='selected'";
endif ?> value="Conférence nationale">Conférence nationale</option>
                        </select>
                        <label>Publique</label><input id="publique" type="checkbox" name="publique" <?php if ($_POST['publique'] == true) : echo "checked='checked'";
endif ?>/>
                    </fieldset>
                    <fieldset>
                        <label>Titre</label><input id="titre" name="titre" type="text" <?php if (isset($_POST['titre'])) : echo "value='" . $_POST['titre'] . "'";
endif ?>>
                        <div class="ui-widget"><label for="auteurs">Auteur</label><input id="auteurs" name="auteur" type="text" <?php if (isset($_POST['auteur'])) : echo 'value="' . stripslashes($_POST['auteur']) . '"';
endif ?>></div>
                        <div class="ui-widget"><label for="editeurs">Editeur</label><input id="editeurs" name="editeur" type="text" <?php if (isset($_POST['editeur'])) : echo 'value="' . stripslashes($_POST['editeur']) . '"';
endif ?>></div>
                        <div class="ui-widget"><label for="titreLivre">Titre revue ou conférence</label><input id="titreLivre" name="titreLivre" type="text" <?php if (isset($_POST['titreLivre'])) : echo 'value="' . stripslashes($_POST['titreLivre']) . '"';
endif ?>></div>
                    </fieldset>
                    <fieldset>
                        <label>Mots-clé</label><input id="keyword" name="keyword" type="text" <?php if (isset($_POST['keyword'])) : echo "value='" . $_POST['keyword'] . "'";
endif ?>>	
                        <label>Entre le:</label><input id="date-deb" onChange="verifDate($('#date-deb').val(), $('#date-fin').val())" name="dateDebut" type="text" <?php if (isset($_POST['dateDebut'])) : echo "value='" . $_POST['dateDebut'] . "'";
endif ?>>
                        <label>Et le :</label><input id="date-fin" onChange="verifDate($('#date-deb').val(), $('#date-fin').val())" name="dateFin" type="text" <?php if (isset($_POST['dateFin'])) : echo "value='" . $_POST['dateFin'] . "'";
endif ?>>
                        <button id="valider" type="submit">Lancer la recherche</button>
                        <button id="reset" type="button" onClick="resetForm()">Reset</button>
                    </fieldset>	
                </form>
				<!--MAJ DU 03/10/14-->
				<?php
				if ($_POST['publique'] == "") {
					$publique = 0;
				} else {
					$publique = 1;
				};
				$criteres = array(
								array('name' => "nomGroupe", 'value' => $_POST['equipe']),
								array('name' => "langue", 'value' => $_POST['langue']),
								array('name' => "typeArticle", 'value' => $_POST['type']),
								array('name' => "estPublique", 'value' => $publique),
								array('name' => "titre", 'value' => explode(" ",$_POST['titre'])),
								array('name' => "CONCAT_WS(' ', tblAuteurs.nomAuteur, tblAuteurs.prenomAuteur)", 'value' => $_POST['auteur']),
								array('name' => "editeur", 'value' => $_POST['editeur']),
								array('name' => "titreLivre", 'value' => $_POST['titreLivre']),
								array('name' => "motsCles", 'value' => explode(" ",$_POST['keyword'])),
								array('name' => "dateDebut", 'value' => $_POST['dateDebut']),
								array('name' => "dateFin", 'value' => $_POST['dateFin']),
							);
				$modele = new TblPublications($dbh);
				$results = $modele->resultatRecherche($criteres);
				echo "<p id='warning' style='color:#FF0000; display: none;'>Vérifiez les dates !</p>";
				echo "<p>" . count($results) . " résultat(s) corresponde(nt) à votre recherche.</p>";
				?>
                <div class="clearboth"><!----></div>
                <h3>Résultats de la recherche</h3>
                <div class="content clearfix" style="width:100%;">
                    <div class="field field-name-body field-type-text-with-summary field-label-hidden">
                        <div class="field-items">
                            <div class="field-item even" property="content:encoded">
                                <table id="mes-publications" class="display pretty">
                                    <thead><tr>
                                            <th>Titre</th>
                                            <th>Type</th>
                                            <th>Date</th>
                                            <th>Auteur(s)</th>
                                            <th>Editeur</th>
                                            <th>Equipe</th>
                                        </tr></thead>
                                    <tbody>
                                        <?php
                                        foreach ($results as $result):
                                            ?>
                                            <tr>
                                                <td><a href="#" title="<?php echo $result['titre']; ?>"><?php if (strlen($result['titre']) > 30) : echo substr($result['titre'], 0, 27) . "...";
                                            else: echo $result['titre'];
                                            endif ?></a></td>
                                                <td><?php echo $result['typeArticle'] ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($result['dateRedaction'])); ?></td>
                                                <td><?php
    foreach ($result['auteurs']as $auteur) {
        echo $auteur['auteur'] . '<br/>';
    }
    ?>
                                                </td>
                                                <td><?php echo $result['editeur'] ?></td>
                                                <td><?php echo $result['nomGroupe'] ?></td>
                                            </tr>
    <?php //} 
endforeach;
?>
									<!--FIN MAJ DU 03/10/14-->
                                    </tbody>
                                </table>
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
<?php include FOOTER; ?>