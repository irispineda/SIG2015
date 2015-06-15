<?php 
	include "../../../libraries/PHPBD.php";
	
	$print="<table>
					<tr>
						<th>Codigo Contribuyente</th>
						<th>Nombre Contribuyente</th>
						<th>Monto Pagado</th>
					</tr>";
	$fecha = $_GET["fecha"];
	$hay=true;
	
	//consulta para obtener los datos
	$bd = new PHPBD();
	$bd->conectar();
	
	$fecha=$bd->formateaFecha($fecha);
	
	$query = " SELECT cod_contribuyente,des_contribuyente,monto 
			   FROM rptestra5 
			   WHERE fecha='".$fecha."'
			   ORDER BY cod_contribuyente";
	$result = $bd->consultar($query);
	while ($line = mysqli_fetch_array($result, MYSQL_NUM)) {
		$hay=false;
		$print .= "<tr>
					<td>$line[0]</td>
					<td>$line[1]</td>
					<td>$line[2]</td>
				</tr>";
	}
	$bd->liberar($result);
	$bd->cerrar();
	
	if ($hay){
		$print .= "<tr><td colspan=3><center>NO EXISTE INFORMACION</center></td></tr>";
	}
	$print .= '</table>';
	
	echo $print;
?>