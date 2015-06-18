<?php
	require ("PHPExcel/PHPExcel.php");
	
	setlocale(LC_ALL,"es_ES");
	
	class Excel extends PHPExcel{
		
		
		//seteos iniciales
		function Inicial(){
			
		}
		
		//cabecera de pagina
		function Encabezado($titulo,$param,$col){
			session_start();
			$usuario=$_SESSION['User'];
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
			
			$sheet = $this->getActiveSheet();
			$styleArray = array('font'		=>array('bold'=>true,'size'=>20),
								'alignment'	=>array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
			$sheet->getStyle('B1')->applyFromArray($styleArray);
			
			$styleArray = array('font'		=>array('bold'=>true,'size'=>16),
								'alignment'	=>array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
			$sheet->getStyle('B2')->applyFromArray($styleArray);
			
			$styleArray = array('font'		=>array('italic'=>true,'size'=>14),
								'alignment'	=>array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
			$sheet->getStyle('B3')->applyFromArray($styleArray);
			
			$styleArray = array('font'		=>array('size'=>8),
								'alignment'	=>array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
			$sheet->getStyle($cols[$col].'1:'.$cols[$col].'3')->applyFromArray($styleArray);
			
			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setName('Logo');
			$objDrawing->setDescription('Logo');
			$logo = '../../../images/header.jpg'; // Provide path to your logo file
			$objDrawing->setPath($logo);  //setOffsetY has no effect
			$objDrawing->setCoordinates('A1');
			$objDrawing->setHeight(100); // logo height
			$objDrawing->setWorksheet($this->getActiveSheet());
			
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
				
				$sheet = $this->getActiveSheet();
				$default_border = array('style' => PHPExcel_Style_Border::BORDER_THIN,
										'color' => array('rgb'=>'000000'));
				$styleArray = array('font'		=>array('bold'=>true,'size'=>10),
									'alignment'	=>array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER),
									'borders' 	=>array('bottom'	=> $default_border,
														'left' 		=> $default_border,
														'top' 		=> $default_border,
														'right' 	=> $default_border,));
				$sheet->getStyle($cols[$i].'6')->applyFromArray($styleArray);
				
				++$i;
			}
		}
		
		//datos de tabla
		function Tabla($datos,$size,$fil){
			$cols=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			
			$i=0;
			foreach($datos as $col){
				$this->setActiveSheetIndex(0)
					 ->setCellValue($cols[$i].$fil, utf8_decode($col));
				
				$sheet = $this->getActiveSheet();
				$default_border = array('style' => PHPExcel_Style_Border::BORDER_THIN,
										'color' => array('rgb'=>'000000'));
				$styleArray = array('font'		=>array('size'=>10),
									'alignment'	=>array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER),
									'borders' 	=>array('bottom'	=> $default_border,
														'left' 		=> $default_border,
														'top' 		=> $default_border,
														'right' 	=> $default_border,));
				$sheet->getStyle($cols[$i].$fil)->applyFromArray($styleArray);
				 
				 ++$i;
			}
		}
	}
?>