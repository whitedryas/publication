$.extend( $.fn.dataTable.defaults, {
    "searching": true,
    "ordering":  true,
    "columnDefs": [
    			{ "orderable": false, "targets": 'nosort' }
  	],
    "language": {
  		"lengthMenu": "Afficher _MENU_ résultats par page",
    	"info": " Affichage de la page _PAGE_ de _PAGES_",
    	"zeroRecords": "Aucun résultat - désolé",
    	"infoEmpty":      "Affichage de 0 à 0 of 0 enregistrement",
      "infoFiltered":   "(filtré sur un total de _MAX_ enregistrements)",
      "search": "Recherche : ",
      "paginate": {
        "first":      "Première",
        "last":       "Dernière",
        "next":       "Suivante",
        "previous":   "Précédente"
    },
    
   },
} );

