<?php
	include "../../../libraries/PHPBD.php";
	include "../../../libraries/pdf.php";
	include "../../../libraries/excel.php";
	
	setlocale(LC_ALL,"es_ES");
	
	$finicio = $_POST["finicio"];
	$ffin = $_POST["ffin"];
	$sector = $_POST["sector"];
	$tipo = $_POST["tipo"];
	
	$usuario="root";
	$fecha=date("d/m/Y");
	$hora=date("H:i:s",time());
	
	$bd = new PHPBD();
	$bd->conectar();
	
	//evaluar si existen registros continuar sino regresar atras
	$query = ' SELECT cod_sector,des_sector,cod_contribuyente,tipo_inmueble,direccion,des_servicio 
			   FROM rpttacti1 
			   WHERE fecha BETWEEN '.$finicio.' AND '.$ffin.'
			   AND cod_sector='.$sector.'
			   ORDER BY cod_sector,cod_contribuyente';
	$result = $bd->consultar($query);
	$registros=mysqli_num_rows($result);
	$bd->liberar($result);
	
	if ($registros > 0){
		//extraer datos de la zona
		$query = "SELECT des_sector FROM rpttacti1 WHERE cod_sector = '".$sector."' GROUP BY des_sector ";
		$result = $bd->consultar($query);
		while ($line = mysqli_fetch_array($result, MYSQL_NUM)) {
			$sectorDes = $line[0];
		}
		$bd->liberar($result);
		
		$titulo='INFORME DE PERSONAS CON SERVICIOS DE AGUA Y BIENES INMUEBLES REGISTRADOS';
		$parametros='Fecha de Inicio: '.$finicio.' Fecha de Fin: '.$ffin.' Sector: '.$sector.' '.$sectorDes;
		$columnas=array('Codigo Sector','Nombre del Sector','Codigo Contribuyente','Tipo de Inmueble','Dirección','Servicios que Posee');
		$anchos=array(25,50,38,35,100,30);
		
		//encabezados
		if($tipo=="XLS"){
			//reporte en excel
			$xls = new Excel();
			$xls->Encabezado($titulo,$parametros,'5');
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
		$query = ' SELECT cod_sector,des_sector,cod_contribuyente,tipo_inmueble,direccion,des_servicio 
				   FROM rpttacti1 
				   WHERE fecha BETWEEN '.$finicio.' AND '.$ffin.'
				   AND cod_sector='.$sector.'
				   ORDER BY cod_sector,cod_contribuyente';
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
			header('Content-Disposition: attachment;filename="Rpttacti1.xlsx"');
			header('Cache-Control: max-age=0');
			 
			$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');
			$objWriter->save('php://output');
			exit;
		}else{
			//reporte en pdf
			$pdf->Output('Rpttacti1','I');
		}
	}else{
		$bd->cerrar();
		header('Location: ../../../mensajes/nohaydatos.html');
	}
?>