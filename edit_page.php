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
$status_get = display_form("status_work");
$topic_get = display_form("topic_work");
$work_get = display_form("list_work");
?>
<html>

<head>
    <title>Edit Data</title>
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

    .deletebtn {
        height: 45px;
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
            <?php
            $command = cleanMe($_GET["cmm"]);
            $obj_id = cleanMe($_GET["objid"]);
            function event_get($obj,$comd,$var, $connect) {
                $event = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `$comd` WHERE `id`=$obj"));
                return $event[$var];
            } 
            ?>
            <div class="flex-respone">
                <div style="top:100px;position:absolute;left:0%;width=fit-content;height=fit-content;"><a href='
                        <?php
                        $getlink = cleanMe($_GET["cmm"]);
                        if($getlink == "list_work"){
                            echo("work_list");
                        }else{
                            echo("infomation");
                        }
                        ?>'><button class='normal-btn' style='padding:0;height:30px;width:30px;margin-left:20px;'><i
                                class="fa fa-arrow-left" aria-hidden="true"></i></button></a></div>
                </br></br>
                <div class="normal-box" <?php echo $routine_get;?>>
                    <a class="topic-box">Edit Event</a>
                    <hr align="left"></br>
                    <select style="border: 1px solid #63A0FF;color:#004FCA;height:45px;width:100%;" id="day-select"
                        name="day-select" class="my-input" required>
                        <option value="" selected="">-- Day Select --</option>
                        <option value="อาทิตย์">อาทิตย์</option>
                        <option value="จันทร์">จันทร์</option>
                        <option value="อังคาร">อังคาร</option>
                        <option value="พุธ">พุธ</option>
                        <option value="พฤหัสบดี">พฤหัสบดี</option>
                        <option value="ศุกร์">ศุกร์</option>
                        <option value="เสาร์">เสาร์</option>
                    </select>
                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var selectElement = document.getElementById("day-select");
                        selectElement.value = "<?php echo(event_get($obj_id,$command,"day_t",$conn));?>";
                    });
                    </script>
                    <input autocomplete="off" style="padding-left:10px;height:45px;width:100%;" id="topic_name"
                        name="topic_name" class="my-input" type="text" placeholder="Event name"
                        value="<?php echo(event_get($obj_id,$command,"routine_name",$conn));?>" required>
                    <input autocomplete="off" style="padding-left:10px;height:45px;width:120px;" id="time_start"
                        name="time_start" type="text" class="my-input" placeholder="hh:mm"
                        value="<?php echo(event_get($obj_id,$command,"time_start",$conn));?>" required><a> ถึง
                    </a><input style="padding-left:10px;height:45px;width:120px;" id="time_end" name="time_end"
                        type="text" class="my-input" autocomplete="off" placeholder="hh:mm"
                        value="<?php echo(event_get($obj_id,$command,"time_end",$conn));?>" required>
                    </br></br>
                    <button onclick="send_event(this)" id="event-btn" style="width:200px;height:45px;"
                        class="normal-btn">Edit</button>
                </div>
                <div class="normal-box" <?php echo $status_get;?>>
                    <a class="topic-box">Edit Status</a>
                    <hr align="left"></br>
                    <input autocomplete="off" style="padding-left:10px;height:45px;width:100%;" id="status_name"
                        name="status_name" class="my-input" type="text" placeholder="Status Name"
                        value="<?php echo(event_get($obj_id,$command,"status",$conn));?>" required>
                    <input autocomplete="off"
                        style="background-color:white;padding-left:10px;padding-right:10px;height:45px;width:120px;"
                        id="color" name="color" type="color" class="my-input"
                        value="<?php echo(event_get($obj_id,$command,"color",$conn));?>" required></br>
                    <select style="border: 1px solid #63A0FF;color:#004FCA;height:45px;width:120px;" id="hidden-select"
                        name="hidden-select" class="my-input" required>
                        <option value="" selected="" disabled="">-- Hidden --</option>
                        <option value="true">true</option>
                        <option value="false">false</option>
                    </select>
                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var selectElement2 = document.getElementById("hidden-select");
                        selectElement2.value = "<?php echo(event_get($obj_id,$command,"hidden",$conn));?>";
                    });
                    </script>
                    </br></br>
                    <button onclick="send_status(this)" id="status-btn" style="width:200px;height:45px;"
                        class="normal-btn">Edit</button>
                </div>
                <div class="normal-box" <?php echo $topic_get;?>>
                    <a class="topic-box">Edit Topic</a>
                    <hr align="left"></br>
                    <input autocomplete="off" style="padding-left:10px;height:45px;width:100%;" id="topic_work_name"
                        name="topic_work_name" class="my-input" type="text" placeholder="Topic Name"
                        value="<?php echo(event_get($obj_id,$command,"topic",$conn));?>" required>
                    <input autocomplete="off" style="padding-left:10px;height:45px;width:100%;" id="commander_name"
                        name="commander_name" value="<?php echo(event_get($obj_id,$command,"commander",$conn));?>"
                        class="my-input" type="text" placeholder="Commander Name" required></br>
                    </br>
                    <button onclick="send_topic(this)" id="topic-btn" style="width:200px;height:45px;"
                        class="normal-btn">Edit</button>
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
                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var selectElement5 = document.getElementById("topic-select");
                        selectElement5.value = "<?php echo(event_get($obj_id,$command,"topic_id",$conn));?>";
                    });
                    </script>
                    <input autocomplete="off" style="padding-left:10px;height:45px;width:100%;" id="work_name"
                        value="<?php echo(event_get($obj_id,$command,"workname",$conn));?>" name="work_name"
                        class="my-input" type="text" placeholder="Work" required>
                    <input autocomplete="off" style="padding-left:10px;height:45px;width:100%;" id="work_infomation"
                        value="<?php echo(event_get($obj_id,$command,"infomation",$conn));?>" name="work_infomation"
                        class="my-input" type="text" placeholder="Infomation" required>
                    <input autocomplete="off" style="padding-left:10px;height:45px;width:250px;" id="work_deadline"
                    value="<?php echo(date("Y-m-d",event_get($obj_id,$command,"deadline",$conn)));?>"name="work_deadline" class="my-input" type="date" required>
                    <select style="border: 1px solid #63A0FF;color:#004FCA;height:45px;width:100%;"
                        id="difficult-select" name="difficult-select" class="my-input" required>
                        <option value="" disabled="">-- Difficult Select --</option>
                        <option value="1" selected="">Easy (1hr)</option>
                        <option value="2">Medium (2hr)</option>
                        <option value="3">Hard (3hr)</option>
                        <option value="4">Team Project (4hr)</option>
                    </select>
                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var selectElement6 = document.getElementById("difficult-select");
                        selectElement6.value = "<?php echo(event_get($obj_id,$command,"time_doing",$conn));?>";
                    });
                    </script>
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
                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        (document.querySelector('input[name="Status_select"][value="' + <?php echo(event_get($obj_id,$command,"status",$conn));?> + '"]')).checked = true;
                    });
                    </script>
                    <button data="delete?cmm=work&objid=<?php echo($obj_id);?>" onclick="del_data(this)" class='normal-btn deletebtn'>Del</button>
                    <button onclick="send_work(this)" id="hw-btn" style="width:200px;height:45px;"
                        class="normal-btn">Edit</button>
                </div>
            </div>
        </div>
    </div>
    <input id="id-objid" style="display:none;" value="<?php echo $obj_id;?>">
    <script src="myscript2.js"></script>
    <script src="edit_script.js"></script>
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
                        window.location.href = "work_list";
                    })
                });
            }
        })
    }
    </script>
    <script>
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
    }

    setInterval(time_set, 100);
    </script>
</body>

</html>