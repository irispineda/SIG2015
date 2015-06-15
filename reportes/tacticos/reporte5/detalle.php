<?php 
	include "../../../libraries/PHPBD.php";
	
	$print="<table>
					<tr>
						<th>Codigo Sector</th>
						<th>Nombre del Sector</th>
						<th>Direcci&oacute;n</th>
						<th>Servicios Municipales</th>
					</tr>";
	$anio = $_GET["anio"];
	$sector = $_GET["sector"];
	$hay=true;
	
	//consulta para obtener los datos
	$bd = new PHPBD();
	$bd->conectar();
	$query = ' SELECT cod_sector,des_sector,direccion,des_servicio  
			   FROM rpttacti5 
			   WHERE anio='.$anio.'
			   AND cod_sector='.$sector.'
			   ORDER BY cod_sector';
	$result = $bd->consultar($query);
	while ($line = mysqli_fetch_array($result, MYSQL_NUM)) {
		$hay=false;
		$print .= "<tr>
					<td>$line[0]</td>
					<td>$line[1]</td>
					<td>$line[2]</td>
					<td>$line[3]</td>
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