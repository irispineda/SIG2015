<?php

include('conexion.php');
/*VERIFICA QUE SEA LA SESION EN LA QUE SE HA LOGUEADO*/
if(isset($_SESSION['User'])==false or isset($_SESSION['Id_cat'])==false){
	header('Location:login.php');
}else if($_SESSION['Id_cat'] == 2){
		header('Location:index_e.php');
	}else if($_SESSION['Id_cat'] == 3){
		header('Location:index_t.php');
			}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Administrador</title>
	<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="wrap">
		<div id="header">
			<h1>Alcald&iacute;a Municipal de Cuyultit&aacute;n</h1>
			<p>Sistema de Informaci&oacute;n Gerencial</p>
		</div>
		<div id="menu">
			<ul>
				<li>
					Nivel Estrat&eacute;gico
					<ul>
						<li><a href="../reportes/estrategicos/reporte1/filtro.php">Reporte 1. Reporte de contribuyentes morosos mayor a tres meses</a></li>
						<li><a href="../reportes/estrategicos/reporte2/filtro.php">Reporte 2. Control de convenios  de pagos  por periodo</a></li>
						<li><a href="../reportes/estrategicos/reporte3/filtro.php">Reporte 3. Actualizaci&oacute;n de saldos e impuestos y tasas por a&ntilde;o</a></li>
						<li><a href="../reportes/estrategicos/reporte4/filtro.php">Reporte 4. Clasificaci&oacute;n de contribuyentes por servicios prestados</a></li>
						<li><a href="../reportes/estrategicos/reporte5/filtro.php">Reporte 5. Seguimiento de los contribuyentes solventes con la municipalidad</a></li>
						<li><a href="../reportes/estrategicos/reporte6/filtro.php">Reporte 6. Clasificaci&oacute;n  de los locales arrendados por la municipalidad por tipo de servicio</a></li>
					</ul>
				</li>
				<li>
					Nivel T&aacute;ctico
					<ul>
						<li><a href="../reportes/tacticos/reporte1/filtro.php">Reporte 1. Informe  de personas con servicios de agua y bienes inmuebles registrados</a></li>
						<li><a href="../reportes/tacticos/reporte2/filtro.php">Reporte 2. Estado de los t&iacute;tulos de perpetuidad</a></li>
						<li><a href="../reportes/tacticos/reporte3/filtro.php">Reporte 3. Control de el n�mero de contribuyentes activos</a></li>
						<li><a href="../reportes/tacticos/reporte4/filtro.php">Reporte 4. Informe del responsable por barrio y cantones del municipio</a></li>
						<li><a href="../reportes/tacticos/reporte5/filtro.php">Reporte 5. Barrios y cantones que no poseen servicios municipales</a></li>
					</ul>
				</li>
				<li>
					Administraci&oacute;n
					<ul>
						<li><a href="registrar.php">Usuarios</a></li>
					</ul>
				</li>
				<li><a href="logout.php">Salir</a></li>
			</ul>
		</div>
		<div id="content">
			
		</div>
		<div id="footer">
			<div class="fleft"><a href="#">Homepage</a></div>
			<div class="fright"><a href="#">Acerca de</a></div>
			<div class="fcenter"><a href="#">Contacto</a></div>
		</div>
	</div>
</body>
</html>
