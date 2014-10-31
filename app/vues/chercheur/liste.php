<?php include HEADER; ?>
<div>Liste des publications soumises par: <?php echo $_SESSION['utilisateur']->getNomUtilisateur().'<br/>';
?>
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
            <?php foreach ($publications as $publication): ?>
                <tr>
                    <td><a href="#"><?php echo $publication['titre'] ?></a></td>
                    <td><?php echo $publication['typeArticle'] ?></td>
                    <td><?php echo date('d/m/Y', strtotime($publication['dateSoumission'])); ?></td>
                    <td><?php
                            foreach($publication['auteurs']as $auteur){
                                echo $auteur['auteur'].', ';
                            }
                        ?>
                    </td>
                    <td><?php echo $publication['statut'] ?></td>
                    <td class="case">
                        <?php if($publication['statut']== "Validé"):?>
                            <img src="images/tick-icon.png" />
                        <?php else: ?>
                            <a href="index.php?vue=chercheur&action=editer&id=<?php echo $publication['IDpublication'] ?>"> <img src="images/edit-icon.png" /></a>    
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.php?vue=chercheur&action=ajouter"><button type="button">Ajouter</button></a>
</div>
<?php include FOOTER; ?>


