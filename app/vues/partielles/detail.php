
	<h3><?php echo $publication["titre"] ?></h3>
	<span class="auteur">
            <?php echo $auteurs; ?>
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
                                    <?php else : ?>
                                    non publique
                                    <?php endif; ?>
                                </td>
			</tr>
		</tbody>
	</table>
	<h4>Résumé</h4>
	<p class="justifie"><?php echo $publication["resume"] ?></p>
        
        <?php
        if (filter_input(INPUT_GET, 'vue', FILTER_SANITIZE_STRIPPED)=="publique"){
            echo "<a href='index.php?vue=publique&action=recherche'><input type=\"button\" value=\"Retour\"></a>";
        }else{
            echo "<input type=\"button\" value=\"Retour\" onclick=\"history.go(-1)\"/>";
        }
        if (isIdentifie() && $publication["statut"]!="Validé"){
            echo "<a href='index.php?vue=chercheur&action=editer&id=" . $publication['IDpublication'] . "'><input type='button' name='modifier' value='Modifier' style=''></a>";
        }
        ?>


