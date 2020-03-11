const totalPreguntas = 100;

var x;
x=$(document);
x.ready(inicializarEventos);
x.ready(cuenta);

function inicializarEventos(){
	var x;
	x=$(".calc");
	x.change(calcscore);
	
	
	
	x=$(".calc");
	x.change(cuentaChecksA1);

}

function calcscore(){
    var score = 0;
    $(".calc:checked").each(function(){
        score+=parseInt($(this).val(),10);
    });
    $("input[name=sum]").val(score)
}



function cuenta(){
	r = new clockCountdown('clock',{'dias':0,'horas':1,'minutos':30,'segundos':0});
}


function cuentaChecksA1(){
    var score = 0;
    $(".calc:checked").each(function(){
        score+=parseInt($(this).length);
    });
    $(".cambiar1").text(score)

		var rb = $(".calc:checked");
		if (rb.length == totalPreguntas) {
			$("#ver1").removeClass("panel-warning");
			$("#ver1").removeClass("panel-primary");
	    $("#ver1").addClass("panel-success");
			$(".badge1").removeClass("label-warning");
			$(".badge1").removeClass("label-info");
			$(".badge1").addClass("label-success");
			$("#mensaje1").fadeOut();
		}else {
			$(".badge1").removeClass("label-info");
			$(".badge1").addClass("label-warning");
		}
}


function rgResult() {
    var rb = $(".calc:checked");
    if (rb.length == totalPreguntas) {
        $("#mensaje").html("");
        var datos = "action=evalua&" + $("#formexamen").serialize();
        $.post("../controlador/examenControl.php", datos, function(data) {
            $('#mensaje').html(data);
        });
    } else {
        $("#ver10").removeClass("panel-primary");
        $("#ver10").addClass("panel-warning");
        $(".badge10").removeClass("label-info");
        $(".badge10").addClass("label-warning");
        alert('¡Contesta todas las preguntas!');
        return false;
    }
}
