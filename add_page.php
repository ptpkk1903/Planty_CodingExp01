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

function display_form($get_cmm){
    if(cleanMe($_GET["cmm"]) == $get_cmm){
        return "style='width:400px;display:block;'";
    }else{
        return "style='width:400px;display:none;'";
    }

}

$routine_get = display_form("routine");
$status_get = display_form("status");
$topic_get = display_form("topic");
$work_get = display_form("work");
?>
<html>

<head>
    <title>Add Data</title>
    <link rel="icon" type="image/x-icon" href="https://www.svgrepo.com/show/76996/database.svg">
    <meta charset="utf-8">
    <link rel="stylesheet" href="stylebase4.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Itim&family=Mitr:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <div class="warp-item"><a href="home"><i class="fa fa-calendar-check-o"
                        style="font-size:24px"></i>&nbsp;&nbsp;&nbsp;Daily</a></div>
            <div class="warp-item"><a href=""><i class="fa fa-book"
                        style="font-size:24px"></i>&nbsp;&nbsp;&nbsp;Work</a></div>
            <div class="warp-item"><a class="active" href="infomation"><i class="fa fa-cogs"
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
                <div style="top:100px;position:absolute;left:0%;width=fit-content;height=fit-content;"><a
                        href='<?php
                        $getlink = cleanMe($_GET["cmm"]);
                        if($getlink == "work"){
                            echo("work_list");
                        }else{
                            echo("infomation");
                        }
                        ?>'><button class='normal-btn'
                            style='padding:0;height:30px;width:30px;margin-left:20px;'><i class="fa fa-arrow-left"
                                aria-hidden="true"></i></button></a></div>
                </br></br>
                <div class="normal-box" <?php echo $routine_get;?>>
                    <a class="topic-box">Add Event</a>
                    <hr align="left"></br>
                    <select style="border: 1px solid #63A0FF;color:#004FCA;height:45px;width:100%;" id="day-select"
                        name="day-select" class="my-input" required>
                        <option value="" selected="" disabled="">-- Day Select --</option>
                        <option value="อาทิตย์">อาทิตย์</option>
                        <option value="จันทร์">จันทร์</option>
                        <option value="อังคาร">อังคาร</option>
                        <option value="พุธ">พุธ</option>
                        <option value="พฤหัสบดี">พฤหัสบดี</option>
                        <option value="ศุกร์">ศุกร์</option>
                        <option value="เสาร์">เสาร์</option>
                    </select>
                    <input autocomplete="off" style="padding-left:10px;height:45px;width:100%;" id="topic_name"
                        name="topic_name" class="my-input" type="text" placeholder="Event name" required>
                    <input autocomplete="off" style="padding-left:10px;height:45px;width:120px;" id="time_start"
                        name="time_start" type="text" class="my-input" placeholder="hh:mm" required><a> - </a><input
                        style="padding-left:10px;height:45px;width:120px;" id="time_end" name="time_end" type="text"
                        class="my-input" autocomplete="off" placeholder="hh:mm" required>
                    </br></br>
                    <button onclick="send_event(this)" id="event-btn" style="width:200px;height:45px;"
                        class="normal-btn">Add</button>
                </div>
                <div class="normal-box" <?php echo $status_get;?>>
                    <a class="topic-box">Add Status</a>
                    <hr align="left"></br>
                    <input autocomplete="off" style="padding-left:10px;height:45px;width:100%;" id="status_name"
                        name="status_name" class="my-input" type="text" placeholder="Status Name" required>
                    <input autocomplete="off"
                        style="background-color:white;padding-left:10px;padding-right:10px;height:45px;width:120px;"
                        id="color" name="color" type="color" class="my-input" required></br>
                    <select style="border: 1px solid #63A0FF;color:#004FCA;height:45px;width:120px;" id="hidden-select"
                        name="hidden-select" class="my-input" required>
                        <option value="" selected="" disabled="">-- Hidden --</option>
                        <option value="true">true</option>
                        <option value="false">false</option>
                    </select>
                    </br></br>
                    <button onclick="send_status(this)" id="status-btn" style="width:200px;height:45px;"
                        class="normal-btn">Add</button>
                </div>
                <div class="normal-box" <?php echo $topic_get;?>>
                    <a class="topic-box">Add Topic</a>
                    <hr align="left"></br>
                    <input autocomplete="off" style="padding-left:10px;height:45px;width:100%;" id="topic_work_name"
                        name="topic_work_name" class="my-input" type="text" placeholder="Topic Name" required>
                    <input autocomplete="off" style="padding-left:10px;height:45px;width:100%;" id="commander_name"
                        name="commander_name" class="my-input" type="text" placeholder="Commander Name" required></br>
                    </br>
                    <button onclick="send_topic(this)" id="topic-btn" style="width:200px;height:45px;"
                        class="normal-btn">Add</button>
                </div>
                <div class="normal-box" <?php echo $work_get;?>>
                    <a class="topic-box">Add Works</a>
                    <hr align="left"></br>
                    <select style="border: 1px solid #63A0FF;color:#004FCA;height:45px;width:100%;" id="topic-select"
                        name="topic-select" class="my-input" required>
                        <option value="" selected="" disabled="">-- Select Topic --</option>
                        <?php
                        $query_data = mysqli_query($conn, "SELECT * FROM `topic_work` WHERE `id_user`='$id_user' and `piid`='$piid_user'");
                        while($row_data = mysqli_fetch_assoc($query_data)){
                            $id_topic = $row_data["id"];
                            $name_topic = $row_data["topic"];
                            $name_commander = $row_data["commander"];
                            echo("<option value='$id_topic'>$name_topic ($name_commander)</option>");
                        }
                        ?>
                    </select>
                    <input autocomplete="off" style="padding-left:10px;height:45px;width:100%;" id="work_name"
                        name="work_name" class="my-input" type="text" placeholder="Work" required>
                    <input autocomplete="off" style="padding-left:10px;height:45px;width:100%;" id="work_infomation"
                        name="work_infomation" class="my-input" type="text" placeholder="Infomation" required>
                    <input autocomplete="off" style="padding-left:10px;height:45px;width:250px;" id="work_deadline"
                        name="work_deadline" class="my-input" type="date" required>
                    <select style="border: 1px solid #63A0FF;color:#004FCA;height:45px;width:100%;" id="difficult-select"
                        name="difficult-select" class="my-input" required>
                        <option value="" disabled="">-- Difficult Select --</option>
                        <option value="1" selected="">Easy (1hr)</option>
                        <option value="2">Medium (2hr)</option>
                        <option value="3">Hard (3hr)</option>
                        <option value="4">Team Project (4hr)</option>
                    </select>
                        <?php
                        $query_status = mysqli_query($conn, "SELECT `id`,`status`,`color` FROM `status_work` WHERE `id_user`='$id_user' and `piid`='$piid_user'");
                        while($query_get = mysqli_fetch_assoc($query_status)){
                            $id_status = $query_get["id"];
                            $name_status = $query_get["status"];
                            $color_status = $query_get["color"];
                            echo("<input type='radio' id='$id_status' name='Status_select' value='$id_status'>");
                            echo("<label style='color:$color_status;' for='$id_status'>$name_status</label><br>");
                        }
                        ?>
                    </br>
                    <button onclick="send_work(this)" id="hw-btn" style="width:200px;height:45px;"
                        class="normal-btn">Add</button>
                </div>
            </div>
        </div>
    </div>
    <script src="myscript2.js"></script>
    <script src="add_script.js"></script>
    <script>

    function customSplit(inputString) {
  // ใช้ regular expression เพื่อตรวจสอบรูปแบบของข้อมูล
  var regex = /(\d{2}:\d{2})-(\d{2}:\d{2})/;
  
  // ใช้ match เพื่อหาข้อมูลที่ตรงกับ regular expression
  var match = inputString.match(regex);
  
  // ถ้ามีข้อมูลที่ตรงกับ regular expression
  if (match) {
    // match[1] คือข้อมูลที่ตรงกับกลุ่มที่ 1 (ตัวเลขที่ 1)
    // match[2] คือข้อมูลที่ตรงกับกลุ่มที่ 2 (ตัวเลขที่ 2)
    var result = [match[1], match[2]];
    
    // ส่งค่าผลลัพธ์กลับ
    return result;
  } else {
    // ถ้าไม่พบข้อมูลที่ตรงกับ regular expression
    console.error("Invalid input format");
    return null;
  }
}
    function time_set() {
        if ((document.getElementById("time_start").value).length == 3 && (document.getElementById("time_start").value)
            .includes(":") == false) {
            document.getElementById("time_start").value = (document.getElementById("time_start").value).charAt(0) + (
                document.getElementById("time_start").value).charAt(1) + ":" + (document.getElementById(
                "time_start").value).charAt(2) + (document.getElementById("time_start").value).charAt(3);
        }
        if ((document.getElementById("time_end").value).length == 3 && (document.getElementById("time_end").value)
            .includes(":") == false) {
            document.getElementById("time_end").value = (document.getElementById("time_end").value).charAt(0) + (
                document.getElementById("time_end").value).charAt(1) + ":" + (document.getElementById("time_end")
                .value).charAt(2) + (document.getElementById("time_end").value).charAt(3);
        }
        if ((document.getElementById("time_start").value).length == 11 && (document.getElementById("time_start").value)
            .includes("-") == true) {
            document.getElementById("time_end").value = customSplit(document.getElementById("time_start").value)[1];
            document.getElementById("time_start").value = customSplit(document.getElementById("time_start").value)[0];
        }
    }

    setInterval(time_set, 100);
    </script>
</body>

</html>