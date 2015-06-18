<?php
	function defineMenu(){
		session_start();
		$cat=$_SESSION['Id_cat'];
		
		if($cat==1){
			echo "<ul>
					<li><a href='../../../index.php'>Inicio</a></li>
					<li>
						Nivel T&aacute;ctico
						<ul>
							<li><a href='../../../reportes/tacticos/reporte1/filtro.php'>Reporte 1. Informe  de personas con servicios de agua y bienes inmuebles registrados</a></li>
							<li><a href='../../../reportes/tacticos/reporte2/filtro.php'>Reporte 2. Estado de los t&iacute;tulos perpetuidad</a></li>
							<li><a href='../../../reportes/tacticos/reporte3/filtro.php'>Reporte 3. Control del n&uacute;mero de contribuyentes activos</a></li>
							<li><a href='../../../reportes/tacticos/reporte4/filtro.php'>Reporte 4. Informe del responsable por barrio y cantones del municipio</a></li>
							<li><a href='../../../reportes/tacticos/reporte5/filtro.php'>Reporte 5. Barrios y cantones que no poseen servicios municipales</a></li>
						</ul>
					</li>
					<li>
						Nivel Estr&aacute;tegico
						<ul>
							<li><a href='../../../reportes/estrategicos/reporte1/filtro.php'>Reporte 1. Reporte de contribuyentes morosos mayor a tres meses</a></li>
							<li><a href='../../../reportes/estrategicos/reporte2/filtro.php'>Reporte 2. Control de convenios  de pagos  por periodo</a></li>
							<li><a href='../../../reportes/estrategicos/reporte3/filtro.php'>Reporte 3. Actualizaci&oacute;n de saldos e impuestos y tasas por a&ntilde;o</a></li>
							<li><a href='../../../reportes/estrategicos/reporte4/filtro.php'>Reporte 4. Clasificaci&oacute;n de contribuyentes por servicios prestados</a></li>
							<li><a href='../../../reportes/estrategicos/reporte5/filtro.php'>Reporte 5. Seguimiento de los contribuyentes solventes con la municipalidad</a></li>
							<li><a href='../../../reportes/estrategicos/reporte6/filtro.php'>Reporte 6. Clasificaci&oacute;n  de los locales arrendados por la municipalidad por tipo de servicio</a></li>
						</ul>
					</li>
					<li><a href='../../../sesiones/logout.php'>Salir</a></li>
				</ul>";
		}else if($cat==2){
			echo "<ul>
					<li><a href='../../../index.php'>Inicio</a></li>
					<li>
						Nivel Estr&aacute;tegico
						<ul>
							<li><a href='../../../reportes/estrategicos/reporte1/filtro.php'>Reporte 1. Reporte de contribuyentes morosos mayor a tres meses</a></li>
							<li><a href='../../../reportes/estrategicos/reporte2/filtro.php'>Reporte 2. Control de convenios  de pagos  por periodo</a></li>
							<li><a href='../../../reportes/estrategicos/reporte3/filtro.php'>Reporte 3. Actualizaci&oacute;n de saldos e impuestos y tasas por a&ntilde;o</a></li>
							<li><a href='../../../reportes/estrategicos/reporte4/filtro.php'>Reporte 4. Clasificaci&oacute;n de contribuyentes por servicios prestados</a></li>
							<li><a href='../../../reportes/estrategicos/reporte5/filtro.php'>Reporte 5. Seguimiento de los contribuyentes solventes con la municipalidad</a></li>
							<li><a href='../../../reportes/estrategicos/reporte6/filtro.php'>Reporte 6. Clasificaci&oacute;n  de los locales arrendados por la municipalidad por tipo de servicio</a></li>
						</ul>
					</li>
					<li><a href='../../../sesiones/logout.php'>Salir</a></li>
				</ul>";
		}else if($cat==3){
			echo "<ul>
					<li><a href='../../../index.php'>Inicio</a></li>
					<li>
						Nivel T&aacute;ctico
						<ul>
							<li><a href='../../../reportes/tacticos/reporte1/filtro.php'>Reporte 1. Informe  de personas con servicios de agua y bienes inmuebles registrados</a></li>
							<li><a href='../../../reportes/tacticos/reporte2/filtro.php'>Reporte 2. Estado de los t&iacute;tulos perpetuidad</a></li>
							<li><a href='../../../reportes/tacticos/reporte3/filtro.php'>Reporte 3. Control del n&uacute;mero de contribuyentes activos</a></li>
							<li><a href='../../../reportes/tacticos/reporte4/filtro.php'>Reporte 4. Informe del responsable por barrio y cantones del municipio</a></li>
							<li><a href='../../../reportes/tacticos/reporte5/filtro.php'>Reporte 5. Barrios y cantones que no poseen servicios municipales</a></li>
						</ul>
					</li>
					<li><a href='../../../sesiones/logout.php'>Salir</a></li>
				</ul>";
		}
	}
?>