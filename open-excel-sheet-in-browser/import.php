<?php session_start(); ?>
<?php

include 'vendor/autoload.php';

$connect = new PDO("mysql:host=localhost;dbname=timeline_system", "root", "11121112");
//include 'timeline_system/database.php';

if($_FILES["import_excel"]["name"] != '')
{
	$allowed_extension = array('xls', 'csv', 'xlsx');
	$file_array = explode(".", $_FILES["import_excel"]["name"]);
	$file_extension = end($file_array);

	if(in_array($file_extension, $allowed_extension))
	{
		$file_name = time() . '.' . $file_extension;
		move_uploaded_file($_FILES['import_excel']['tmp_name'], $file_name);
		$file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

		$spreadsheet = $reader->load($file_name);

		unlink($file_name);

		$data = $spreadsheet->getActiveSheet()->toArray();

		foreach($data as $row)
		{
			$date = $row[3];
			$yy = substr($date,6,4);
			$mm = substr($date,0,2);
			$dd = substr($date,3,2);
			$yy = $yy-543;
			$format_date = $yy.'-'.$mm.'-'.$dd;

			$insert_data = array(
				//':info_id'			=>	$row[0],
				':id_card'			=>	$row[0],
				':first_name'		=>	$row[1],
				':last_name'		=>	$row[2],
				':temp'				=>	$row[8],
				':time'				=>	$row[6],
				':date'				=>	$format_date,
				':location'			=>	$row[4]
			);

			$query = "INSERT INTO user_info 
					  (id_card, first_name, last_name, temp ,time ,date ,location) 
					  VALUES (:id_card, :first_name, :last_name, :temp ,:time ,:date ,:location)";

			$statement = $connect->prepare($query);
			$statement->execute($insert_data);
		}
		$message = '<div class="alert alert-success">บันทึกข้อมูลเสร็จสิ้น</div>';

	}
	else
	{
		$message = '<div class="alert alert-danger">ใช้ได้เฉพาะไฟล์ที่มีนามสกุล xls, csv, xlsx เท่านั้น</div>';
	}
}
else
{
	$message = '<div class="alert alert-danger">โปรดเลือกไฟล์</div>';
}

echo $message;

//$_SESSION['date_show'] = $format_date;

//header('location: fix.php')

?>