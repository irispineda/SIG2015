<?php 
	include "../../../libraries/PHPBD.php";
	
	$print="<table>
					<tr>
						<th>Codigo Zona</th>
						<th>Nombre Zona</th>
						<th>Encargado del Lugar</th>
						<th>Fecha de Cambios</th>
						<th>Fecha de Revisiones</th>
						<th>Reporte Aprobado</th>
					</tr>";
	$finicio = $_GET["finicio"];
	$ffin = $_GET["ffin"];
	$zona = $_GET["zona"];
	$hay=true;
	
	//consulta para obtener los datos
	$bd = new PHPBD();
	$bd->conectar();
	
	$finicio=$bd->formateaFecha($finicio);
	$ffin=$bd->formateaFecha($ffin);
	
	$query = " SELECT cod_zona,des_zona,encargado,fcambio,frevision,reporte 
			   FROM rpttacti4 
			   WHERE ((fcambio BETWEEN '".$finicio."' AND '".$ffin."') OR (frevision BETWEEN '".$finicio."' AND '".$ffin."'))
			   AND cod_zona=".$zona."
			   ORDER BY cod_zona";
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