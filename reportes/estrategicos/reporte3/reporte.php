<?php
	include "../../../libraries/PHPBD.php";
	include "../../../libraries/pdf.php";
	include "../../../libraries/excel.php";
	
	setlocale(LC_ALL,"es_ES");

	$anio = $_POST["anio"];
	$tipo = $_POST["tipo"];
	
	$usuario="root";
	$fecha=date("d/m/Y");
	$hora=date("H:i:s",time());
	
	
	$bd = new PHPBD();
	$bd->conectar();
	
	//evaluar si existen registros continuar sino regresar atras
	$query = ' SELECT cod_municipio,des_municipio,cod_sector,des_sector,tasaact,tasaant 
			   FROM rptestra3 
			   WHERE anio='.$anio.'
			   ORDER BY cod_municipio';
	$result = $bd->consultar($query);
	$registros=mysqli_num_rows($result);
	$bd->liberar($result);
	
	if ($registros > 0){
		
		$titulo='REPORTE DE ACTUALIZACION DE SALDOS E IMPUESTOS Y TASAS POR AÑO';
		$parametros='Año: '.$anio;
		$columnas=array('Codigo Municipio','Nombre Municipio','Codigo Sector','Nombre del Sector','Tasa Actual','Tasa Nueva');
		$anchos=array(30,70,35,70,35,35);
		
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
		$query = ' SELECT cod_municipio,des_municipio,cod_sector,des_sector,tasaact,tasaant 
				   FROM rptestra3 
				   WHERE anio='.$anio.'
				   ORDER BY cod_municipio';
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