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
        header("location: logout.php");
    }else{
        $id_user = $_SESSION["id"];
        $piid_user = $_SESSION["piid"];
    }
}
//////////
$cmm = cleanMe($_GET["cmm"]);
$objid = cleanMe($_GET["objid"]);

if(mysqli_num_rows(mysqli_query($conn, "SELECT `id` FROM `user` WHERE `id`='$id_user' and `piid`='$piid_user'")) > 0){
    if($cmm == "routine"){
        if(mysqli_query($conn, "DELETE FROM routine WHERE id=$objid and `id_user`='$id_user' and `piid`='$piid_user'")){
            header("location: infomation.php");
        }
    }elseif($cmm == "status"){
        if(mysqli_query($conn, "DELETE FROM status_work WHERE id=$objid and `id_user`='$id_user' and `piid`='$piid_user'")){
            $query_status = mysqli_query($conn, "SELECT `id` FROM `status_work` WHERE `id_user`='$id_user' AND `piid`='$piid_user' ORDER BY `id` DESC LIMIT 1");
            $status_last =  mysqli_fetch_assoc($query_status);
            $status_real = $status_last["id"];
            mysqli_query($conn, "UPDATE list_work SET `status`='$status_real' WHERE `status`=$objid and `id_user`='$id_user' and `piid`='$piid_user'");
            header("location: infomation.php");
        }
    }elseif($cmm == "topic"){
        if(mysqli_query($conn, "DELETE FROM topic_work WHERE id=$objid and `id_user`='$id_user' and `piid`='$piid_user'") && mysqli_query($conn, "DELETE FROM list_work WHERE topic_id=$objid and `id_user`='$id_user' and `piid`='$piid_user'")){
            header("location: infomation.php");
        }
    }elseif($cmm == "work"){
        if(mysqli_query($conn, "DELETE FROM list_work WHERE id=$objid and `id_user`='$id_user' and `piid`='$piid_user'")){
            header("location: work_list.php");
        }
    }
}