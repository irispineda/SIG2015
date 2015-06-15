<?php 
	include "../../../libraries/PHPBD.php";
	
	$print="<table>
					<tr>
						<th>Codigo Zona</th>
						<th>Nombre Zona</th>
						<th>Codigo Contribuyente</th>
						<th>Nombre Contribuyente</th>
						<th>Fecha Inicio</th>
						<th>Fecha Final</th>
						<th>Monto</th>
						<th>Saldo</th>
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
	
	$query = " SELECT cod_zona,des_zona,cod_contribuyente,des_contribuyente,finicio,ffin,monto,saldo
			   FROM rptestra2 
			   WHERE ((finicio BETWEEN '".$finicio."' AND '".$ffin."') OR (ffin BETWEEN '".$finicio."' AND '".$ffin."'))
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
					<td>$line[6]</td>
					<td>$line[7]</td>
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