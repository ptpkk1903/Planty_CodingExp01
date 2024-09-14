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
?>
<html>

<head>
    <title>Management</title>
    <link rel="icon" type="image/x-icon" href="https://www.svgrepo.com/show/76996/database.svg">
    <meta charset="utf-8">
    <link rel="stylesheet" href="stylebase4.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&family=Mitr:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        overflow-x: auto;
        display: block;
    }

    td,
    th {
        border: 0px solid #dddddd;
        text-align: left;
        padding-left: 1.5vw;
        padding-right: 1.5vw;
        padding-bottom: 15px;
        text-align: center;
    }

    .deletebtn {
        height: 30px;
        padding: 0px;
        width: 60px;
        align-items: center;
        border: 1px solid #D80032;
        color: #D80032;
    }

    .deletebtn:hover {
        color: white;
        background-color: #D80032;
    }

    .deletebtn:active {
        padding: 6px;
        border: 3px solid #EC4068;
        color: white;
        background-color: #D80032;
    }

    .editbtn {
        height: 30px;
        padding: 0px;
        width: 60px;
        align-items: center;
        border: 1px solid #FFB000;
        color: #FFB000;
    }

    .editbtn:hover {
        color: white;
        background-color: #FFB000;
    }

    .editbtn:active {
        padding: 3px;
        border: 3px solid #FFD26F;
        color: white;
        background-color: #FFB000;
    }

    .seework {
        height: 30px;
        padding: 0px;
        width: 60px;
        align-items: center;
        border: 1px solid #004FCA;
        color: #004FCA;
    }

    .seework:hover {
        color: white;
        background-color: #004FCA;
    }

    .seework:active {
        padding: 3px;
        border: 3px solid #2975EB;
        color: white;
        background-color: #004FCA;
    }
    </style>
</head>

<body>
    <div class="clearfix">
        <div id="nav" class="nav">
            <div class="center-item">
                <h2><a class="warporcleck" href="home"><i class="fa fa-database" style="font-size:36px"></i>
                        PlanTy</a></h2>
            </div>
            <hr size="0.5px">
            <div class="warp-item"><a href="home"><i class="fa fa-calendar-check-o"
                        style="font-size:24px"></i>&nbsp;&nbsp;&nbsp;Daily</a></div>
            <div class="warp-item"><a href="work_list"><i class="fa fa-book"
                        style="font-size:24px"></i>&nbsp;&nbsp;&nbsp;Work</a></div>
            <div class="warp-item"><a class="active" href=""><i class="fa fa-cogs"
                        style="font-size:24px"></i>&nbsp;&nbsp;&nbsp;Manage</a>

            </div>
            <div class="warp-item"><a style="color:#FF6C6C;" href="logout"><i class="fa fa-sign-out"
                        style="font-size:24px"></i>&nbsp;&nbsp;&nbsp;Logout</a></div>
        </div>
        <div class="item">
            <div class="showpage">
                <div class="pagename"><a><i class="fa fa-cogs" style="font-size:24px"></i> Manage</a></div>
                <div class="menu" onclick="menu(this)"><i class="fa fa-reorder" style="font-size:34px"></i></div>
            </div>
            <div class="flex-respone">
                <div class="normal-box" style="width:fit-content;">
                    <a class="topic-box">Event Setting </a><a href='add_page?cmm=routine'><button class='normal-btn'
                            style='height:35px;width:35px;padding:0;'>+</button></a>
                    <hr align="left"></br>
                    <table align="center" style="max-height:350px;">
                        <?php
                        $sql = "SELECT * FROM `routine` WHERE `id_user`='$id_user' and `piid`='$piid_user' ORDER BY id";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                        echo "<tr>";
                        echo "<th style='color:#7091F5;font-size:22px;'>Day</th>";
                        echo "<th style='color:#7091F5;font-size:22px;'>Event</th>";
                        echo "<th style='color:#7091F5;font-size:22px;'>Time</th>";
                        echo "<th style='color:#7091F5;font-size:22px;'>Edit</th>";
                        echo "<th style='color:#7091F5;font-size:22px;'>Delete</th>";
                        echo "</tr>";
                        while($row = mysqli_fetch_assoc($result)) {
                            $objid = $row["id"];
                            echo "<tr>";
                            echo "<td>".$row["day_t"]."</td>";
                            echo "<td>".$row["routine_name"]."</td>";
                            echo "<td>".$row["time_start"]."-".$row["time_end"]."</td>";
                            echo "<td><a href='edit_page?cmm=routine&objid=$objid&userid=$id_user&piid=$piid_user'><button class='normal-btn editbtn'>Edit</button></a></td>";
                            echo "<td><a><button data='delete?cmm=routine&objid=$objid&userid=$id_user&piid=$piid_user' onclick='del_data(this)' class='normal-btn deletebtn'>Del</button></a></td>";
                            echo "</tr>";
                        }
                        }else{
                            echo "ไม่มีข้อมูลในตอนนี้";
                        }
                        ?>
                    </table>
                </div>
                <div class="normal-box" style="width:fit-content;">
                    <a class="topic-box">Status Setting</a>
                    <a href='add_page?cmm=status'><button class='normal-btn'
                            style='height:35px;width:35px;padding:0;'>+</button></a>
                    <hr align="left"></br>
                    <table align="center" style="max-height:350px;">
                        <?php
                        $sql = "SELECT * FROM `status_work` WHERE `id_user`='$id_user' and `piid`='$piid_user'";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                        echo "<tr>";
                        echo "<th style='color:#7091F5;font-size:22px;'>Status</th>";
                        echo "<th style='color:#7091F5;font-size:22px;'>Hidden</th>";
                        echo "<th style='color:#7091F5;font-size:22px;'>Edit</th>";
                        echo "<th style='color:#7091F5;font-size:22px;'>Delete</th>";
                        echo "</tr>";
                        while($row = mysqli_fetch_assoc($result)) {
                            $objid = $row["id"];
                            $color = $row["color"];
                            echo "<tr>";
                            echo "<td style='color:$color;'>".$row["status"]."</td>";
                            echo "<td>".$row["hidden"]."</td>";
                            echo "<td><a href='edit_page?cmm=status_work&objid=$objid&userid=$id_user&piid=$piid_user'><button class='normal-btn editbtn'>Edit</button></a></td>";
                            echo "<td><a><button data='delete?cmm=status&objid=$objid&userid=$id_user&piid=$piid_user' onclick='del_data(this)' class='normal-btn deletebtn'>Del</button></a></td>";
                            echo "</tr>";
                        }
                        }else{
                            echo "ไม่มีข้อมูลในตอนนี้";
                        }
                        ?>
                    </table>
                </div>
                <div class="normal-box" style="width:fit-content;">
                    <a class="topic-box">Topic Setting</a>
                    <a href='add_page?cmm=topic'><button class='normal-btn'
                            style='height:35px;width:35px;padding:0;'>+</button></a>
                    <hr align="left"></br>
                    <table align="center" style="max-height:350px;">
                        <?php
                        $sql = "SELECT * FROM `topic_work` WHERE `id_user`='$id_user' and `piid`='$piid_user'";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                        echo "<tr>";
                        echo "<th style='color:#7091F5;font-size:22px;'>Topic</th>";
                        echo "<th style='color:#7091F5;font-size:22px;'>Commander</th>";
                        echo "<th style='color:#7091F5;font-size:22px;'>Work_Count</th>";
                        echo "<th style='color:#7091F5;font-size:22px;'>See</th>";
                        echo "<th style='color:#7091F5;font-size:22px;'>Edit</th>";
                        echo "<th style='color:#7091F5;font-size:22px;'>Delete</th>";
                        echo "</tr>";
                        while($row = mysqli_fetch_assoc($result)) {
                            $objid = $row["id"];
                            $count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `list_work` WHERE `id_user`='$id_user' and `piid`='$piid_user' and `topic_id`='$objid'"));
                            echo "<tr>";
                            echo "<td>".$row["topic"]."</td>";
                            echo "<td>".$row["commander"]."</td>";
                            $id_obj_checker = $row["status"];
                            echo "<td>".$count."</td>";
                            echo "<td><a href='work_list?filter_mode=topic&topic_filter=$objid'><button class='normal-btn seework'>See</button></a></td>";
                            echo "<td><a href='edit_page?cmm=topic_work&objid=$objid&userid=$id_user&piid=$piid_user'><button class='normal-btn editbtn'>Edit</button></a></td>";
                            echo "<td><a ><button data='delete?cmm=topic&objid=$objid&userid=$id_user&piid=$piid_user' onclick='del_data(this)' class='normal-btn deletebtn'>Del</button></a></td>";
                            echo "</tr>";
                        }
                        }else{
                            echo "ไม่มีข้อมูลในตอนนี้";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="myscript2.js"></script>
    <script>
    function del_data(elem) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Delete it?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.get(elem.getAttribute("data"), function(data, status) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Successful!',
                        showConfirmButton: true,
                        timer: 1500
                    }).then((result) =>{
                        location.reload();
                    })
                });
            }
        })
    }
    </script>
</body>

</html>