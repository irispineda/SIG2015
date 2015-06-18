<?php 
	include "../../../libraries/PHPBD.php";
	include "../../../libraries/menu.php";
	$bd = new PHPBD();
	$bd->conectar();
	
	//consulta para obtener los servicios
	$query = 'SELECT cod_servicio, des_servicio FROM rptestra6 GROUP BY cod_servicio, des_servicio ORDER BY cod_servicio';
	$result = $bd->consultar($query);
	$servicios = "<option value=-1 selected>--- Elige servicio ---</option>";
	while ($line = mysqli_fetch_array($result, MYSQL_NUM)) {
		$servicios .= "<option value=$line[0]> $line[0] $line[1]</option>";
	}
	$bd->liberar($result);
	
	$bd->cerrar();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Sistema de Informaci&oacute;n Gerencial</title>
	<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
	<link href="../../../js/jquery-ui-1.11.2/jquery-ui.css" rel="stylesheet" type="text/css" />
	<script src="../../../js/jquery-ui-1.11.2/external/jquery/jquery.js"></script>
	<script src="../../../js/jquery-ui-1.11.2/jquery-ui.js"></script>
	
	<script type="text/javascript">
		function cargarDetalle(){
			var idservicio=document.getElementById("servicio").value;
			if (idservicio != -1){
				$("#detalle").load('detalle.php?servicio='+idservicio);
				document.getElementById("generar").disabled=false;
			}else{
				document.getElementById("generar").disabled=true;
			}
		}
	</script>
	
</head>
<body>
	<div id="wrap">
		<div id="header">
			<h1>Alcald&iacute;a Municipal de Cuyultit&aacute;n</h1>
			<p>Sistema de Informaci&oacute;n Gerencial</p>
		</div>
		<div id="menu">
			<?php defineMenu(); ?>
		</div>
		<!--<div id="avisos">
		</div>-->
		<div id="content">
			<form action="reporte.php" method="post" onload="cargarDetalle();">
				<center><h2>REPORTE DE LOCALES ARRENDADOS POR LA MUNICIPALIDAD POR TIPO DE SERVICIO<hr/></h2></center>
				<table>
					<tr>
						<td>Servicio:</td>
						<td><select name="servicio" id="servicio" onchange="cargarDetalle();">
								<?php echo $servicios; ?>
							</select>
						</td>
						<td>Tipo de Reporte:</td>
						<td><select name="tipo" id="tipo">
								<option value="XLS" selected>Excel</option>
								<option value="PDF">PDF</option>
							</select>
						</td>
					</tr>
				</table>
				<br/>
				<div id="detalle">
					<table>
						<tr>
							<th>Codigo Local</th>
							<th>Nombre del Local</th>
							<th>Tipo del Local</th>
							<th>Nombre del Arrendador</th>
							<th>Tipo del Contrato</th>
							<th>Monto a Pagar</th>
						</tr>
						<tr><td colspan=6><center>NO EXISTE INFORMACION</center></td></tr>
					</table>
				</div>
				<br/>
				<center>
					<input name="boton" id="generar" type="submit" value="Generar reporte" />
					<input name="boton" id="cancelar" type="button" value="Cancelar" onclick="location.href='../../../index.html'" />
				</center>
			</form>
		</div>
		<div id="footer">
			<div class="fleft"><a href="#">Homepage</a></div>
			<div class="fright"><a href="#">Acerca de</a></div>
			<div class="fcenter"><a href="#">Contacto</a></div>
		</div>
	</div>
</body>
</html>