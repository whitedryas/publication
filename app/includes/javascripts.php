        <script type="text/javascript" charset="utf8" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui/external/jquery/jquery.js"></script>
        <script type="text/javascript" src="js/jquery-ui/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui/jquery.ui.datepicker-fr.js"></script>
        <script type="text/javascript" src="js/default-datepicker.js"></script>
        <script type="text/javascript" src="js/recherche.js"></script>
        <script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf8" src="js/default-DataTable.js"></script>
        <?php if(!is_null($action)&& $action=='liste'):?>
                <script type="text/javascript" charset="utf8" src="js/liste.js"></script>
                <?php if(!is_null($vue)):?>
                   <?php if($vue=='approbateur') :?> 
                    <script type="text/javascript" charset="utf8" src="js/attente-validation.js"></script>                
                    <?php elseif($vue=='chercheur'): ?>
                            <script type="text/javascript" charset="utf8" src="js/mes-publications.js"></script>
                 <?php endif ?>
              <?php endif ?>
        <?php endif ?>           

        

    

        
        



