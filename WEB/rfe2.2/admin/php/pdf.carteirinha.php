<?php
/*========================================================================
Objetivo: Compõe a carteirinha dos membros.
   Autor: Filipe Fonseca    17/09/2013
Revisões: 
========================================================================*/

require("func_mysqlexec.php");
require("fpdf/fpdf.php");

$query = "SELECT sexo FROM bco_membros WHERE id=".$_GET["id"];
$query = mysqlexec($sqlconn,$query);

if (mysql_num_rows($query) == 1) {

	if (mysql_result($query,0,"sexo") == 1) {
		$query = "SELECT bc.nome AS congreg,bm.nome,DATE_FORMAT(bm.datanasc,'%d/%m/%Y') AS datanasc,IFNULL(DATE_FORMAT(bm.databtsm,'%d/%m/%Y'),'inexistente') AS databtsm,bm.nomemae,IFNULL(bm.nomepai,'-') AS nomepai,bm.naturalidade,tec.nomemasc AS estcivil,UPPER(tfe.nomemasc) AS funcecles
			FROM bco_membros AS bm
			LEFT JOIN bco_congregacoes AS bc ON bc.id = bm.congreg
			LEFT JOIN tbl_funcoeseclesiasticas AS tfe ON tfe.id = bm.funcecles
			LEFT JOIN tbl_estcivil AS tec ON tec.id = bm.estcivil
			WHERE bm.id=".$_GET["id"];
		$query = mysqlexec($sqlconn,$query);
	} else {
		$query = "SELECT bc.nome AS congreg,bm.nome,DATE_FORMAT(bm.datanasc,'%d/%m/%Y') AS datanasc,IFNULL(DATE_FORMAT(bm.databtsm,'%d/%m/%Y'),'inexistente') AS databtsm,bm.nomemae,IFNULL(bm.nomepai,'-') AS nomepai,bm.naturalidade,tec.nomefem AS estcivil,UPPER(tfe.nomefem) AS funcecles
			FROM bco_membros AS bm
			LEFT JOIN bco_congregacoes AS bc ON bc.id = bm.congreg
			LEFT JOIN tbl_funcoeseclesiasticas AS tfe ON tfe.id = bm.funcecles
			LEFT JOIN tbl_estcivil AS tec ON tec.id = bm.estcivil
			WHERE bm.id=".$_GET["id"];
		$query = mysqlexec($sqlconn,$query);
	}

	// Definição do documento
	$pdf = new FPDF('L','mm',array(204,68));
	$pdf->AddFont('calibri','','calibri.php');
	$pdf->AddFont('calibrib','','calibrib.php');
	$pdf->SetMargins(0,0,0);
	$pdf->SetAutoPageBreak(true,0);
	$pdf->AddPage();


	// Fotografia
	$pdf->Image('../imagens/carteirinha.png',0,0,204,68,"PNG");

	if (file_exists('../imagens/membros/'.$_GET["id"].'.jpg')) {
		$pdf->Image('../imagens/membros/'.$_GET["id"].'.jpg',70.7,26.4,30,40);
	} else {
		$pdf->Image('../imagens/membros/0.jpg',70.7,26.4,30,40);
	}

	// Função Eclesiástica
	$pdf->SetFont('Calibrib','',12);
	$pdf->SetTextColor(255,0,0);
	$pdf->SetXY(2.8,26.8);
	$pdf->Cell(66.7,7.2,utf8_decode(mysql_result($query,0,'funcecles')),0,0,'C');

	// Nome do Membro
	$pdf->SetFont('Calibri','',10);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetXY(2.8,37.6);
	$pdf->Cell(66.7,7.2,utf8_decode(mysql_result($query,0,'nome')),0,0,'C');

	// Validade
	$pdf->SetFont('Calibrib','',12);
	$pdf->SetTextColor(255,0,0);
	$pdf->SetXY(2.8,49.7);
	$pdf->Cell(30,7.2,date("d/m/Y",strtotime("+1 year")),0,0,'C');

	// Matrícula
	$pdf->SetFont('Calibrib','',12);
	$pdf->SetTextColor(255,0,0);
	$pdf->SetXY(39.5,49.7);
	$pdf->Cell(30,7.2,sprintf("%05s",$_GET["id"]),0,0,'C');

	// Filiação
	$pdf->SetFont('Calibri','',10);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetXY(103.7,4.2);
	$pdf->MultiCell(98.5,7.2,utf8_decode(mysql_result($query,0,'nomemae'))."\n".utf8_decode(mysql_result($query,0,'nomepai')),0,'L');

	// Naturalidade
	$pdf->SetFont('Calibri','',10);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetXY(103.7,23);
	$pdf->Cell(98.5,7.2,utf8_decode(mysql_result($query,0,'naturalidade')),0,0,'L');

	// Data de Nascimento
	$pdf->SetFont('Calibri','',10);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetXY(103.7,34.5);
	$pdf->Cell(48.4,7.2,utf8_decode(mysql_result($query,0,'datanasc')),0,0,'C');

	// Data de Batismo
	$pdf->SetFont('Calibri','',10);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetXY(153.8,34.5);
	$pdf->Cell(48.4,7.2,utf8_decode(mysql_result($query,0,'databtsm')),0,0,'C');

	// Estado Civil
	$pdf->SetFont('Calibri','',10);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetXY(103.7,45.7);
	$pdf->Cell(48.4,7.2,utf8_decode(mysql_result($query,0,'estcivil')),0,0,'L');
	
	// Congregação
	$pdf->SetFont('Calibrib','',10);
	$pdf->SetTextColor(255,0,0);
	$pdf->SetXY(153.8,45.7);
	$pdf->Cell(48.4,7.2,utf8_decode(mysql_result($query,0,'congreg')),0,0,'C');

	$pdf->Output();
	
} else {

	// Definição do documento
	$pdf = new FPDF('L','mm',array(20,6));
	$pdf->AddFont('calibri','','calibri.php');
	$pdf->AddFont('calibrib','','calibrib.php');
	$pdf->SetMargins(0,0,0);
	$pdf->SetAutoPageBreak(true,0);
	$pdf->AddPage();
	
	$pdf->SetFont('Calibrib','',5);
	$pdf->SetTextColor(255,0,0);
	$pdf->SetXY(0,0);
	$pdf->Cell(20,6,utf8_decode("Membro não encontrado!"),0,0,'C',true);
	$pdf->Output();

}

?>