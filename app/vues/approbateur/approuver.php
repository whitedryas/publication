<?php include HEADER;?>

<h1 class="title">Validation d'une publication</h1>

<form action="#" method="POST">
    <input type="hidden" name="id" value="<?php echo $publication['IDpublication']?>">
    <?php include VUES.'partielles/detail.php' ?>    
    <button type="submit" name="statut" value="Valid&eacute;">Valider</button>
    <button type="submit" name="statut" value="Rejet&eacute;">Rejeter</button>
</form>
<?php include FOOTER;?>
