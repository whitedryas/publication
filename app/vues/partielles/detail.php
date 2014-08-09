
	<h3><?php echo $publication["titre"] ?></h3>
	<span class="auteur">
            <?php echo implode(',', $auteurs[0] ) ?>
        </span>
    	<table class="pretty">
		<thead>
			<tr>
				<th>Type</th>
				<th>Ecrit le</th>
				<th>Editeur</th>
				<th>Mots-clé</th>
				<th>Contact</th>
				<th>Publique</th>
				<th>Url</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?php echo $publication["typeArticle"] ?></td>
				<td><?php echo date('d/m/Y', strtotime($publication['dateRedaction'])) ; ?></td>
				<td><?php echo $publication["editeur"]?></td>
				<td><?php echo $publication["motsCles"]?></td>
				<td><?php echo $publication["contact"]?></td>
				<td><?php if($publication["estPublique"] == 1){
                                        echo 'Oui';
                                           }else{
                                               echo 'Non';
                                           }
                                ?></td>
                                <td><?php if($publication["estPublique"]==1 || isIdentifie() ): ?>  
                                    <a href="<?php echo $publication["urlDoc"]; ?>">lien</a>
                                    <?php endif; ?>
                                </td>
			</tr>
		</tbody>
	</table>
	<h4>Résumé</h4>
	<p class="justifie"><?php echo $publication["resume"] ?></p>


