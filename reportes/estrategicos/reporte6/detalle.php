<?php 
	include "../../../libraries/PHPBD.php";
	
	$print="<table>
					<tr>
						<th>Codigo Local</th>
						<th>Nombre del Local</th>
						<th>Tipo del Local</th>
						<th>Nombre del Arrendador</th>
						<th>Tipo del Contrato</th>
						<th>Monto a Pagar</th>
					</tr>";
	$servicio = $_GET["servicio"];
	$hay=true;
	
	//consulta para obtener los datos
	$bd = new PHPBD();
	$bd->conectar();
	$query = ' SELECT cod_local,des_local,tipo_local,arrendador,tipo_contrato,monto
			   FROM rptestra6 
			   WHERE cod_servicio='.$servicio.'
			   ORDER BY cod_local';
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