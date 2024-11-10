<?php

include ("../Common/functions.php");
$USER_ID = $_SESSION["USER_ID"];
	$USER_PSW = $_SESSION["USER_PSW"];
	$USER_TYPE = $_SESSION["USER_TYPE"];
	
	if( empty($USER_ID) || empty($USER_PSW) || ($USER_TYPE != 2 && $USER_TYPE != 3 && $USER_TYPE != 5))
	{
		header("Location: ../index.php?msg=2");
		exit();
	}
session_start();
$pdfcontent=0;
//$_SESSION["holiday41"] = GET_EMP($_GET['no']);
//$_SESSION["holiday41"] = $_GET['year'];
$_SESSION["Daily_Report"] =  Daily_Report_Form($_GET['df'], $_GET['dt'],$_GET['USER_FULL_NAME'],$_GET['BORN_DETAILS_BIRTH_PLACE_CD'],$_GET['BORN_DETAILS_HEALTH_CENTER_CD']);
//echo $_SESSION["holiday41"];

//============================================================+
// File name   : example_018.php
// Begin       : 2008-03-06
// Last Update : 2009-09-30
// 
// Description : Example 018 for TCPDF class
//               RTL document with Persian language
// 
// Author: Nicola Asuni
// 
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com s.r.l.
//               Via Della Pace, 11
//               09044 Quartucciu (CA)
//               ITALY
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: RTL document with Persian language
 * @author Nicola Asuni
 * @copyright 2004-2009 Nicola Asuni - Tecnick.com S.r.l (www.tecnick.com) Via Della Pace, 11 - 09044 - Quartucciu (CA) - ITALY - www.tecnick.com - info@tecnick.com
 * @link http://tcpdf.org
 * @license http://www.gnu.org/copyleft/lesser.html LGPL
 * @since 2008-03-06
 */

require_once('../../tcpdf/config/lang/eng.php');
require_once('../../tcpdf/tcpdf.php');

class MYPDF extends TCPDF {
    //Page header
    public function Header() {
        // Logo
        $this->Image(K_PATH_IMAGES.'tcpdf_logo.jpg', 150, 5, 15,'','','','C');
		
        // Set font
        $this->SetFont('almohanad', 'B', 14);//header font
        // Title
		
        $this->Cell(0, 5, 'السلطة الوطنية الفلسطينية', 0, 0, 'R');
		$this->Cell(0, 5, 'Palestinian National Authority ', 0, 1, 'L');
		$this->Cell(0, 5, 'وزارة الصحــة الفلسطينية', 0, 0, 'R');
		$this->Cell(0, 5, 'Palestinian Ministry of Health ', 0, 1, 'L');
	   		
		
        // Line break
        $this->Ln(10);
		//$this->MultiCell(0,10, 'السلطة الوطنية الفلسطينية', 0, 'ٌٌٌR', 0, 1, '', '', true, 0, false);
		
		$ormargins = $this->getOriginalMargins();
		$imgy = $this->getImageRBY();
		$this->SetLineStyle(array('width' => 0.85 / $this->getScaleFactor(), 'cap' => 'butt', 'join' => 'miter',
		 'dash' => 0, 'color' => array(0, 0, 0)));
			$this->SetY(23);
			if ($this->getRTL()) {
				$this->SetX($ormargins['right']);
			} else {
				$this->SetX($ormargins['left']);
			}
			$this->Cell(0, 0, '', 'T', 1, 'C');
			$this->SetFont('almohanad', 'B', 16);
			//$this->Cell(185, 5, 'تقرير الإجازات', 0, 1, 'C');
			
    }
    
    // Page footer
    public function Footer() {
	 		$ormargins = $this->getOriginalMargins();
		$imgy = $this->getImageRBY();
			$this->SetLineStyle(array('width' => 0.85 / $this->getScaleFactor(), 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
			$this->SetY(-15);
			if ($this->getRTL()) {
				$this->SetX($ormargins['right']);
			} else {
				$this->SetX($ormargins['left']);
			}
			$this->Cell(0, 0, '', 'T', 1, 'C');
    

        // Position at 1.5 cm from bottom
      //  $this->SetY(-15);
        // Set font
        $this->SetFont('almohanad', 'B', 8);
        // Page number
		$this->Cell(0, 0, 'تقارير خاصة بالمواليد', 0, 0, 'ٌٌR');
		$this->Cell(0, 0, 'http://www.moh.gov.ps/borns/', 0, 1, 'L');
       $this->Cell(0, 0, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 0, 'C');
	   
		//$this->Ln(0.85);
		
    }
	
}


// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('MOH');
$pdf->SetTitle('Ministry Of Health');
$pdf->SetSubject('Personal Information');
$pdf->SetKeywords('Perosnal, Information, Personal Information');


// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "وزارة الصحة الفلسطينية ", PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 

// set some language dependent data:
$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'rtl';
$lg['a_meta_language'] = 'fa';
$lg['w_page'] = 'page';

//set some language-dependent strings
$pdf->setLanguageArray($lg); 
// ---------------------------------------------------------
// add a page
$pdf->AddPage('L','A4');

// Restore RTL direction
$pdf->setRTL(true);

$pdf->Ln(0);

$pdf->SetFont('almohanad', '', 10);
if ($pdfcontent==0)
$htmlcontent = $_SESSION["Daily_Report"]; 

$pdf->WriteHTML($htmlcontent, true, 0, true, 0);

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('pdf.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+
?>
