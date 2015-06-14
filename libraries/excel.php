<?php
	require ("PHPExcel/PHPExcel.php");
	
	setlocale(LC_ALL,"es_ES");
	
	class Excel extends PHPExcel{
		
		
		//seteos iniciales
		function Inicial(){
			
		}
		
		//cabecera de pagina
		function Encabezado($titulo,$param,$col){
			$usuario="root";
			$fecha=date("d/m/Y");
			$hora=date("H:i:s",time());
			
			$cols=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			
			
			
			$this->setActiveSheetIndex(0)
				 ->mergeCells('B1:'.$cols[$col-1].'1')
				 ->mergeCells('B2:'.$cols[$col-1].'2')
				 ->mergeCells('B3:'.$cols[$col-1].'3');
			
			$this->setActiveSheetIndex(0)
				 ->setCellValue('B1', /*utf8_decode(*/'Alcaldía Municipal de Cuyultitán'/*)*/)
				 ->setCellValue('B2', $titulo)
				 ->setCellValue('B3', $param)
				 ->setCellValue($cols[$col].'1', 'Usuario: '.$usuario)
				 ->setCellValue($cols[$col].'2', 'Fecha: '.$fecha)
				 ->setCellValue($cols[$col].'3', 'Hora: '.$hora);
			
			
			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setName('Logo');
			$objDrawing->setDescription('Logo');
			$logo = '../../../images/header.jpg'; // Provide path to your logo file
			$objDrawing->setPath($logo);  //setOffsetY has no effect
			$objDrawing->setCoordinates('A1');
			$objDrawing->setHeight(60); // logo height
			$objDrawing->setWorksheet($this->getActiveSheet());
			
			/*$this->SetFont('Arial','B',20);
			$this->Cell(0,8,,0,1,'C');
			
			$this->Image("../../../images/header.jpg",10,8,33);
			
			$this->SetFont('Arial','B',16);
			$this->Cell(0,8,utf8_decode($titulo),0,1,'C');
			
			$this->SetFont('Arial','I',14);
			$this->Cell(0,8,utf8_decode($param),0,0,'C');
			
			$this->SetFont('Arial','',8);
			
			$this->SetFont('Arial','B',12);
			$this->Cell(0,10,'',0,1,'C');*/
		}
		
		//pie de pagina
		function Pie(){
			/*$this->SetY(-20);
			$this->SetFont('Arial','I',8);
			$this->Cell(0,10,'Pag. '.$this->PageNo(),0,0,'C');*/
		}
		
		//encabezado de tabla
		function TablaHeader($header,$size){
			$cols=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			
			$i=0;
			foreach($header as $col){
				$this->setActiveSheetIndex(0)
				     ->setCellValue($cols[$i].'6', utf8_decode($col));
				$this->getActiveSheet()->getColumnDimensionByColumn($i)->setWidth($size[$i]-10);
				++$i;
			}
			
			/*$this->SetFont('Arial','B',10);*/
		}
		
		//datos de tabla
		function Tabla($datos,$size,$fil){
			$cols=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			
			$i=0;
			foreach($datos as $col){
				$this->setActiveSheetIndex(0)
				 ->setCellValue($cols[$i].$fil, utf8_decode($col));
				 ++$i;
			}
			/*$this->SetFont('Arial','',10);*/
		}
	}
?>