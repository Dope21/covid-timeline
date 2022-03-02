<?php session_start(); ?>
<?php

//php_spreadsheet_export.php
$session_sql = $_SESSION['sql'];
include 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;


$connect = new PDO("mysql:host=localhost;dbname=timeline_system", "root", "11121112");


$query = $session_sql;

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

if(isset($_POST["export"]))
{
  $file = new Spreadsheet();

  $active_sheet = $file->getActiveSheet();

  $active_sheet->setCellValue('A1', 'เลขบัตรประชาชน');
  $active_sheet->setCellValue('B1', 'ชื่อ');
  $active_sheet->setCellValue('C1', 'นามสกุล');
  $active_sheet->setCellValue('D1', 'อุณหภูมิ');
  $active_sheet->setCellValue('E1', 'เข้า');
  $active_sheet->setCellValue('F1', 'ออก');
  $active_sheet->setCellValue('G1', 'วันที่');
  $active_sheet->setCellValue('H1', 'สถานที่');

  $count = 2;

  foreach($result as $row)
  {
    $active_sheet->setCellValue('A' . $count, $row["id_card"]);
    $active_sheet->setCellValue('B' . $count, $row["first_name"]);
    $active_sheet->setCellValue('C' . $count, $row["last_name"]);
    $active_sheet->setCellValue('D' . $count, $row["temp"]);
    $active_sheet->setCellValue('E' . $count, $row["time"]);
    $active_sheet->setCellValue('F' . $count, $row["out"]);
    $active_sheet->setCellValue('G' . $count, $row["date"]);
    $active_sheet->setCellValue('H' . $count, $row["location"]);

    $count = $count + 1;
  }

  $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, $_POST["file_type"]);

  $file_name = time() . '.' . strtolower($_POST["file_type"]);

  $writer->save($file_name);

  header('Content-Type: application/x-www-form-urlencoded');

  header('Content-Transfer-Encoding: Binary');

  header("Content-disposition: attachment; filename=\"".$file_name."\"");

  readfile($file_name);

  unlink($file_name);

  exit;

}

?>