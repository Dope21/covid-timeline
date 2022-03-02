<?php require_once('./database/connection.php') ?>
<?php session_start();
      $session_id = $_SESSION['id'];
/*=========================================== VARIABLE SENDED BY AJAX ===========================================*/
// CLEAR
$_clear = $_POST['clear'];
// LOCATION
$_location = $_POST['location'];
// FIRST SET
// $_date = $_POST['date'];
// $_month =$_POST['month'];
// $_year = $_POST['year'];
//SECOND SET
// $_date_2 = $_POST['date_2'];
// $_month_2 = $_POST['month_2'];
// $_year_2 = $_POST['year_2'];
//DATE FORMAT FOR SELECTING DATA FORM DATABASE
$_select_1 = $_POST['date'];
$_select_2 = $_POST['date_2'];
/*=========================================== QUERY FUNCTION ===========================================*/
if($_SESSION['id']=='admin'){
    // echo $_location;
        // SEARCH LOCATION ONLY
        if ($_select_2 == '' && $_select_1 == ''){
            $sql = "SELECT * 
                    FROM user_info 
                    WHERE '$_location' = location 
                    ORDER BY date desc";
        }
    
        if ($_select_2 == '' && $_select_1 != ''){
            $sql = "SELECT * 
                    FROM user_info 
                    WHERE '$_select_1' = date 
                    AND '$_location' = location";
        }
    
        if ($_select_2 != '' && $_select_1 != '') {
            $sql = "SELECT * 
                    FROM user_info 
                    WHERE date >= '$_select_1' 
                    AND date <= '$_select_2' 
                    AND '$_location' = location";
        }
    
    //IF USER HIT THE CLEAR BUTTON
    if(isset($_clear))
    {   
        $sql = "SELECT * 
                FROM user_info 
                WHERE '$session_id' = id_card 
                ORDER BY date desc";
    }

} else {
    if($_location != ''){
        // SEARCH LOCATION ONLY
        if ($_select_2 == '' && $_select_1 == ''){
            $sql = "SELECT * 
                    FROM user_info 
                    WHERE '$_location' = location 
                    AND '$session_id' = id_card 
                    ORDER BY date desc";
        }
    
        if ($_select_2 == '' && $_select_1 != ''){

            $sql = "SELECT * 
                    FROM user_info 
                    WHERE '$_select_1' = date 
                    AND '$_location' = location 
                    AND '$session_id' = id_card ORDER BY date desc";
        }
    
        if ($_select_2 != '' && $_select_1 != '') {

            $sql = "SELECT * 
                    FROM user_info
                    WHERE date >= '$_select_1' AND date <= '$_select_2' 
                    AND '$_location' = location
                    AND '$session_id' = id_card ORDER BY date desc";
        }
    
    } else {
    
        // SEARCH ONLY ONE DAY
        if ($_select_2 == '' && $_select_1 != ''){

            $sql = "SELECT * 
                    FROM user_info 
                    WHERE '$session_id' = id_card
                    AND '$_select_1' = date
                    ORDER BY date DESC";
        } 
        //SEARCH BETWEEN TWO DAYS
        else if ($_select_2 != '' && $_select_1 != '') {

            $sql = "SELECT * 
                    FROM user_info 
                    WHERE '$session_id' = id_card
                    AND date >= '$_select_1'
                    AND date <= '$_select_2'
                    ORDER BY date DESC";
        }
    }
    //IF USER HIT THE CLEAR BUTTON
    if(isset($_clear))
    {   
        $sql = "SELECT * 
                FROM user_info 
                WHERE '$session_id' = id_card";
    }
}

            // $sql = "SELECT * FROM user_info WHERE '$_select_1' = date AND '$session_id' = id_card ORDER BY date desc";
$_SESSION['sql'] = $sql;
$result = mysqli_query($conn, $sql);
$rowCount = mysqli_num_rows($result);
$num = 0;
?>
<!-- =========================================== DATA TABLE =========================================== -->
<?php if ($_SESSION['id'] == 'admin') 
    {
?>
        <table class="" id="myTable">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อ</th>
                    <th>เวลา</th>
                    <th>อุณหภูมิ</th>
                    <th>วันที่</th>
                </tr>
            </thead>
                    
            <tbody id="tbody" data-number="<?php echo $rowCount;?>"> 
            <?php
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

                <tr class="rowCount">
                    <td><?php echo $num; ?></td>
                    <td><?php echo $rowInfo['first_name'].' '.$rowInfo['last_name']; ?></td>
                    <td><?php echo $rowInfo['time']; ?></td>
                    <td><?php echo $rowInfo['temp']; ?></td>
                    <td><?php echo $dateTh; ?></td>
                </tr>

            <?php   
            }
            ?>
            </tbody>
        </table>

<?php 
    } else {
?>
    <table class="" id="myTable">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>สถานที่</th>
                <th>เวลา</th>
                <th>อุณหภูมิ</th>
                <th>วันที่</th>
            </tr>
        </thead>
        <tbody id="tbady">
        <?php
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
                <td><?php echo $rowInfo['temp']; ?></td>
                <td><?php echo $dateTh; ?></td>
            </tr>

            <?php   
            }
            ?>
        </tbody>
    </table>                      
<?php
    }
?>