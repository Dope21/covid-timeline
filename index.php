<?php require_once('./database/connection.php') ?>
<?php session_start();?>
<?php
    if ($_SESSION['id'] == ""){
        header('location: login.php');
    }
    $_userID = $_SESSION['id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css?<?php echo time();?>">
    <title>timeline</title>
</head>
<body>
    <main class="timeline__container">
        <div class="timeline">
            <div class="timeline__title">
                <h1 class="timeline__name">ชื่อ: <?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></h1>
                <p class="timeline__id">เลขบัตร: <?php echo substr($_SESSION['id'],0,1).'-'.substr($_SESSION['id'],1,4).'-'.substr($_SESSION['id'],5,5).'-'.substr($_SESSION['id'],10,2).'-'.substr($_SESSION['id'],12,1) ?></p>
            </div>
            
            <div class="timeline__filter">
                <div class="timeline__location">
                    <input type="text" placeholder="สถานที่" id="location">
                </div>
                <div class="timeline__date-1">
                    <input type="date" id="date-1">
                </div>
                <span>ถึง</span>
                <div class="timeline__date-2">
                    <input type="date" id="date-2">
                </div>
            </div>
            <div class="timeline__submit">
                <div class="timeline__search">
                    <button class="timeline__button" id="searchButton" value="search">
                        ค้นหา
                    </button>
                    <button class="timeline__button" id="clearButton" value="clear">
                        ล้าง
                    </button>
                </div>
                <form class="timeline__excel" method="post" action="open-excel-sheet-in-browser/php_spreadsheet_export.php">
                    <p class="timeline__excel-info">บันทึกตารางเป็นไฟล์ Excel</p>
                    <input type="submit" class="timeline__button" value="ดาวน์โหลด" name="export">
                    <input type="hidden" name="file_type" value="Xlsx">
                </form>
            </div>
            <div class="timeline__table">
                <table class="" id="myTable">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>สถานที่</th>
                            <th>เวลา-เข้า</th>
                            <th>เวลา-ออก</th>
                            <th>อุณหภูมิ</th>
                            <th>วันที่</th>
                        </tr>
                    </thead>
                    <tbody id="tbady">
                    <?php
                        $sql = "SELECT * 
                                FROM user_info 
                                INNER JOIN user_out
                                    ON user_info.info_id = user_out.info_id
                                WHERE '$_userID' = user_info.id_card";
                        $_SESSION['sql'] = $sql;
                        $result = mysqli_query($conn, $sql);
                        $num = 0;
                        echo mysqli_error($conn);

                        while($rowInfo = mysqli_fetch_array($result)){
                        $num += 1;

                        $fullyear = $rowInfo['date'];

                                	$yy = substr($rowInfo['date'],0,4)+543;
	                                $mm = substr($rowInfo['date'],5,2);
	                                $dd = substr($rowInfo['date'],8,2);

                                    $_dd_name=array(
                                     "01"=>"1","02"=>"2","03"=>"3",
                                     "04"=>"4","05"=>"5","06"=>"6",
                                     "07"=>"7","08"=>"8","09"=>"9",
                                     "10"=>"10","11"=>"11","12"=>"12",
                                     "13"=>"13","14"=>"14","15"=>"15",
                                     "16"=>"16","17"=>"17","18"=>"18",
                                     "19"=>"19","20"=>"20","21"=>"21",
                                     "22"=>"22","23"=>"23","24"=>"24",
                                     "25"=>"25","26"=>"26","27"=>"27",
                                     "28"=>"28","29"=>"29","30"=>"30",
                                     "31"=>"31",);

                                    $_month_name = array(
                                     "01"=>"มราคม"
                                    ,"02"=>"กุมภาพันธ์"
                                    ,"03"=>"มีนาคม"
                                    ,"04"=>"เมษายน"
                                    ,"05"=>"พฤษภาคม"
                                    ,"06"=>",มิถุนายน"
                                    ,"07"=>"กรกฎาคม"
                                    ,"08"=>"สิงหาคม"
                                    ,"09"=>"กันยายน"
                                    ,"10"=>"ตุลาคม"
                                    ,"11"=>"พฤศจิกายน"
                                    ,"12"=>"ธันวาคม",);

                                    $dateTh = $_dd_name[$dd]." ".$_month_name[$mm]." ".$yy; 
                    ?>

                        <tr>
                            <td><?php echo $num; ?></td>
                            <td><?php echo $rowInfo['location']; ?></td>
                            <td><?php echo $rowInfo['time']; ?></td>
                            <td><?php echo $rowInfo['out']; ?></td>
                            <td><?php echo $rowInfo['temp']; ?></td>
                            <td><?php echo $dateTh; ?></td>
                        </tr>

                        <?php   
                        }
                        ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </main>
</body>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="./javascript/timeline.js?<?php echo time();?>"></script>
    <script>
    $(document).ready( function () {
        $('#myTable').DataTable({
            "bInfo" : false,
            "searching": false,
            "language": {
                "lengthMenu":     "แสดง _MENU_ แถว",
                "paginate": {
                    "next":       "ต่อไป",
                    "previous":   "ก่อนหน้า"
                },
                "emptyTable":     "ไม่มีข้อมูล"
            },
            "bSort" : false
        });

        $(document).ajaxStop(function(){
            $('#myTable').DataTable({
            "bInfo" : false,
            "searching": false,
            "language": {
                "lengthMenu":     "แสดง _MENU_ แถว",
                "paginate": {
                    "next":       "ต่อไป",
                    "previous":   "ก่อนหน้า"
                },
                "emptyTable":     "ไม่มีข้อมูล"
            },
            "bSort" : false
            });
        });
    });
    </script>
</html>