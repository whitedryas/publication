
<form enctype="multipart/form-data" id="ajout" action="#" method="POST"> 
    <fieldset>
        <label>Titre publication</label><input type="text" name ="titre" value="<?php echo $publication["titre"] ?>">
        <label>Auteurs</label><input name="auteurs" value="<?php echo $auteurs ?>" type="text" title="auteurs">
        <label>Type</label><select name="typeArticle">
            <?php
            foreach ($options as $key => $value) {
                $option = "<option value=" . $key;
                if ($value == $publication['typeArticle']) {
                    $option.=" selected='selected'";
                }
                $option.=">" . $value . "</option>";
                echo $option;
            }
            ?>
        </select>
        <label>Titre revue ou conférence</label><input type="text" name="titreLivre" value="<?php echo $publication["titreLivre"] ?>">	
    </fieldset>
    <fieldset>
        <label>Editeur</label><input type="text" name="editeur" value="<?php echo $publication["editeur"] ?>">
        <div style="float:left; width:20%;">
            <label>Langue</label><select name="langue">
                <?php
                foreach ($langues as $key => $value) {
                    $option = "<option value=$key";
                    if ($value == $publication['langue']) {
                        $option.=" selected='selected'";
                    }
                    $option.=">" . $value . "</option>";
                    echo $option;
                }
                ?>
                <!--                <option value="fr">FR</option>
                                <option value="en">EN</option>-->
            </select>
        </div>
        <div style="float:left; width:60%;">
            <label>Lieu si conférence</label><input style="width:98%" type="email" name="lieu" value="<?php echo $publication["lieu"] ?>">	
        </div>
        <div class="clear"></div>
        <label>Contact</label><input type="email" name="contact" value="<?php echo $publication["contact"] ?>">
        <label>Pages</label> de: <input type="text" name="pageDebut"  class="small" value="<?php echo $publication["pageDebut"] ?>"> à <input type="text" name="pageFin" class="small" value="<?php echo $publication["pageFin"] ?>">
    </fieldset>

    <fieldset>
        <label>Mots-clé</label><input type="text" name="motsCles" value="<?php echo $publication["motsCles"] ?>" title="mots-cle">	
        <label>Paru le</label><input type="text" name="dateRedaction" id="date-parution" 
                                     value="<?php
                                     if ($publication['dateRedaction']) {
                                         echo date('d/m/Y', strtotime($publication['dateRedaction']));
                                     } else {
                                         echo date('d/m/Y');
                                     }
                                     ?>">
        <label>Version</label><input  type="text" name="version" value="<?php if ($publication["version"]) {
                                         echo $publication["version"];
                                     } ?>">	
        <label>Publique?</label><input type="checkbox" name="estPublique" <?php if ($publication['estPublique']) {
                                         echo 'checked';
                                     } ?>>	
    </fieldset>		
    <fieldset class="clear">
        <label>Lien publication</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
        <input type="file" id="url" name="url" />
        <label>Résumé</label>
        <textarea name="resume" ><?php echo $publication['resume']; ?>
        </textarea>			
    </fieldset>
    <button type="submit">Enregistrer</button>		
</form> 
