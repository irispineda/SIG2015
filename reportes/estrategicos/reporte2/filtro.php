<?php 
	include "../../../libraries/PHPBD.php";
	$bd = new PHPBD();
	$bd->conectar();
	
	//consulta para obtener las zonas
	$query = 'SELECT cod_zona, des_zona FROM rptestra2 GROUP BY cod_zona, des_zona ORDER BY cod_zona';
	$result = $bd->consultar($query);
	$zonas = "";
	while ($line = mysqli_fetch_array($result, MYSQL_NUM)) {
		$zonas .= "<option value=$line[0]> $line[0] $line[1]</option>";
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
	<script language="javascript">
		$(function() {
			$( "#datepicker1" ).datepicker();
			$( "#datepicker2" ).datepicker();
		});
	</script>
	
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
			<ul>
				<li><a href="../../../index.html">Inicio</a></li>
				<li>
					Nivel T&aacute;ctico
					<ul>
						<li><a href="../../../reportes/tacticos/reporte1/filtro.php">Reporte 1. Informe  de personas con servicios de agua y bienes inmuebles registrados</a></li>
						<li><a href="../../../reportes/tacticos/reporte2/filtro.php">Reporte 2. Estado de los t&iacute;tulos perpetuidad</a></li>
						<li><a href="../../../reportes/tacticos/reporte3/filtro.php">Reporte 3. Control del n&uacute;mero de contribuyentes activos</a></li>
						<li><a href="../../../reportes/tacticos/reporte4/filtro.php">Reporte 4. Informe del responsable por barrio y cantones del municipio</a></li>
						<li><a href="../../../reportes/tacticos/reporte5/filtro.php">Reporte 5. Barrios y cantones que no poseen servicios municipales</a></li>
					</ul>
				</li>
				<li>
					Nivel Estr&aacute;tegico
					<ul>
						<li><a href="../../../reportes/estrategicos/reporte1/filtro.php">Reporte 1. Reporte de contribuyentes morosos mayor a tres meses</a></li>
						<li><a href="../../../reportes/estrategicos/reporte2/filtro.php">Reporte 2. Control de convenios  de pagos  por periodo</a></li>
						<li><a href="../../../reportes/estrategicos/reporte3/filtro.php">Reporte 3. Actualizaci&oacute;n de saldos e impuestos y tasas por a&ntilde;o</a></li>
						<li><a href="../../../reportes/estrategicos/reporte4/filtro.php">Reporte 4. Clasificaci&oacute;n de contribuyentes por servicios prestados</a></li>
						<li><a href="../../../reportes/estrategicos/reporte5/filtro.php">Reporte 5. Seguimiento de los contribuyentes solventes con la municipalidad</a></li>
						<li><a href="../../../reportes/estrategicos/reporte6/filtro.php">Reporte 6. Clasificaci&oacute;n  de los locales arrendados por la municipalidad por tipo de servicio</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<!--<div id="avisos">
		</div>-->
		<div id="content">
			<form action="reporte.php" method="post">
				<center><h2>CONTROL DE CONVENIOS DE PAGOS POR PERIODO<hr/></h2></center>
				<table>
					<tr>
						<td>Inicio de periodo:</td>
						<td><input id="datepicker1" pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d" type="text" 
								   name="finicio" placeholder="Inicio de periodo" required onchange="cargarDetalle();" /></td>
						<td>Fin de periodo:</td>
						<td><input id="datepicker2" pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d" type="text" 
								   name="ffin" placeholder="Fin de periodo" required onchange="cargarDetalle();" /></td>
					</tr>
					<tr>
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
							<th>Codigo Contribuyente</th>
							<th>Nombre Contribuyente</th>
							<th>Fecha Inicio</th>
							<th>Fecha Final</th>
							<th>Monto</th>
							<th>Saldo</th>
						</tr>
						<tr><td colspan=8><center>NO EXISTE INFORMACION</center></td></tr>
					</table>
				</div>
				<br/>
				<center>
					<input name="boton" id="generar" type="submit" value="Generar reporte" disabled="true" />
					<input name="boton" id="cancelar" type="button" value="Cancelar" />
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