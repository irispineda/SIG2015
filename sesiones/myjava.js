$(function(){
	/* SE CREAN VARIABLES PARA RECIBIR LOS VALORES DE LOS ELEMENTOS DEL FORMULARIO*/
	$('#ingresar').on('click',function(){
		var usu = $('#usu').val();
		var pass = $('#pass').val();
		var area = $('#area').val();
		var url = 'validar.php';
		var total = usu.length * pass.length * area.length;
		if (total>0){
			$.ajax({
				type: 'POST',
				url: url,
				data: 'usu='+usu+'&pass='+pass+'&area='+area,
				/* QUE PASA SEGUN LOS VALORES TOMADOS AL VALIDAR EL USUARIO*/
				success: function(valor){
					/* SI EL USUARIO DIGITADO NO ES EL CORRECTO*/
					if(valor == 'usuario'){
						$('#mensaje').addClass('error').html('El usuario ingresado no existe').show(300).delay(3000).hide(300);
						$('#usu').focus();
						return false;
							/* SI LA CATEGORIA O TIPO DIGITADO NO ES EL CORRECTO*/
					}else if(valor == 'area'){
						$('#mensaje').addClass('error').html('Usted no pertenece al area seleccionada').show(300).delay(3000).hide(300);
						$('#area').focus();
						return false;
							/* SI  LA CONTRASEÑADIGITADA NO ES LA CORRECTA*/
					}else if(valor == 'password'){
						$('#mensaje').addClass('error').html('Su password es incorrecto').show(300).delay(3000).hide(300);
						$('#pass').focus();
						return false;
						/*EN CASO DE QUE EL VALOR SEA IGUAL AL DE ALGUNA CATEGORIA*/
					}else if(valor == 1){
						document.location.href = '../index.php';
					}else if(valor == 2){
						document.location.href = 'index_e.php';
					}else if(valor == 3){
						document.location.href = 'index_t.php';
					}
				}
			});
			return false;
		}else{
			$('#mensaje').addClass('error').html('Complete todos los campos').show(300).delay(3000).hide(300);
		}
	});
	
});