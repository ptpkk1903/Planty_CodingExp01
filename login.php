<?php
session_start();
include "cnn.php";
// Session
$username = cleanMe($_POST["username"]);
$password = cleanMe($_POST["password"]);
if($username != "" && $password != ""){
    $sql = "SELECT `id`,`piid` FROM `user` WHERE `username`='$username' and `password`='$password'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) < 1){
        echo("9002");
    }else{
        $fecth = mysqli_fetch_assoc($result);
        $_SESSION["id"] = $fecth["id"];
        $_SESSION["piid"] = $fecth["piid"];
        echo("9001");
    }
}else{
    echo("9002");
}
//////////
