<?php

require_once __DIR__ .('/tfpdf/tfpdf.php');
$pdf = new tFPDF;

$pdf->AddFont('ShipporiMincho','','ShipporiMincho-TTF-Regular.ttf',true);

$names = htmlentities($_GET['names'], ENT_QUOTES, "utf-8");
$names = explode("\r\n", $names);

foreach ($names as $name) {

    $pdf->SetFont('ShipporiMincho','',20);
	$pdf->AddPage();

    $pdf->Cell(0,10,"たし算練習プリント");
    $pdf->Ln(5);
    $pdf->Cell(100);
    $pdf->Cell(90,10,"名前 : $name","B");

    $pdf->Ln(40);

    make_contents();
}

$pdf->Output();

 
function make_contents(){	
	global $pdf;
    
	$contents = htmlentities($_GET['contents'], ENT_QUOTES, "utf-8");
	$contents = explode("\r\n", $contents);
    $count = 0; 
    $Y = $pdf->getY();

    foreach ($contents as $content) {
        $count++;
        if($count < 19){
            if($count == 10){
                $pdf->setY($Y);
            }
            if($count >= 10){
                $pdf->setX(110);
            }
            $pdf->SetFont('ShipporiMincho','',25);
            $pdf->Cell(20,10,"({$count})");
            $pdf->SetFont('ShipporiMincho','',30);
            $pdf->Cell(80,10,$content);
            $pdf->Ln(25);
        }else{
            if($count%18 == 1){
                $pdf->SetFont('ShipporiMincho','',20);
                $pdf->AddPage();
                $pdf->setY($Y);
            }elseif($count%18 == 10){
                $pdf->setY($Y);
                $pdf->setX(110);
            }elseif($count%18 >= 11 || $count%18 === 0){
                $pdf->setX(110);
            }
            $pdf->SetFont('ShipporiMincho','',25);
            $pdf->Cell(20,10,"({$count})");
            $pdf->SetFont('ShipporiMincho','',30);
            $pdf->Cell(80,10,$content);
            $pdf->Ln(25);

            $life--;
        }
	}

}

