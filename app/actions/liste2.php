<?php echo "Utilisateur: " .$_SESSION['utilisateur']->getNomUtilisateur();
?>
<h1 class="title">Mes publications</h1>                                 
                        
<div class="region region-content">
    <div id="block-system-main" class="block block-system">
		<div class="content">
			<div id="node-5" class="node node-page" about="#" typeof="foaf:Document">
				<table id="mes-publications" class="display pretty">
					<thead>
						<tr>
							<th>Titre</th>
							<th>Type</th>
							<th>Soumis le</th>
							<th>Auteurs</th>
							<th>Statut</th>
							<th class='nosort'>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Etiam malesuada felis ligula,</td>
							<td>Livre</td>
							<td>05/08/2013</td>
							<td>Altin B, Cocher R</td>
							<td>Validé</td>
							<td class="case"><a><img src="images/tick-icon.png" /></td>
						</tr>
						<tr>
							<td>Cum sociis natoque penatibus</td>
							<td>Article de journal</td>
							<td>09/04/2014</td>
							<td>Bertrand F, Edisson A,</td>
							<td>En attente</td>
							<td class="case"><a><img src="images/edit-icon.png" /></a></td>
						</tr>
						<tr>
							<td>Etiam vel elit nunc.</td>
							<td>Article de journal</td>
							<td>13/05/2014</td>
							<td>François D</td>
							<td>Rejeté</td>
							<td class="case"><a><img src="images/edit-icon.png" /></a></td>
						</tr>
					</tbody>
				</table>
				<button type="button">Exporter </button>   
				<button type="button"> Soumettre</button> 
  
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