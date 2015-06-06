<?php 
	include "../../../libraries/PHPBD.php";
	$bd = new PHPBD();
	$bd->conectar();
	
	//consulta para obtener los sectores
	$query = 'SELECT * FROM zona';
	$result = $bd->consultar($query);
	$sectores = "";
	while ($line = mysqli_fetch_array($result, MYSQL_NUM)) {
		$sectores .= "<option value=$line[0]> $line[1] $line[2]</option>";
	}
	$bd->liberar($result);
	
	//consulta para obtener los años
	$query = 'SELECT anio FROM rptestra1 GROUP BY anio';
	$result = $bd->consultar($query);
	$anios = "";
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
	<title>Untitled Document</title>
	<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
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
				<li></li>
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
				<li>
					Nivel T&aacute;ctico
					<ul>
						<li><a href="../../../reportes/tacticos/reporte1/filtro.php">Reporte 1. Informe  de personas con servicios de agua y bienes inmuebles registrados</a></li>
						<li><a href="../../../reportes/tacticos/reporte2/filtro.php">Reporte 2. Estado de los t&iacute;tulos de perpetuidad</a></li>
						<li><a href="../../../reportes/tacticos/reporte3/filtro.php">Reporte 3. Control de el número de contribuyentes activos</a></li>
						<li><a href="../../../reportes/tacticos/reporte4/filtro.php">Reporte 4. Informe del responsable por barrio y cantones del municipio</a></li>
						<li><a href="../../../reportes/tacticos/reporte5/filtro.php">Reporte 5. Barrios y cantones que no poseen servicios municipales</a></li>
					</ul>
				</li>
				
			</ul>
		</div>
		<!--<div id="avisos">
		</div>-->
		<div id="content">
			<center><h2>REPORTE DEL CONTROL DEL NUMERO DE CONTRIBUYENTES ACTIVOS<hr/></h2></center>
			<table>
				<tr>
					<td>Sector:</td>
					<td><select name="sector" onchange="">
							<?php echo $sectores; ?>
						</select>
					</td>
					<td>A&ntilde;o:</td>
					<td><select name="anio">
							<?php echo $anios; ?>
						</select>
					</td>
				</tr>
			</table>
			<br/>
			<div id="detalle">
				<table>
					<tr>
						<th>Codigo Sector</th>
						<th>Nombre del Sector</th>
						<th>Codigo del Contribuyente</th>
						<th>Nombre del Contribuyente</th>
						<th>Direcci&oacute;n</th>
						<th>Servicios que Posee</th>
						<th>Activo o No Activo</th>
					</tr>
					<tr>
						<td>Codigo Sector</td>
						<td>Nombre del Sector</td>
						<td>Codigo del Contribuyente</td>
						<td>Nombre del Contribuyente</td>
						<td>Direcci&oacute;n</td>
						<td>Servicios que Posee</td>
						<td>Activo o No Activo</td>
					</tr>
				</table>
			</div>
			<br/>
			<center>
				<input type="submit" value="Generar reporte"/>
				<input type="submit" value="Cancelar"/>
			</center>
		</div>
		<div id="footer">
			<div class="fleft"><a href="#">Homepage</a></div>
			<div class="fright"><a href="#">Acerca de</a></div>
			<div class="fcenter"><a href="#">Contacto</a></div>
		</div>
	</div>
</body>
</html>