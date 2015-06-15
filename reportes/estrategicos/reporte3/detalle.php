<?php 
	include "../../../libraries/PHPBD.php";
	
	$print="<table>
					<tr>
						<th>Codigo Municipio</th>
						<th>Nombre Municipio</th>
						<th>Codigo Sector</th>
						<th>Nombre del Sector</th>
						<th>Tasa Actual</th>
						<th>Tasa Nueva</th>
					</tr>";
	$anio = $_GET["anio"];
	$hay=true;
	
	//consulta para obtener los datos
	$bd = new PHPBD();
	$bd->conectar();
	$query = ' SELECT cod_municipio,des_municipio,cod_sector,des_sector,tasaact,tasaant 
			   FROM rptestra3 
			   WHERE anio='.$anio.'
			   ORDER BY cod_municipio';
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
				</tr>";
	}
	$bd->liberar($result);
	$bd->cerrar();
	
	if ($hay){
		$print .= "<tr><td colspan=6><center>NO EXISTE INFORMACION</center></td></tr>";
	}
	$print .= '</table>';
	
	echo $print;
?>