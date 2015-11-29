$(function(){
	$('#nueva-comida').on('click',function(){
                $('#archivo').removeAttr('src', '');
		$('#formularioComida')[0].reset();
		$('#proComida').val('Registro');
                $('#id').prop("readonly", false);
		$('#ediComida').hide();
		$('#regComida').show();
		$('#registra-comida').modal({
			show:true,
			backdrop:'static'
		});
	});
	
	$('#bs-comida').on('keyup',function(){
		var dato = $('#bs-comida').val();
		var url = 'ABMComidas/php/busca_comida.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'dato='+dato,
		success: function(datos){
			$('#agrega-comidas').html(datos);
		}
	});
	return false;
	});
	
});

function agregaComida(){
	var url = 'ABMComidas/php/agrega_comida.php';
        var fd = new FormData(document.getElementById("formularioComida"));

	$.ajax({
		type:'POST',
		url:url,
		data:fd,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
		success: function(registro){
			if ($('#proComida').val() === 'Registro'){
			$('#formularioComida')[0].reset();
			$('#mensaje').addClass('bien').html('Registro completado con exito').show(200).delay(2500).hide(200);
			$('#agrega-comidas').html(registro);
			return false;
			}else{
			$('#mensaje').addClass('bien').html('Edicion completada con exito').show(200).delay(2500).hide(200);
			$('#agrega-comidas').html(registro);
			return false;
			}
		}
	})
	return false;
}

function eliminarComida(id){
	var url = 'ABMComidas/php/elimina_comida.php';
	var pregunta = confirm('¿Esta seguro de eliminar esta comida?');
	if(pregunta==true){
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(registro){
			$('#agrega-comidas').html(registro);
			return false;
		}
	});
	return false;
	}else{
		return false;
	}
}

function editarComida(id){
	$('#formularioComida')[0].reset();
	var url = 'ABMComidas/php/edita_comida.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(valores){
				var datos = eval(valores);
				$('#regComida').hide();
				$('#ediComida').show();
                                $('#id').prop("readonly", true);
				$('#proComida').val('Edicion');
                                $('#id').val(id);
				$('#nombreComida').val(datos[0]);
				$('#descripcion').val(datos[1]);
                                $('#precio').val(datos[2]);
				$('#tipoComida').val(datos[3]);
                                $("div#conteinerImage").empty();
                                $("div#conteinerImage").image("Imagenes/"+datos[4],function(){

                                });
				$('#registra-comida').modal({
					show:true,
					backdrop:'static'
				});
			return false;
		}
	});
	return false;
}

$.fn.image = function(src, f) {
  return this.each(function() {
    var i = new Image();
    i.src = src;
    i.onload = f;
    i.name = "archivo";
    i.id = "archivo";
    i.style = "width: 250px; height: 250px";
    this.appendChild(i);
  });
}

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#archivo')
        .attr('src', e.target.result)
    };
    reader.readAsDataURL(input.files[0]);
  }
} 