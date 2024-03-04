<?php session_start();
require_once('controller/crudFunctions.php');
$crudObj = new CrudOparation;
$report_data = $crudObj->dynamic_query("SELECT * FROM vd_report WHERE id=".$_GET['id']." ");

// $user_id = $_SESSION['vd']['uid'];
$user_id = $_SESSION["user_id"];
$where_user = array('ID'=>$user_id);
$get_user = $crudObj->select_record('vd_user_sex,vd_user_1_name,vd_user_2_name',$where_user,'vd_user');
$full_name = $get_user[0]['vd_user_1_name'].' '.$get_user[0]['vd_user_2_name'];

$strengths = json_decode($report_data[0]['strengths']);
$str_strengths = "";
foreach($strengths as $strength){
    $str_strengths .= $strength.'.';
}

$difficulties = json_decode($report_data[0]['difficulties']);
$str_difficulties = "";
foreach($difficulties as $difficulty){
    $str_difficulties .= $difficulty.'.';
}

$array_support_1 = json_decode($report_data[0]['support_1']);
$support_1 = $array_support_1[0];

$array_support_2 = $report_data[0]['support_2'];
if($array_support_2 != ""){
    $array_support_2 = json_decode($report_data[0]['support_2']);
    $support_2 = $array_support_2[0];
}

$goals_1 = $report_data[0]['goals_1'];
if($goals_1 != ""){
    $goals_1 = json_decode($goals_1);
    $str_goals_1 = "";
    foreach($goals_1 as $goal){
        $str_goals_1 .= $goal.'.';
    }
}

$goals_2 = $report_data[0]['goals_2'];
if($goals_2 != ""){
    $goals_2 = json_decode($goals_2);
    $str_goals_2 = "";
    foreach($goals_2 as $goal){
        $str_goals_2 .= $goal.'.';
    }
}

$compensations = $report_data[0]['compensations'];
if($compensations != ""){
    $compensations = json_decode($compensations);
    $str_compensations = "";
    foreach($compensations as $compensation){
        $str_compensations .= $compensation.'.';
    }
}

require_once('assets/vendor/tcpdf/examples/tcpdf_include.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// Disable the header
$pdf->SetPrintHeader(false);
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 14);


// ROW 1
$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(0, 0, 0);

$x = $pdf->GetX();
$y = $pdf->GetY();
$text = "Individueller Förderplan für: ".$report_data[0]['ID_pupil'];
$pdf->Text($x, $y+1.5, $text);

$x1 = $pdf->GetX();
$y1 = $pdf->GetY();
$pdf->SetXY($x1-190, $y1-1.5);
$pdf->MultiCell(190, 10, '', 'TRBL', 'L', true);


// ROW 2
$pdf->SetFont('helvetica', '', 11);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(0, 0, 0);

$x = $pdf->GetX();
$y = $pdf->GetY();
$text1 = "Klasse: ".$report_data[0]['class'];
$pdf->Text($x, $y+0.4, $text1);

$x = $pdf->GetX();
$y = $pdf->GetY();
$text = "Klassenlehrer/in: ".$full_name.' ('.$user_id.')';
$pdf->Text($x-145, $y+0.1, $text);

$x = $pdf->GetX();
$y = $pdf->GetY();
$text = "Schuljahr: ".$report_data[0]['created_at'];
$pdf->Text($x-50, $y+0.1, $text);

$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetXY($x-190, $y-0.7);
$pdf->MultiCell(190, 6, '', 'TRBL', 'L', true);

// ROW 3
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetXY($x, $y);
$pdf->MultiCell(190, 5, '', 'TRBL', 'L', true);

// ROW 4
$x = $pdf->GetX();
$y = $pdf->GetY();
$text = "Individuelle Stärken und Schwächen";
$pdf->Text($x, $y, $text);

$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetXY($x-190, $y-0.7);
$pdf->MultiCell(190, 6, '', 'TRBL', 'L', true);


// ROW 5
$x1 = $pdf->GetX();
$y1 = $pdf->GetY();

$pdf->SetXY($x1 + 40, $y1); // Move to the second column position
$pdf->MultiCell(150, 10, $str_strengths, 'TRBL', 'L', true); // Second column (with a black border)

// Get the final height of the second column
$heightOfColumn2 = $pdf->GetY() - $y1;

// Set the height of the first column to match the height of the second column (with a black border on top, right, and bottom)
$pdf->SetXY($x1, $y1); // Move back to the first column position
$pdf->MultiCell(40, $heightOfColumn2, 'Stärken', 'TRBL', 'L', true);

// ROW 6
$x1 = $pdf->GetX();
$y1 = $pdf->GetY();
$pdf->SetXY($x1 + 40, $y1);
$pdf->MultiCell(150, 10, $str_difficulties, 'TRBL', 'L', true);
$heightOfColumn2 = $pdf->GetY() - $y1;
$pdf->SetXY($x1, $y1);
$pdf->MultiCell(40, $heightOfColumn2, 'Schwächen', 'TRBL', 'L', true);

// ROW 7
$x1 = $pdf->GetX();
$y1 = $pdf->GetY();
$pdf->SetXY($x1 + 90, $y1);
$pdf->MultiCell(100, 6, "Förderziele (wohin?)", 'TRBL', 'L', true);
$heightOfColumn2 = $pdf->GetY() - $y1;
$pdf->SetXY($x1, $y1);
$pdf->MultiCell(90, $heightOfColumn2, 'Förderbedarf (was?)', 'TRBL', 'L', true);

// ROW 8
$x1 = $pdf->GetX();
$y1 = $pdf->GetY();
$pdf->SetXY($x1 + 90, $y1);
$pdf->MultiCell(100, 10, $str_goals_1, 'TRBL', 'L', true);
$heightOfColumn2 = $pdf->GetY() - $y1;
$pdf->SetXY($x1, $y1);
$pdf->MultiCell(90, $heightOfColumn2, '1. '.$support_1, 'TRBL', 'L', true);

// ROW 9
$x1 = $pdf->GetX();
$y1 = $pdf->GetY();
$pdf->SetXY($x1 + 90, $y1);
$pdf->MultiCell(100, 10, $str_goals_2, 'TRBL', 'L', true);
$heightOfColumn2 = $pdf->GetY() - $y1;
$pdf->SetXY($x1, $y1);
$pdf->MultiCell(90, $heightOfColumn2, '2. '.$support_2, 'TRBL', 'L', true);

// ROW 10
$x1 = $pdf->GetX();
$y1 = $pdf->GetY();
$pdf->SetXY($x1, $y1-.5);
$pdf->MultiCell(190, 7, "Fördermaßnahmen zu den benannten Förderzielen.
(wie? und womit?)", 'TRBL', 'L', true);

// ROW 11
$x1 = $pdf->GetX();
$y1 = $pdf->GetY();
$pdf->SetXY($x1, $y1);
$pdf->MultiCell(190, 10, "1. Action 1", 'TRBL', 'L', true);

// ROW 12
$x1 = $pdf->GetX();
$y1 = $pdf->GetY();
$pdf->SetXY($x1, $y1);
$pdf->MultiCell(190, 10, "2. Action 2", 'TRBL', 'L', true);


// ROW 13
$x1 = $pdf->GetX();
$y1 = $pdf->GetY();
$pdf->SetXY($x1, $y1-.5);
$pdf->MultiCell(190, 6, "Formen des Nachteilsausgleichs", 'TRBL', 'L', true);

// ROW 14
$x1 = $pdf->GetX();
$y1 = $pdf->GetY();
$pdf->SetXY($x1, $y1-.5);
$pdf->MultiCell(190, 10, $str_compensations, 'TRBL', 'L', true);

// ROW 15
$x1 = $pdf->GetX();
$y1 = $pdf->GetY();
$pdf->SetXY($x1, $y1-.5);
$pdf->MultiCell(190, 6, "Umsetzung", 'TRBL', 'L', true);

// ROW 16
$x1 = $pdf->GetX();
$y1 = $pdf->GetY();
$pdf->SetXY($x1 + 47, $y1);
$pdf->MultiCell(47, 6, "Fördermaßnahme 1", 'TRBL', 'L', true);
$heightOfColumn2 = $pdf->GetY() - $y1;
$pdf->SetXY($x1 + 94, $y1);
$pdf->MultiCell(47, 6, "Fördermaßnahme 2", 'TRBL', 'L', true);
$heightOfColumn2 = $pdf->GetY() - $y1;
$pdf->SetXY($x1 + 141, $y1);
$pdf->MultiCell(49, 6, "Nachteilsausgleich", 'TRBL', 'L', true);
$heightOfColumn2 = $pdf->GetY() - $y1;
$pdf->SetXY($x1, $y1);
$pdf->MultiCell(47, $heightOfColumn2,'', 'TRBL', 'L', true);

// ROW 17
$x1 = $pdf->GetX();
$y1 = $pdf->GetY();
$pdf->SetXY($x1 + 47, $y1);
// $pdf->MultiCell(47, 6, "Person responsible 2 Person responsible 2 Person responsible 2 Person responsible 2 Person responsible 2", 'TRBL', 'L', true);
// $heightOfColumn2 = $pdf->GetY() - $y1;
// $pdf->SetXY($x1 + 94, $y1);
// $pdf->MultiCell(47, 6, " Person responsible 2 Person responsible 2 Person responsible 2 Person responsible 2 Person responsible 2", 'TRBL', 'L', true);
// $heightOfColumn2 = $pdf->GetY() - $y1;
// $pdf->SetXY($x1 + 141, $y1);
$pdf->MultiCell(49, 6, "Person responsible 2 Person responsible 2 Person responsible 2 Person responsible 2 Person responsible 2", 'TRBL', 'L', true);
$heightOfColumn2 = $pdf->GetY() - $y1;
$pdf->SetXY($x1, $y1);
$pdf->MultiCell(47, $heightOfColumn2,'Wer?', 'TRBL', 'L', true);


$pdf->Output('example.pdf', 'I');