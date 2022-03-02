<!DOCTYPE html>
<html>
  	<head>
    	<title>Import Data From Excel or CSV File to Mysql using PHPSpreadsheet</title>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  	</head>
  	<body>
    	<div class="container">
    		<br />
    		<h3 align="center">อัพโหลดไฟล์ Excel ลงในฐานข้อมูล</h3>
    		<br />
        <div class="panel panel-default">
          <div class="panel-heading">กรุณาอัพโหลดเฉพาะไฟล์ที่มีนามสกุล xls, csv, xlsx เท่านั้น </div>
          <div class="panel-body">
        		<div class="table-responsive">
        			<span id="message"></span>
              <form method="post" id="import_excel_form" enctype="multipart/form-data">
                <table class="table">
                  <tr>
                    <td width="25%" align="right">เลือกไฟล์ Excel</td>
                    <td width="50%"><input type="file" name="import_excel" /></td>
                    <td width="25%"><input type="submit" name="import" id="import" class="btn btn-primary" value="ตกลง" /></td>
                  </tr>
                </table>
              </form>
    	    		<br />
              
        		</div>
          </div>
        </div>
    	</div>
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  </body>
</html>
<script>
$(document).ready(function(){
  $('#import_excel_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"import.php",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      beforeSend:function(){
        $('#import').attr('disabled', 'disabled');
        $('#import').val('กำลังบันทึก...');
      },
      success:function(data)
      {
        $('#message').html(data);
        $('#import_excel_form')[0].reset();
        $('#import').attr('disabled', false);
        $('#import').val('ตกลง');
      }
    })
  });
});
</script>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap');

  body{
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    display: flex;
    align-items: center;
    font-family: 'kanit',sans-serif;
    font-weight: 400;
    background: #FFF8EE;
  }

  .panel{
    margin-left: 110px;
    margin-right: 110px;
    box-shadow: 5px 10px 18px #888888;
  }

  h3{
    font-weight: 600;
    color: #2C7A7B;

    font-size: 40px;
  }

  .panel-heading{
    background-color: #2C7A7B!important;
    color: #fff!important;
  }

  .panel-body{
    background-color: hsl(250, 70%, 96%);
  }

  button, html input[type=button], input[type=reset], input[type=submit] {
    background-color: #2C7A7B;
}
</style>