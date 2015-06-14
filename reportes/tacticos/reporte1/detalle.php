<?php 
	include "../../../libraries/PHPBD.php";
	
	$print="<table>
					<tr>
						<th>Codigo Sector</th>
						<th>Nombre del Sector</th>
						<th>Codigo Contribuyente</th>
						<th>Tipo de Inmueble</th>
						<th>Direcci&oacute;n</th>
						<th>Servicios que Posee</th>
					</tr>";
	$finicio = $_GET["finicio"];
	$ffin = $_GET["ffin"];
	$sector = $_GET["sector"];
	$hay=true;
	
	//consulta para obtener los datos
	$bd = new PHPBD();
	$bd->conectar();
	$query = ' SELECT cod_sector,des_sector,cod_contribuyente,tipo_inmueble,direccion,des_servicio 
			   FROM rpttacti1 
			   WHERE fecha BETWEEN '.$finicio.' AND '.$ffin.'
			   AND cod_sector='.$sector.'
			   ORDER BY cod_sector,cod_contribuyente';
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