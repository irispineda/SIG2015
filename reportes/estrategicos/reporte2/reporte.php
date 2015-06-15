<?php
	include "../../../libraries/PHPBD.php";
	include "../../../libraries/pdf.php";
	include "../../../libraries/excel.php";
	
	setlocale(LC_ALL,"es_ES");

	$finicio = $_POST["finicio"];
	$ffin = $_POST["ffin"];
	$zona = $_POST["zona"];
	$tipo = $_POST["tipo"];
	
	$usuario="root";
	$fecha=date("d/m/Y");
	$hora=date("H:i:s",time());
	
	
	$bd = new PHPBD();
	$bd->conectar();
	
	$finicio=$bd->formateaFecha($finicio);
	$ffin=$bd->formateaFecha($ffin);
	
	//evaluar si existen registros continuar sino regresar atras
	$query = " SELECT cod_zona,des_zona,cod_contribuyente,des_contribuyente,finicio,ffin,monto,saldo
			   FROM rptestra2 
			   WHERE ((finicio BETWEEN '".$finicio."' AND '".$ffin."') OR (ffin BETWEEN '".$finicio."' AND '".$ffin."'))
			   AND cod_zona=".$zona."
			   ORDER BY cod_zona";
	$result = $bd->consultar($query);
	$registros=mysqli_num_rows($result);
	$bd->liberar($result);
	
	if ($registros > 0){
		//extraer datos de la zona
		$query = "SELECT des_zona FROM rptestra2 WHERE cod_zona = '".$zona."' GROUP BY des_zona ";
		$result = $bd->consultar($query);
		while ($line = mysqli_fetch_array($result, MYSQL_NUM)) {
			$zonaDes = $line[0];
		}
		$bd->liberar($result);
		
		$titulo='CONTROL DE CONVENIOS DE PAGOS POR PERIODO';
		$parametros='Fecha de Inicio: '.$finicio.' Fecha de Fin: '.$ffin.' Zona: '.$zona.' '.$zonaDes;
		$columnas=array('Codigo Zona','Nombre Zona','Codigo Contribuyente','Nombre Contribuyente','Fecha Inicio','Fecha Final','Monto','Saldo');
		$anchos=array(20,50,35,100,20,20,15,15);
		
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
		$query = " SELECT cod_zona,des_zona,cod_contribuyente,des_contribuyente,finicio,ffin,monto,saldo
				   FROM rptestra2 
				   WHERE ((finicio BETWEEN '".$finicio."' AND '".$ffin."') OR (ffin BETWEEN '".$finicio."' AND '".$ffin."'))
				   AND cod_zona=".$zona."
				   ORDER BY cod_zona";
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