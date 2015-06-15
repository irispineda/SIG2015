<?php
	include "../../../libraries/PHPBD.php";
	include "../../../libraries/pdf.php";
	include "../../../libraries/excel.php";
	
	setlocale(LC_ALL,"es_ES");

	$servicio = $_POST["servicio"];
	$tipo = $_POST["tipo"];
	
	$usuario="root";
	$fecha=date("d/m/Y");
	$hora=date("H:i:s",time());
	
	
	$bd = new PHPBD();
	$bd->conectar();
	
	//evaluar si existen registros continuar sino regresar atras
	$query =  'SELECT cod_local,des_local,arrendador,tipo_contrato,monto
			   FROM rptestra6 
			   WHERE cod_servicio='.$servicio.'
			   ORDER BY cod_local';
	$result = $bd->consultar($query);
	$registros=mysqli_num_rows($result);
	$bd->liberar($result);
	
	if ($registros > 0){
		//extraer datos de la zona
		$query = "SELECT des_servicio FROM rptestra6 WHERE cod_servicio = '".$servicio."' GROUP BY des_servicio ";
		$result = $bd->consultar($query);
		while ($line = mysqli_fetch_array($result, MYSQL_NUM)) {
			$servicioDes = $line[0];
		}
		$bd->liberar($result);
		
		$titulo='REPORTE DE LOCALES ARRENDADOS POR LA MUNICIPALIDAD POR TIPO DE SERVICIO';
		$parametros='Servicio: '.$servicio.' '.$servicioDes;
		$columnas=array('Codigo Local','Nombre del Local','Tipo del Local','Nombre del Arrendador','Tipo del Contrato','Monto a Pagar');
		$anchos=array(20,60,30,70,65,30);
		
		//encabezados
		if($tipo=="XLS"){
			//reporte en excel
			$xls = new Excel();
			$xls->Encabezado($titulo,$parametros,'4');
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
		$query = ' SELECT cod_local,des_local,tipo_local,arrendador,tipo_contrato,monto
				   FROM rptestra6 
				   WHERE cod_servicio='.$servicio.'
				   ORDER BY cod_local';
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
			header('Content-Disposition: attachment;filename="RptEstra1.xlsx"');
			header('Cache-Control: max-age=0');
			 
			$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');
			$objWriter->save('php://output');
			exit;
		}else{
			//reporte en pdf
			$pdf->Output('RptEstra1','I');
		}
	}else{
		$bd->cerrar();
		header('Location: ../../../mensajes/nohaydatos.html');
	}
?>