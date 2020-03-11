function rgPregunta() {
    $("#mensaje").html("");
    var datos = "action=registra&" + $("#formpregunta").serialize();
    $.post("../controlador/preguntaControl.php", datos, function(data) {
        $("#mensaje").prepend(data);
        $('#mensaje').show('slow');
        $('#mensaje').fadeOut(6000);
    });
}

function updPregunta(){
    $("#mensaje").html("");
    var datos = "action=guarda&" + $("#formpreguntafinal").serialize();
    $.post("../controlador/preguntaControl.php", datos, function(data) {
        $("#mensaje").prepend(data);
        $('#mensaje').show('slow');
        $('#mensaje').fadeOut(6000);      
    });
}

function modPregunta(idPregunta) {     
    $("#mensaje").html("");
    var datos = "action=actualiza&idPregunta="+idPregunta ;
    $.post("../controlador/preguntaControl.php", datos, function(data) {        
        $('#detalles').html(data);        
    }); 
   
}