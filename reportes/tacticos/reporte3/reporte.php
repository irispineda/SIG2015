<?php
	include "../../../libraries/PHPBD.php";
	include "../../../libraries/pdf.php";
	include "../../../libraries/excel.php";
	
	setlocale(LC_ALL,"es_ES");

	$anio = $_POST["anio"];
	$sector = $_POST["sector"];
	$tipo = $_POST["tipo"];
	
	$usuario="root";
	$fecha=date("d/m/Y");
	$hora=date("H:i:s",time());
	
	
	$bd = new PHPBD();
	$bd->conectar();
	
	//evaluar si existen registros continuar sino regresar atras
	$query = ' SELECT cod_sector,des_sector,cod_contribuyente,des_contribuyente,direccion,des_servicio,activo
			   FROM rpttacti3 
			   WHERE anio='.$anio.'
			   AND cod_sector='.$sector.'
			   ORDER BY cod_sector';
	$result = $bd->consultar($query);
	$registros=mysqli_num_rows($result);
	$bd->liberar($result);
	
	if ($registros > 0){
		//extraer datos de la zona
		$query = "SELECT des_sector FROM rpttacti3 WHERE cod_sector = '".$sector."' GROUP BY des_sector ";
		$result = $bd->consultar($query);
		while ($line = mysqli_fetch_array($result, MYSQL_NUM)) {
			$sectorDes = $line[0];
		}
		$bd->liberar($result);
		
		$titulo='REPORTE DEL CONTROL DEL NUMERO DE CONTRIBUYENTES ACTIVOS';
		$parametros='Año: '.$anio.' Zona: '.$sector.' '.$sectorDes;
		$columnas=array('Codigo Sector','Nombre del Sector','Codigo del Contribuyente','Nombre del Contribuyente','Dirección','Servicios que Posee','Activo o No Activo');
		$anchos=array(20,40,40,50,50,45,30);
		
		//encabezados
		if($tipo=="XLS"){
			//reporte en excel
			$xls = new Excel();
			$xls->Encabezado($titulo,$parametros,'6');
			$xls->TablaHeader($columnas,$anchos);
			$fil=6;
		}else{
			//reporte en pdf
			$pdf=new PDF('L');
			$pdf->SetTitle($titulo);
			$pdf->SetAuthor("root");
			$pdf->SetSubject($parametros);
			$pdf->fecha=date("d/m/Y");
			$pdf->hora=date("H:i:s",time());
			$pdf->columnas=$columnas;
			$pdf->anchos=$anchos;
			$pdf->SetAutoPageBreak(true,10);
			$pdf->AliasNbPages();
			$pdf->AddPage();
		}
		
		//consulta para obtener los datos
		$query = ' SELECT cod_sector,des_sector,cod_contribuyente,des_contribuyente,direccion,des_servicio,activo
				   FROM rpttacti3 
				   WHERE anio='.$anio.'
				   AND cod_sector='.$sector.'
				   ORDER BY cod_sector';
		$result = $bd->consultar($query);
		while ($line = mysqli_fetch_array($result, MYSQL_NUM)) {
			//cuerpo del reporte
			if($tipo=="XLS"){
				//reporte en excel
				++$fil;
				$xls->Tabla($line,$anchos,$fil);
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
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="RptTacti3.xlsx"');
			header('Cache-Control: max-age=0');
			 
			$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');
			$objWriter->save('php://output');
			exit;
		}else{
			//reporte en pdf
			$pdf->Output('RptTacti3','I');
		}
	}else{
		$bd->cerrar();
		header('Location: ../../../mensajes/nohaydatos.html');
	}
?>