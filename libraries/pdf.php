<?php
	require ("fpdf/fpdf.php");
	
	setlocale(LC_ALL,"es_ES");
	
	class PDF extends FPDF{
		var $fecha;
		var $hora;
		var $columnas=array();
		var $anchos=array();
		
		function Header(){
			$this->SetFont('Arial','B',20);
			$this->Cell(0,8,utf8_decode('Alcaldía Municipal de Cuyultitán'),0,1,'C');
			
			$this->Image("../../../images/header.jpg",10,8,33);
			
			$this->SetFont('Arial','B',13);
			$this->Cell(0,8,utf8_decode($this->title),0,1,'C');
			
			$this->SetFont('Arial','I',12);
			$this->Cell(0,8,utf8_decode($this->subject),0,0,'C');
			
			$this->SetFont('Arial','',8);
			session_start();
			$this->SetAuthor($_SESSION['User']);
			$this->Cell(0,4,'Usuario: '.utf8_decode($this->author),0,1,'R');
			$this->Cell(0,4,'Fecha: '.$this->fecha,0,1,'R');
			$this->Cell(0,4,'Hora: '.$this->hora,0,1,'R');
			$this->Ln();
			
			$this->SetFont('Arial','B',8);
			$i=0;
			foreach($this->columnas as $col){
				$ancho=$this->anchos[$i];
				$this->Cell($ancho,7,utf8_decode($col),1,0,'C');
				++$i;
			}
			$this->Ln();
		}
		
		function Footer(){
			$this->SetY(-10);
			$this->SetFont('Arial','I',8);
			$this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'C');
		}
		
		//datos de tabla
		function Tabla($datos,$size){
			$this->SetFont('Arial','',6);
			$i=0;
			foreach($datos as $col){
				$ancho=$size[$i];
				$this->Cell($ancho,7,utf8_decode($col),1,0,'L');
				++$i;
			}
			$this->Ln();
		}
	}
?>