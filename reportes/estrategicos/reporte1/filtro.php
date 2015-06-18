<?php 
	include "../../../libraries/PHPBD.php";
	include "../../../libraries/menu.php";
	$bd = new PHPBD();
	$bd->conectar();
	
	//consulta para obtener las zonas
	$query = 'SELECT cod_zona, des_zona FROM rptestra1 GROUP BY cod_zona, des_zona ORDER BY cod_zona';
	$result = $bd->consultar($query);
	$zonas = "<option value=-1 selected>--- Elige zona ---</option>";
	while ($line = mysqli_fetch_array($result, MYSQL_NUM)) {
		$zonas .= "<option value=$line[0]> $line[0] $line[1]</option>";
	}
	$bd->liberar($result);
	
	//consulta para obtener los años
	$query = 'SELECT anio FROM rptestra1 GROUP BY anio ORDER BY anio';
	$result = $bd->consultar($query);
	$anios = "<option value=-1 selected>--- Elige a&ntilde;o ---</option>";
	while ($line = mysqli_fetch_array($result, MYSQL_NUM)) {
		$anios .= "<option value=$line[0]> $line[0]</option>";
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
			var idanio=document.getElementById("anio").value;
			var idzona=document.getElementById("zona").value;
			if (idanio != -1 && idzona != -1){
				$("#detalle").load('detalle.php?anio='+idanio+'&zona='+idzona);
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
			<form action="reporte.php" method="post">
				<center><h2>REPORTE DE CONTRIBUYENTES MOROSOS MAYOR A TRES MESES<hr/></h2></center>
				<table>
					<tr>
						<td>A&ntilde;o:</td>
						<td><select name="anio" id="anio" onchange="cargarDetalle();">
								<?php echo $anios; ?>
							</select>
						</td>
						<td>Zona:</td>
						<td><select name="zona" id="zona" onchange="cargarDetalle();">
								<?php echo $zonas; ?>
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
							<th>Codigo Zona</th>
							<th>Nombre Zona</th>
							<th>Meses Adeudados</th>
							<th>Nombre del Deudor</th>
							<th>Monto Adeudado</th>
						</tr>
						<tr><td colspan=5><center>NO EXISTE INFORMACION</center></td></tr>
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