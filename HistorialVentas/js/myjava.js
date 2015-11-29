$(function(){
	$('#bs-historial').on('keyup',function(){
		var dato = $('#bs-historial').val();
		var url = 'HistorialVentas/php/busca_historialVenta.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'dato='+dato,
		success: function(datos){
			$('#historialVenta').html(datos);
		}
	});
	return false;
	});
});