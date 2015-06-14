<?php
	include "../../../libraries/PHPBD.php";
	include ("../../../libraries/pdf.php");
	
	setlocale(LC_ALL,"es_ES");

	$anio = $_POST["anio"];
	$zona = $_POST["zona"];
	$tipo = $_POST["tipo"];
	
	$usuario="root";
	$fecha=date("d/m/Y");
	$hora=date("H:i:s",time());
	
	$bd = new PHPBD();
	$bd->conectar();
	
	//evaluar si existen registros continuar sino regresar atras
	$query = ' SELECT cod_zona,des_zona,meses,deudor,monto 
			   FROM rptestra1 
			   WHERE anio='.$anio.'
			   AND cod_zona='.$zona.'
			   ORDER BY cod_zona';
	$result = $bd->consultar($query);
	$registros=mysqli_num_rows($result);
	$bd->liberar($result);
	
	if ($registros > 0){
		//extraer datos de la zona
		$query = "SELECT des_zona FROM rptestra1 WHERE cod_zona = '".$zona."' GROUP BY des_zona ";
		$result = $bd->consultar($query);
		while ($line = mysqli_fetch_array($result, MYSQL_NUM)) {
			$zonaDes = $line[0];
		}
		$bd->liberar($result);
		
		//encabezados
		if($tipo=="XLS"){
			//reporte en excel
		}else{
			//reporte en pdf
			$pdf=new PDF('L');
			$pdf->Inicial();
			$pdf->Encabezado('REPORTE DE CONTRIBUYENTES MOROSOS MAYOR A TRES MESES','Año: '.$anio.' Zona: '.$zona.' '.$zonaDes);
			$anchos=array(25,50,35,95,32);
			$pdf->TablaHeader(array('Codigo Zona','Nombre Zona','Meses Adeudados','Nombre del Deudor','Monto Adeudado'),$anchos);
		}
		
		//consulta para obtener los datos
		$query = ' SELECT cod_zona,des_zona,meses,deudor,monto 
				   FROM rptestra1 
				   WHERE anio='.$anio.'
				   AND cod_zona='.$zona.'
				   ORDER BY cod_zona';
		$result = $bd->consultar($query);
		while ($line = mysqli_fetch_array($result, MYSQL_NUM)) {
			//cuerpo del reporte
			if($tipo=="XLS"){
				//reporte en excel
			}else{
				//reporte en pdf
				$pdf->Tabla($line,$anchos);
			}
		}
		$bd->liberar($result);
		
		$bd->cerrar();
		
		//fin del reporte
		if($tipo=="XLS"){
			//reporte en excel
		}else{
			//reporte en pdf
			$pdf->Pie();
			$pdf->Output('RptEstra1','I');
		}
	}else{
		$bd->cerrar();
		header('Location: ../../../mensajes/nohaydatos.html');
	}
?>