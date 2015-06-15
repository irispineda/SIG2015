<?php 
	include "../../../libraries/PHPBD.php";
	
	$print="<table>
					<tr>
						<th>Codigo Sector</th>
						<th>Nombre del Sector</th>
						<th>Servicios que posee</th>
						<th>Nombre del Contribuyente</th>
						<th>Direcci&oacute;n</th>
					</tr>";
	$sector = $_GET["sector"];
	$hay=true;
	
	//consulta para obtener los datos
	$bd = new PHPBD();
	$bd->conectar();
	$query = ' SELECT cod_sector,des_sector,des_servicio,des_contribuyente,direccion 
			   FROM rptestra4 
			   WHERE cod_sector='.$sector.'
			   ORDER BY cod_sector';
	$result = $bd->consultar($query);
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