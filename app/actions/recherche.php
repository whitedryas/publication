
			<h1 class="title">Recherche et consultation des publications</h1>        
			<div class="region region-content">
				<div id="block-system-main" class="block block-system">
					<div class="content">
						<div id="node-5" class="node node-page" about="#" typeof="foaf:Document">
							<form id="filtre"> 
							<h3>Filtre</h3>
								<fieldset>
									<label>Equipe</label>
									<select name="equipe"> 
										<option value="COS">COS</option>
										<option value="COVE">COVE</option>
										<option value="GOC">GOC</option>
										<option value="PR">PR</option>
										<option value="SDMA">SDMA</option>
									</select>
									<label>Langue</label>
									<select name="langue">
										<option value="fr">FR</option>
										<option value="en">EN</option>
									</select>
									<label>Type</label>
									<select name="type">
										<option value"article">Article de journal</option>
										<option value"livre">Livre</option>
										<option value"chapitre">Chapitre de livre</option>
										<option value"internationale">Conférence internationale</option>
										<option value"nationale">Conférence nationale</option>
									</select>
									<label>Publique</label><input type="checkbox" name="publique" />
								</fieldset>
								<fieldset>
									<label>Titre</label><input type="text">
									<label>Auteur</label><input type="text">
									<label>Editeur</label><input type="text">
									<label>Titre revue ou conférence</label><input type="text">	
								</fieldset>
								<fieldset>
									<label>Mots-clé</label><input type="text">	
									<label>Entre le:</label><input type="text" id="date-deb" >
									<label>Et le :</label><input type="text" id="date-fin">
									<button type="submit">Lancer la recherche</button>
								</fieldset>		
							</form> 
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