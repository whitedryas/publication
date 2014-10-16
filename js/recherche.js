$(document).ready(function() {
	$("#date-deb").datepicker();
	$("#date-fin").datepicker();
} );

function verifDate(date1, date2){
    if (date1>date2){
        $( "#warning" ).show();
        $( "#valider" ).hide();
        $( "#reset" ).hide();
    }else{
        $( "#warning" ).hide();
        $( "#valider" ).show();
        $( "#reset" ).show();
    }
}

function resetForm(){
    $("#equipe").val("");
    $("#langue").val("");
    $("#type").val("");
    $("#publique").attr('checked', false)
    $("#titre").val("");
    $("#auteurs").val("");
    $("#editeurs").val("");
    $("#titreLivre").val("");
    $("#keyword").val("");
    $("#date-deb").val("");
    $("#date-fin").val("");
}