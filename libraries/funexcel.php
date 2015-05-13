<?php

	function CellValue( $Sheet, $pCel, $pVal='', $pTipo='G' ){
		switch (trim($pTipo)):
			case 'G' : $Sheet->setCellValue($pCel,$pVal); break;
			case 'T' : $Sheet->setCellValueExplicit($pCel,$pVal,PHPExcel_Cell_DataType::TYPE_STRING); break;
			case 'M' : $Sheet->setCellValue($pCel,$pVal);
				$Sheet->getStyle($pCel)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE); break;
		endswitch; $Sheet->getStyle($pCel)->getAlignment()->setWrapText(true); return $Sheet;
	};
	
	function CellWigth( $Sheet, $pCel, $pWidth ){
		$Sheet->getColumnDimension($pCel)->setWidth(floatval($pWidth));
		return $Sheet;
	};
	
	function CellFormat( $Sheet, $pCel, $pTipo = 'G' ){
		$SFmt = $Sheet->getStyle($pCel)->getNumberFormat();
		switch (trim($pTipo)):
			case "G" : $SFmt->setFormatCode('General'); 		break;
			case "T" : $SFmt->setFormatCode('@'); 					break;
			case "N1": $SFmt->setFormatCode('0'); 					break;
			case "N2": $SFmt->setFormatCode('0.00'); 				break;
			case "N3": $SFmt->setFormatCode('#,##0.00'); 		break;
			case "N4": $SFmt->setFormatCode('#,##0.00_-'); 	break;
			case "P1": $SFmt->setFormatCode('0%'); 					break;
			case "P2": $SFmt->setFormatCode('0.00%'); 			break;
		endswitch; return $Sheet;
	};
	
	function CellFont( $Sheet, $pCel, $pBold, $pAlign = 'L', $pSize = 11 ){
		$Sheet->getStyle($pCel)->applyFromArray(
			array('font' => array(
				'bold' => $pBold,
				'size' => $pSize
			))
		);
		CellAlign($Sheet, $pCel, $pAlign = 'L');
		return $Sheet;
	};
	
	function CellAlign( $Sheet, $pCel, $pX = 'L', $pY = 'C' ){
		$lAlignH = array( 
				'L'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT
			, 'C'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER
			, 'R'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
			, 'J'=>PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY
		);
		$lAlignV = array( 
				'B'=>PHPExcel_Style_Alignment::VERTICAL_BOTTOM
			, 'T'=>PHPExcel_Style_Alignment::VERTICAL_TOP
			, 'C'=>PHPExcel_Style_Alignment::VERTICAL_CENTER
			, 'J'=>PHPExcel_Style_Alignment::VERTICAL_JUSTIFY
		);
		$Sheet->getStyle($pCel)->applyFromArray(
			array(
					'alignment' => array(
					'rotation'   => 0,
					'horizontal' => $lAlignH[strtoupper($pX)],
					'vertical' 	 => $lAlignV[strtoupper($pY)]
				)
			)
		);
		
		return $Sheet;
	}
	
	function CellBorder( $Sheet, $pCel, $pBold = false, $pBorderColor = '000000', $pStyleBorderI = 'T', $pStyleBorderO = 'T' ){
		switch (trim($pStyleBorderI)):
			case "T" : $SBorderI = PHPExcel_Style_Border::BORDER_THIN; break;
			case "D" : $SBorderI = PHPExcel_Style_Border::BORDER_MEDIUM; break;
			case "N" : $SBorderI = PHPExcel_Style_Border::BORDER_NONE; break;
		endswitch;
		switch (trim($pStyleBorderO)):
			case "T" : $SBorderO = PHPExcel_Style_Border::BORDER_THIN; break;
			case "D" : $SBorderO = PHPExcel_Style_Border::BORDER_MEDIUM; break;
			case "N" : $SBorderO = PHPExcel_Style_Border::BORDER_NONE; break;
		endswitch;
		$Sheet->getStyle($pCel)->applyFromArray(
			array(
					'font' => array( 'bold' => $pBold )
				, 'borders' => array(
					'inside'  => array( 'style' => $SBorderI, 'color' => array('rgb' => $pBorderColor) ),
					'outline' => array( 'style' => $SBorderO, 'color' => array('rgb' => $pBorderColor) )
				)
			)
		);
		
		return $Sheet;
	};
	
	function CellColor( $Sheet, $pCel, $pColor = 'D9D9D9' ){
		$Sheet->getStyle($pCel)->applyFromArray(
			array(
					'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'rotation' => 90,
					'color' => array( 'rgb' => $pColor ),
					'startcolor' => array( 'rgb' => $pColor ),
					'endcolor' => array( 'rgb' => $pColor )
				)
			)
		);
		
		return $Sheet;
	};
	
	function HeaderStyle01( $Sheet, $pCel, $pBold = true, $pAlign = 'C', $pBorderColor = '000000', $pRGB = 'D9D9D9', $pSize = 11 ){
		CellColor($Sheet,$pCel,$pRGB); CellBorder($Sheet,$pCel,$pBorderColor); CellFont($Sheet,$pCel,$pBold,$pAlign,$pSize);
		$Sheet->getStyle($pCel)->getAlignment()->setWrapText(true); # ESTA LINEA ES PARA AJUSTAR EL TEXTO EN LA CELDA
		return $Sheet;
	};

?>