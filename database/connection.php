<?php
$server = 'localhost';
$username = 'root';
$password = '11121112';
$db_name = 'timeline_system';

// $server = 'localhost';
// $username = 'orachun2564';
// $password = 'orachun2564';
// $db_name = 'timeline_system';

$conn = mysqli_connect($server,$username,$password,$db_name);

if (mysqli_connect_errno($conn)){
    echo 'connection failed' . mysqli_connect_error();
} 

// $sql_delete = "DELETE FROM `user_info` WHERE date < NOW() - INTERVAL 30 DAY";
// mysqli_query($conn, $sql_delete);