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
}else{
    $support_2 = "";
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
}else{
    $str_goals_2 = "";
}

$actions_1 = $report_data[0]['actions_1'];
if($actions_1 != ""){
    $actions_1 = json_decode($actions_1);
    $str_actions_1 = "";
    foreach($actions_1 as $action){
        $str_actions_1 .= $action.'.';
    }
}

$actions_2 = $report_data[0]['actions_2'];
if($actions_2 != ""){
    $actions_2 = json_decode($actions_2);
    $str_actions_2 = "";
    foreach($actions_2 as $action){
        $str_actions_2 .= $action.'.';
    }
}else{
    $str_actions_2 = "";
}

$compensations = $report_data[0]['compensations'];
if($compensations != ""){
    $compensations = json_decode($compensations);
    $str_compensations = "";
    foreach($compensations as $compensation){
        $str_compensations .= $compensation.'.';
    }
}else{
    $str_compensations = "";
}

$teacher_1 = $report_data[0]['teacher_1'];
if($teacher_1 != ""){
    $teacher_1 = json_decode($teacher_1);
    $str_teacher_1 = "";
    foreach($teacher_1 as $data){
        $str_teacher_1 .= $data.'.';
    }
    $exp_teacher_1 = explode('##',$str_teacher_1);
}

$members_1 = $report_data[0]['members_1'];
if($members_1 != ""){
    $members_1 = json_decode($members_1);
    $str_members_1 = "";
    foreach($members_1 as $data){
        $str_members_1 .= $data.'.';
    }
    $exp_members_1 = explode('##',$str_members_1);
}

$duties_1 = $report_data[0]['duties_1'];
if($duties_1 != ""){
    $duties_1 = json_decode($duties_1);
    $str_duties_1 = "";
    foreach($duties_1 as $data){
        $str_duties_1 .= $data.'.';
    }
}

$outcomes_1 = $report_data[0]['outcomes_1'];
if($outcomes_1 != ""){
    $outcomes_1 = json_decode($outcomes_1);
    $str_outcomes_1 = "";
    foreach($outcomes_1 as $data){
        $str_outcomes_1 .= $data.'.';
    }
}

$teacher_2 = $report_data[0]['teacher_2'];
if($teacher_2 != ""){
    $teacher_2 = json_decode($teacher_2);
    $str_teacher_2 = "";
    foreach($teacher_2 as $data){
        $str_teacher_2 .= $data.'.';
    }
    $exp_teacher_2 = explode('##',$str_teacher_2);
    $exp_teacher_2 = $exp_teacher_2[2];
}else{
    $exp_teacher_2 = "";
}

$members_2 = $report_data[0]['members_2'];
if($members_2 != ""){
    $members_2 = json_decode($members_2);
    $str_members_2 = "";
    foreach($members_2 as $data){
        $str_members_2 .= $data.'.';
    }
    $exp_members_2 = explode('##',$str_members_2);
    $exp_members_2 = $exp_members_2[2];
}else{
    $exp_members_2 = "";
}

$duties_2 = $report_data[0]['duties_2'];
if($duties_2 != ""){
    $duties_2 = json_decode($duties_2);
    $str_duties_2 = "";
    foreach($duties_2 as $data){
        $str_duties_2 .= $data.'.';
    }
}else{
    $str_duties_2 = "";
}

$outcomes_2 = $report_data[0]['outcomes_2'];
if($outcomes_2 != ""){
    $outcomes_2 = json_decode($outcomes_2);
    $str_outcomes_2 = "";
    foreach($outcomes_2 as $data){
        $str_outcomes_2 .= $data.'.';
    }
}else{
    $str_outcomes_2 = "";
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
$pdf->Text($x, $y+5, $text);

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
$pdf->SetXY($x-190, $y-0.6);
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
$pdf->MultiCell(150, 15, $str_strengths, 'TRBL', 'L', true); // Second column (with a black border)

// Get the final height of the second column
$heightOfColumn2 = $pdf->GetY() - $y1;

// Set the height of the first column to match the height of the second column (with a black border on top, right, and bottom)
$pdf->SetXY($x1, $y1); // Move back to the first column position
$pdf->MultiCell(40, $heightOfColumn2, 'Stärken', 'TRBL', 'L', true);

// ROW 6
$x1 = $pdf->GetX();
$y1 = $pdf->GetY();
$pdf->SetXY($x1 + 40, $y1);
$pdf->MultiCell(150, 15, $str_difficulties, 'TRBL', 'L', true);
$heightOfColumn2 = $pdf->GetY() - $y1;
$pdf->SetXY($x1, $y1);
$pdf->MultiCell(40, $heightOfColumn2, 'Schwächen', 'TRBL', 'L', true);

// ROW 7
$x1 = $pdf->GetX();
$y1 = $pdf->GetY();
$pdf->SetXY($x1 + 90, $y1-.65);
$pdf->MultiCell(100, 7, "Förderziele (wohin?)", 'TRBL', 'L', true);
$heightOfColumn2 = $pdf->GetY() - $y1;
$pdf->SetXY($x1, $y1-.65);
$pdf->MultiCell(90, $heightOfColumn2, 'Förderbedarf (was?)', 'TRBL', 'L', true);

// ROW 8
$x1 = $pdf->GetX();
$y1 = $pdf->GetY();
$pdf->SetXY($x1 + 90, $y1);
$pdf->MultiCell(100, 15, $str_goals_1, 'TRBL', 'L', true);
$heightOfColumn2 = $pdf->GetY() - $y1;
$pdf->SetXY($x1, $y1);
$pdf->MultiCell(90, $heightOfColumn2, "1. .$support_1", 'TRBL', 'L', true);

// ROW 9
if($support_2 != ""){
    $x1 = $pdf->GetX();
    $y1 = $pdf->GetY();
    $pdf->SetXY($x1 + 90, $y1);
    $pdf->MultiCell(100, 15, $str_goals_2, 'TRBL', 'L', true);
    $heightOfColumn2 = $pdf->GetY() - $y1;
    $pdf->SetXY($x1, $y1);
    $pdf->MultiCell(90, $heightOfColumn2, "2. $support_2", 'TRBL', 'L', true);
}

// ROW 10
$x1 = $pdf->GetX();
$y1 = $pdf->GetY();
$pdf->SetXY($x1, $y1-.5);
$pdf->MultiCell(190, 8, "Fördermaßnahmen zu den benannten Förderzielen.
(wie? und womit?)", 'TRBL', 'L', true);

// ROW 11
$x1 = $pdf->GetX();
$y1 = $pdf->GetY();
$pdf->SetXY($x1, $y1);
$pdf->MultiCell(190, 15, "1. $str_actions_1", 'TRBL', 'L', true);

// ROW 12
if($str_actions_2 != ""){
    $x1 = $pdf->GetX();
    $y1 = $pdf->GetY();
    $pdf->SetXY($x1, $y1);
    $pdf->MultiCell(190, 15, "2. $str_actions_2", 'TRBL', 'L', true);
}


// ROW 13
$x1 = $pdf->GetX();
$y1 = $pdf->GetY();
$pdf->SetXY($x1, $y1-.5);
$pdf->MultiCell(190, 7, "Formen des Nachteilsausgleichs", 'TRBL', 'L', true);

// ROW 14
if($str_compensations != ""){
    $x1 = $pdf->GetX();
    $y1 = $pdf->GetY();
    $pdf->SetXY($x1, $y1-.5);
    $pdf->MultiCell(190, 15, $str_compensations, 'TRBL', 'L', true);
}

// ROW 15
$x1 = $pdf->GetX();
$y1 = $pdf->GetY();
$pdf->SetXY($x1, $y1-.6);
$pdf->MultiCell(190, 6, "Umsetzung", 'TRBL', 'L', true);

// Sample data (you can replace this with your actual data)
$data = array(
    array('', 'Fördermaßnahme 1', 'Fördermaßnahme 2', 'Nachteilsausgleich'),
    array('Wer?', $exp_teacher_1[2], $exp_teacher_2, ''),
    array('Was?', $str_duties_1, $str_duties_2, ''),
    array('Mit wem?', $exp_members_1[2], $exp_members_2, ''),
    array('Bis wann? & Feedback', $str_outcomes_1, $str_outcomes_2, ''),
    // array('Feedback / Kontrolle', 'Outcome 1', 'Outcome 2', ''),
);

// Calculate row heights based on the highest column
foreach ($data as $row) {
    $maxHeight = 0;

    foreach ($row as $col) {
        $height = $pdf->getStringHeight(60, $col); // 60 is the adjusted column width
        $maxHeight = max($maxHeight, $height);
    }

    $rowHeights[] = $maxHeight;
}

// Set initial Y position and adjust left margin
$margin = 10;
$yPos = $pdf->GetY(); // Adjust as needed

// Loop through data and create table
$rowIndex = 0;
foreach ($data as $row) {
    $colIndex = 0;
    $maxHeight = $rowHeights[$rowIndex]+5;

    foreach ($row as $col) {
        // Set X and Y coordinates for each cell
        $xPos = $colIndex * 47.5+10; // 60 is the adjusted column width
        $pdf->SetXY($xPos, $yPos);

        // Output the cell
        $pdf->MultiCell(47.5, $maxHeight, $col, 1, 'L');

        $colIndex++;
    }

    // Move to the next row
    $yPos += $maxHeight;
    $pdf->SetY($yPos);

    $rowIndex++;
}

// ROW 
$pdf->SetFont('helvetica', '2', 14);
$x = $pdf->GetX();
$y = $pdf->GetY();
$text1 = "__________________";
$pdf->Text($x, $y+15, $text1);

$pdf->SetFont('helvetica', '2', 14);
$x = $pdf->GetX();
$y = $pdf->GetY();
$text1 = "__________________";
$pdf->Text($x-121, $y, $text1);

$pdf->SetFont('helvetica', '2', 14);
$x = $pdf->GetX();
$y = $pdf->GetY();
$text1 = "__________________";
$pdf->Text($x-50, $y, $text1);

$pdf->SetFont('helvetica', '', 10);
$x = $pdf->GetX();
$y = $pdf->GetY();
$text1 = "Datum/Unterschrift Schüler/in";
$pdf->Text($x-188, $y+7, $text1);

$pdf->SetFont('helvetica', '', 10);
$x = $pdf->GetX();
$y = $pdf->GetY();
$text1 = "Datum/Unterschrift Schüler/in";
$pdf->Text($x-119, $y, $text1);

$pdf->SetFont('helvetica', '', 10);
$x = $pdf->GetX();
$y = $pdf->GetY();
$text1 = "Datum/Unterschrift Schüler/in";
$pdf->Text($x-47, $y, $text1);


$pdf->Output('example.pdf', 'I');
// $pdf->Output(__DIR__ .'/assets/pdf/example.pdf', 'F');