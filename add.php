<?php
session_start();
include "cnn.php";
date_default_timezone_set('Asia/Bangkok');

// Session
$id_user = $_SESSION["id"];
$piid_user = $_SESSION["piid"];
if($id_user == "" && $piid_user == ""){
    $sql = "SELECT `id` FROM `user` WHERE `id`='$id_user' and `piid`='$piid_user'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) < 1){
        header("location: logout");
    }else{
        $id_user = $_SESSION["id"];
        $piid_user = $_SESSION["piid"];
    }
}
//////////
$cmm = cleanMe($_POST["cmm"]);

if(mysqli_num_rows(mysqli_query($conn, "SELECT `id` FROM `user` WHERE `id`='$id_user' and `piid`='$piid_user'")) > 0){
    if($cmm == "add-event"){
        $routine_name = cleanMe($_POST["event"]);
        $routine_day = cleanMe($_POST["day"]);
        $routine_start = cleanMe($_POST["start_time"]);
        $routine_end = cleanMe($_POST["end_time"]);
        if($routine_name != null && $routine_day != null && $routine_start != null && $routine_end != null){
            $check_time = str_replace(":", "", $routine_start);
            if(mysqli_query($conn, "INSERT INTO routine (`routine_name`, `day_t`, `time_start`, `time_end`, `time_check`, `id_user`, `piid`) VALUES ('$routine_name','$routine_day','$routine_start','$routine_end','$check_time','$id_user','$piid_user')")){
                echo "9001";
            }else{
                echo "9002";
            }
        }else{
            echo "9002";
        }
    }elseif($cmm == "add-status"){
        $status_name = cleanMe($_POST["status"]);
        $status_color = cleanMe($_POST["color"]);
        $status_hidden = cleanMe($_POST["hidden"]);
        if($status_name != null && $status_color != null && $status_hidden != null){
            if(mysqli_query($conn, "INSERT INTO status_work (`status`, `color`, `hidden`, `id_user`, `piid`) VALUES ('$status_name','$status_color','$status_hidden','$id_user','$piid_user')")){
                echo "9001";
            }else{
                echo "9002";
            }
        }else{
            echo "9002";
        }
    }elseif($cmm == "add-topic"){
        $topic_name = cleanMe($_POST["topic"]);
        $commander_name = cleanMe($_POST["commander"]);
        if($topic_name != null && $commander_name != null){
            if(mysqli_query($conn, "INSERT INTO topic_work (`topic`, `commander`, `id_user`, `piid`) VALUES ('$topic_name','$commander_name','$id_user','$piid_user')")){
                echo "9001";
            }else{
                echo "9002";
            }
        }else{
            echo "9002";
        }
    }elseif($cmm == "add-work"){
        $topic_id = cleanMe($_POST["topic_id"]);
        $work_name = cleanMe($_POST["work_name"]);
        $work_infomation = cleanMe($_POST["work_infomation"]);
        $work_deadline = (intval(strtotime(cleanMe($_POST["work_deadline"]))))+61200;
        $difficult = cleanMe($_POST["difficult"]);
        $status_sel = cleanMe($_POST["status_data"]);
        if($status_sel != null && $topic_id != null && $work_name != null && $work_infomation != null && $work_deadline != null && $difficult != null){
            if(mysqli_query($conn, "INSERT INTO list_work (`topic_id`, `workname`, `infomation`, `deadline`, `time_doing`, `status`, `id_user`, `piid`) VALUES ('$topic_id','$work_name','$work_infomation','$work_deadline', '$difficult', '$status_sel', '$id_user', '$piid_user')")){
                echo "9001";
            }else{
                echo "9002";
            }
        }else{
            echo "9002"."$topic_id/"."$work_name/"."$work_infomation/"."$work_deadline/"."$difficult/";
        }
    }
}