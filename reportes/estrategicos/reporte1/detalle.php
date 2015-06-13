<?php 
	include "../../../libraries/PHPBD.php";
	
	$print="<table>
					<tr>
						<th>Codigo Zona</th>
						<th>Nombre Zona</th>
						<th>Meses Adeudados</th>
						<th>Nombre del Deudor</th>
						<th>Monto Adeudado</th>
					</tr>";
	$anio = $_GET["anio"];
	$zona = $_GET["zona"];
	$hay=true;
	//consulta para obtener las zonas
	$bd = new PHPBD();
	$bd->conectar();
	$query = ' SELECT cod_zona,des_zona,meses,deudor,monto 
			   FROM rptestra1 
			   WHERE anio='.$anio.'
			   AND cod_zona='.$zona.'
			   ORDER BY cod_zona';
	$result = $bd->consultar($query);
	$zonas = "";
	while ($line = mysqli_fetch_array($result, MYSQL_NUM)) {
		$hay=false;
		$print .= "<tr>
					<td>$line[0]</td>
					<td>$line[1]</td>
					<td>$line[2]</td>
					<td>$line[3]</td>
					<td>$line[4]</td>
				</tr>";
	}
	$bd->liberar($result);
	$bd->cerrar();
	
	if ($hay){
		$print .= "<tr><td colspan=5><center>NO EXISTE INFORMACION</center></td></tr>";
	}
	$print .= '</table>';
	echo $print;
?>