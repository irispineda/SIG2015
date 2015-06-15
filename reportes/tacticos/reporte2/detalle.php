<?php 
	include "../../../libraries/PHPBD.php";
	
	$print="<table>
					<tr>
						<th>No. Correlativo</th>
						<th>A&ntilde;o</th>
						<th>Cementerio Nuevo o Viejo</th>
						<th>Nombre del Propietario del T&iacute;tulo</th>
						<th>Nicho o Fosa Com&uacute;n</th>
						<th>Nombre del Fallecido</th>
						<th>Beneficiarios (al menos dos)</th>
					</tr>";
	$anio = $_GET["anio"];
	$zona = $_GET["zona"];
	$hay=true;
	
	//consulta para obtener los datos
	$bd = new PHPBD();
	$bd->conectar();
	$query = ' SELECT ident,anio,tipo_cementerio,propietario,tipo_espacio,fallecido,beneficiarios
			   FROM rpttacti2 
			   WHERE anio='.$anio.'
			   AND cod_zona='.$zona.'
			   ORDER BY ident';
	$result = $bd->consultar($query);
	while ($line = mysqli_fetch_array($result, MYSQL_NUM)) {
		$hay=false;
		$print .= "<tr>
					<td>$line[0]</td>
					<td>$line[1]</td>
					<td>$line[2]</td>
					<td>$line[3]</td>
					<td>$line[4]</td>
					<td>$line[5]</td>
					<td>$line[6]</td>
				</tr>";
	}
	$bd->liberar($result);
	$bd->cerrar();
	
	if ($hay){
		$print .= "<tr><td colspan=7><center>NO EXISTE INFORMACION</center></td></tr>";
	}
	$print .= '</table>';
	
	echo $print;
?>