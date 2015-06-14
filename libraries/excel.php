<?php
	require ("PHPExcel/PHPExcel.php");
	
	setlocale(LC_ALL,"es_ES");
	
	class EXCEL extends PHPExcel{
		
		//seteos iniciales
		function Inicial(){
			
		}
		
		//cabecera de pagina
		function Encabezado($titulo,$param){
			$usuario="root";
			$fecha=date("d/m/Y");
			$hora=date("H:i:s",time());
			
			/*$this->SetFont('Arial','B',20);
			$this->Cell(0,8,utf8_decode('Alcaldía Municipal de Cuyultitán'),0,1,'C');
			
			$this->Image("../../../images/header.jpg",10,8,33);
			
			$this->SetFont('Arial','B',16);
			$this->Cell(0,8,utf8_decode($titulo),0,1,'C');
			
			$this->SetFont('Arial','I',14);
			$this->Cell(0,8,utf8_decode($param),0,0,'C');
			
			$this->SetFont('Arial','',8);
			$this->Cell(0,4,'Usuario: '.utf8_decode($usuario),0,1,'R');
			$this->Cell(0,4,'Fecha: '.$fecha,0,1,'R');
			$this->Cell(0,4,'Hora: '.$hora,0,1,'R');
			
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
			/*$this->SetFont('Arial','B',10);
			$i=0;
			foreach($header as $col){
				$ancho=$size[$i];
				$this->Cell($ancho,7,utf8_decode($col),1,0,'C');
				++$i;
			}
			$this->Ln();*/
		}
		
		//datos de tabla
		function Tabla($datos,$size){
			/*$this->SetFont('Arial','',10);
			$i=0;
			foreach($datos as $col){
				$ancho=$size[$i];
				$this->Cell($ancho,7,utf8_decode($col),1,0,'L');
				++$i;
			}
			$this->Ln();*/
		}
	}
?>