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
$obj_id = cleanMe($_POST["objid"]);

if(mysqli_num_rows(mysqli_query($conn, "SELECT `id` FROM `user` WHERE `id`='$id_user' and `piid`='$piid_user'")) > 0){
    if($cmm == "edit-event"){
        $routine_name = cleanMe($_POST["event"]);
        $routine_day = cleanMe($_POST["day"]);
        $routine_start = cleanMe($_POST["start_time"]);
        $routine_end = cleanMe($_POST["end_time"]);
        if($routine_name != null && $routine_day != null && $routine_start != null && $routine_end != null){
            $check_time = str_replace(":", "", $routine_start);
            if(mysqli_query($conn, "UPDATE routine SET routine_name='$routine_name',day_t='$routine_day',time_start='$routine_start',time_end='$routine_end',time_check='$check_time' WHERE id=$obj_id")){
                echo "9001";
            }else{
                echo "9002";
            }
        }else{
            echo "9002";
        }
    }elseif($cmm == "edit-status"){
        $status_name = cleanMe($_POST["status"]);
        $status_color = cleanMe($_POST["color"]);
        $status_hidden = cleanMe($_POST["hidden"]);
        if($status_name != null && $status_color != null && $status_hidden != null){
            if(mysqli_query($conn, "UPDATE status_work SET status='$status_name',color='$status_color',hidden='$status_hidden' WHERE id=$obj_id and `id_user`='$id_user' and `piid`='$piid_user'")){
                echo "9001";
            }else{
                echo "9002";
            }
        }else{
            echo "9002";
        }
    }elseif($cmm == "edit-topic"){
        $topic_name = cleanMe($_POST["topic"]);
        $commander_name = cleanMe($_POST["commander"]);
        if($topic_name != null && $commander_name != null){
            if(mysqli_query($conn, "UPDATE topic_work SET topic='$topic_name',commander='$commander_name' WHERE id=$obj_id and `id_user`='$id_user' and `piid`='$piid_user'")){
                echo "9001";
            }else{
                echo "9002";
            }
        }else{
            echo "9002";
        }
    }elseif($cmm == "work_restatus"){
        $hw_id_set = cleanMe($_POST["id_hw"]);
        $status_id_set = cleanMe($_POST["status_hw"]);
        if($hw_id_set != null && $status_id_set != null){
            if(mysqli_query($conn, "UPDATE list_work SET status='$status_id_set' WHERE id=$hw_id_set and `id_user`='$id_user' and `piid`='$piid_user'")){
                echo "9001";
            }else{
                echo "9002";
            }
        }else{
            echo "9002";
        }
    }elseif($cmm == "edit-work"){
        $hw_id = cleanMe($_POST["objid"]);
        $topic_id = cleanMe($_POST["topic_id"]);
        $work_name = cleanMe($_POST["work_name"]);
        $work_infomation = cleanMe($_POST["work_infomation"]);
        $work_deadline = (intval(strtotime(cleanMe($_POST["work_deadline"]))))+61200;
        $difficult = cleanMe($_POST["difficult"]); 
        $status_sel = cleanMe($_POST["status_data"]);
        if($hw_id != null && $status_sel != null && $topic_id != null && $work_name != null && $work_infomation != null && $work_deadline != null && $difficult != null){
            if(mysqli_query($conn, "UPDATE list_work SET topic_id='$topic_id',workname='$work_name',infomation='$work_infomation',deadline='$work_deadline',time_doing='$difficult',`status`='$status_sel' WHERE `id`=$hw_id and `id_user`='$id_user' and `piid`='$piid_user'")){
                echo "9001";
            }else{
                echo "9002";
            }
        }else{
            echo "9002";
        }
    }
}