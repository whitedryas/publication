<?php include HEADER; ?>
<div>En attente d'approbation par: <?php
    echo $_SESSION['utilisateur']->getNomUtilisateur().'<br/>';
    ?>
    <form>
        <table id="attente-validation" class="display pretty">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Type</th>
                    <th>Soumis le</th>
                    <th>Par</th>
                    <th class='nosort'>Choix</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($publications as $publication):?>
                 <tr>
                    <td><a href="index.php?vue=approbateur&action=approuver&id=<?php echo $publication['IDpublication'] ?>"><?php echo $publication['titre'] ?></a></td>
                    <td><?php echo $publication['type'] ?></td>
                    <td><?php echo date('d/m/Y', strtotime($publication['soumis_le'])) ; ?></td>
                    <td><?php echo $publication['soumis_par'] ?></td>
                    <td class="case"><input type="checkbox" name="publications" value="publication[id]" /></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <label>Pour les publications sélectionnées :</label>
        <select name="actions">
            <option value="approuver" label="Approuver">Approuver</option>
            <option value="rejeter" label="Rejeter">Rejeter</option>
        </select> 
        <button type="submit"> Ok </button> 
    </form>  

</div>
<?php include FOOTER; ?>
