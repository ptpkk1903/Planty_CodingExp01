<?php
session_start();
include "cnn.php";
// Session
$id_user = $_SESSION["id"];
$piid_user = $_SESSION["piid"];
if($id_user == "" && $piid_user == ""){
    $sql = "SELECT `id` FROM `user` WHERE `id`='$id_user' and `piid`='$piid_user'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) < 1){
        header("location: logout.php");
    }else{
        $id_user = $_SESSION["id"];
        $piid_user = $_SESSION["piid"];
    }
}
//////////

function generateRandomString($length = 18) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=[]{}|;:,.<>?';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function getTimestampWithEndTime($date) {
    $start_date = strtotime($date);
    $end_date = strtotime("+23 hours 59 minutes", $start_date);
    return $end_date;
}