<?php require_once('./database/connection.php') ?>
<?php session_start();?>
<?php

unset($_SESSION['id']);
unset($_SESSION['firstname']);
unset($_SESSION['lastname']);

$_firstname = $_POST['firstname'];
$_lastname = $_POST['lastname'];
$_id = $_POST['id'];

$_SESSION['firstname'] = $_firstname;
$_SESSION['lastname'] = $_lastname;

// echo $_firstname;
// echo $_lastname;
// echo $_id;
if($_id == 'admin'){
    $_SESSION['id'] = $_id;
    header('location: admin__timeline.php');
} else {
    $sql = "SELECT * FROM user_info WHERE '$_firstname' = first_name AND '$_lastname' = last_name AND '$_id' = id_card";
    $result = mysqli_query($conn,$sql);
    
     //echo mysqli_num_rows($result);
    
    if (mysqli_num_rows($result) == 0){
        echo  "<script>alert('woop! email or password is wrong.')</script>";
        //echo 'kuy';
        header('location: login.php');
    } else {
        $_SESSION['id'] = $_id;
        header('location: index.php');
    }
}
