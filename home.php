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

function retstatustime($time_range) {
    list($start_time, $end_time) = explode('-', $time_range);
    $current_time = time();
    $start_timestamp = strtotime("today " . trim($start_time));
    $end_timestamp = strtotime("today " . trim($end_time));

    if ($current_time >= $start_timestamp && $current_time <= $end_timestamp) {
        return '<td style="color:#219C90">During</td>';
    } elseif ($current_time > $end_timestamp) {
        return '<td style="color:#D80032">End</td>';
    } else {
        return '<td style="color:#A9A9A9">Waiting</td>';
    }
}

function daythaiget(){
    $dayTranslations = array(
        "Monday" => "จันทร์",
        "Tuesday" => "อังคาร",
        "Wednesday" => "พุธ",
        "Thursday" => "พฤหัสบดี",
        "Friday" => "ศุกร์",
        "Saturday" => "เสาร์",
        "Sunday" => "อาทิตย์",
    );
    $englishDay = date("l");
    return $dayTranslations[$englishDay];
}
?>
<html>

<head>
    <title>Daily</title>
    <link rel="icon" type="image/x-icon" href="https://www.svgrepo.com/show/76996/database.svg">
    <meta charset="utf-8">
    <link rel="stylesheet" href="stylebase4.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&family=Mitr:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        padding-left: 2vw;
        padding-right: 2vw;
        padding-bottom: 15px;
        white-space: nowrap;
        text-align: center;
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
            <div class="warp-item"><a class="active" href=""><i class="fa fa-calendar-check-o"
                        style="font-size:24px"></i>&nbsp;&nbsp;&nbsp;Daily</a></div>
            <div class="warp-item"><a href="work_list"><i class="fa fa-book"
                        style="font-size:24px"></i>&nbsp;&nbsp;&nbsp;Work</a></div>
            <div class="warp-item"><a href="infomation"><i class="fa fa-cogs"
                        style="font-size:24px"></i>&nbsp;&nbsp;&nbsp;Manage</a></div>
            <div class="warp-item"><a style="color:#FF6C6C;" href="logout"><i class="fa fa-sign-out"
                        style="font-size:24px"></i>&nbsp;&nbsp;&nbsp;Logout</a></div>

        </div>
        <div class="item">
            <div class="showpage">
                <div class="pagename"><a><i class="fa fa-calendar-check-o" style="font-size:24px"></i> Daily</a></div>
                <div class="menu" onclick="menu(this)"><i class="fa fa-reorder" style="font-size:34px"></i></div>
            </div>
            <div class="flex-respone">
                <div class="normal-box" style="width:fit-content;">
                    <a class="topic-box">Event <a style="font-size:12px;color:#a4a6ad;" id="currenttime"></a></a>
                    <hr align="left"></br>
                    <table align="center">
                        <?php
                        $daynow = daythaiget();
                        $sql = "SELECT * FROM `routine` WHERE `id_user`='$id_user' and `piid`='$piid_user' and `day_t`='$daynow' ORDER BY time_check";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                        echo "<tr>";
                        echo "<th style='color:#7091F5;font-size:22px;'>Event</th>";
                        echo "<th style='color:#7091F5;font-size:22px;'>Time</th>";
                        echo "<th style='color:#7091F5;font-size:22px;'>Status</th>";
                        echo "</tr>";
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>".$row["routine_name"]."</td>";
                            echo "<td>".$row["time_start"]."-".$row["time_end"]."</td>";
                            echo retstatustime($row["time_start"]."-".$row["time_end"]);
                            echo "</tr>";
                        }
                        }else{
                            echo "ไม่มีข้อมูลในตอนนี้";
                        }
                        ?>
                    </table>
                </div>
                <div class="normal-box" style="max-width:max-content;">
                    <a class="topic-box">Summarize</a>
                    <hr align="left"></br>
                    <div align="center">
                        <table>
                            <tr>
                                <?php
                        $sql = "SELECT * FROM `status_work` WHERE `id_user`='$id_user' and `piid`='$piid_user' ORDER BY id";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)) {
                            $color = $row["color"];
                            $status = $row["status"];
                            echo "<th style='color:$color;'>$status</th>";
                            
                        }
                        }else{
                            echo "ไม่มีข้อมูลในตอนนี้";
                        }
                        ?>
                            </tr>
                            <tr>
                                <?php
                        $sql = "SELECT `id` FROM `status_work` WHERE `id_user`='$id_user' and `piid`='$piid_user' ORDER BY id";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)) {
                            $status_row = $row["id"];
                            $sql_row_num = "SELECT * FROM `list_work` WHERE `id_user`='$id_user' and `piid`='$piid_user' and `status`='$status_row'";
                            $qr = mysqli_query($conn, $sql_row_num);
                            $num_row = mysqli_num_rows($qr);
                            echo "<td style='text-align:center;font-size:29px;'>$num_row</td>";
                        }
                        }
                        ?>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="myscript2.js"></script>
    <script>
    function getDayName() {
        var currentDate = new Date();
        var daysOfWeek = ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์"];
        var dayIndex = currentDate.getDay();
        var dayName = daysOfWeek[dayIndex];
        var day = currentDate.getDate();

        return day + " " + dayName;
    }

    function updateCurrentTime() {
        var currentTime = new Date();
        var hours = currentTime.getHours().toString().padStart(2, '0'); // แปลงให้เป็น hh
        var minutes = currentTime.getMinutes().toString().padStart(2, '0'); // แปลงให้เป็น mm
        var currentTimeStr = getDayName() + " " + hours + ':' + minutes;
        var currentTimeElement = document.getElementById('currenttime');
        currentTimeElement.textContent = currentTimeStr;
    }

    function reload_web(){
        location.reload()
    }
    updateCurrentTime()
    setInterval(updateCurrentTime, 3000);
    setInterval(reload_web, 300000);
    </script>
</body>

</html>