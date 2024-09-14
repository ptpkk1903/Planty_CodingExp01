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

function thai_date($date_value){
    $month_number = explode("-",$date_value);
    $month_thai = array("ม.ค","ก.พ","มี.ค","เม.ย","พ.ค","มิ.ย","ก.ค","ส.ค","ก.ย","ต.ค","พ.ย","ธ.ค");
    $set_date = $month_number[0]."  ".$month_thai[intval($month_number[01])-1]."  ".strval(intval($month_number[2])+543);
    return $set_date;
}
?>
<html>

<head>
    <title>Work</title>
    <link rel="icon" type="image/x-icon" href="https://www.svgrepo.com/show/76996/database.svg">
    <meta charset="utf-8">
    <link rel="stylesheet" href="stylebase4.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&family=Mitr:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

    .normal-box .hover {
        transition: transform 0.3s ease-in-out;
        width: 28%;
        word-wrap: break-word;
        /* ให้ข้อความขึ้นบรรทัดใหม่ตามคำ */
        overflow-wrap: break-word;
        user-select: none;
        cursor: pointer;
    }

    .normal-box .hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    }

    .flex-respone .list {
        justify-content: left;
    }

    @media screen and (max-width: 800px) {
        .normal-box {
            max-width: 90%;
        }

        .normal-box .hover {
            width: 90%;
        }
    }

    .status_radio{
        padding: 10px;
        border: 1px solid #dddddd;
        width:100px;
        margin: 5px;
    }

    input[type="radio"]{
        width:100%;
        margin:0;
        padding:0;
    }

    .editbtn {
        padding: 0px;
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
            <div class="warp-item"><a class="active" href="work_list"><i class="fa fa-book"
                        style="font-size:24px"></i>&nbsp;&nbsp;&nbsp;Work</a></div>
            <div class="warp-item"><a href="infomation"><i class="fa fa-cogs"
                        style="font-size:24px"></i>&nbsp;&nbsp;&nbsp;Manage</a>

            </div>
            <div class="warp-item"><a style="color:#FF6C6C;" href="logout"><i class="fa fa-sign-out"
                        style="font-size:24px"></i>&nbsp;&nbsp;&nbsp;Logout</a></div>
        </div>
        <div class="item">
            <div class="showpage">
                <div class="pagename"><a><i class="fa fa-calendar-check-o" style="font-size:24px"></i> Work</a></div>
                <div class="menu" onclick="menu(this)"><i class="fa fa-reorder" style="font-size:34px"></i></div>
            </div>
            <div class="flex-respone">
                <div class="normal-box" style="width:100%;">
                    <a class="topic-box">Work List</a><a href='add_page?cmm=work'><button class='normal-btn'
                            style='height:35px;width:35px;padding:0;margin-left:10px;'>+</button></a>
                    <select style="border: 1px solid #63A0FF;color:#004FCA;height:45px;width:100px;" id="filter"
                        name="filter" class="my-input" onchange="filter(this)" required>
                        <option value="" selected="" disabled="">Filter Topic</option>
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
                        function filter(filter){
                           var filter_get = filter.value;
                           window.location.href = "work_list?"+"filter_mode=topic&"+"topic_filter="+filter_get;
                        }

                        document.addEventListener('DOMContentLoaded', function() {
                        var selectElement = document.getElementById("filter");
                        selectElement.value = "<?php echo(cleanMe($_GET["topic_filter"]));?>";
                        });
                    </script>
                    <hr align="left"></br>
                    <div class="flex-respone list">
                        <?php
                        if((cleanMe($_GET["filter_mode"]) == "topic" || cleanMe($_GET["filter_mode"]) == "")){
                        if((cleanMe($_GET["topic_filter"]) == "" || cleanMe($_GET["topic_filter"]) == "All")){
                        $querywork = mysqli_query($conn, "SELECT * FROM `list_work` WHERE `id_user`='$id_user' and `piid`='$piid_user' ORDER By deadline");
                        if(mysqli_num_rows($querywork) > 0){
                            while($row_work = mysqli_fetch_assoc($querywork)){
                                $status_checker = $row_work["status"];
                                if((mysqli_fetch_assoc(mysqli_query($conn, "SELECT hidden FROM `status_work` WHERE `id`='$status_checker'")))["hidden"] == "false"){
                                    $topic_get = $row_work["topic_id"];
                                    $_topic = (mysqli_fetch_assoc(mysqli_query($conn, "SELECT topic FROM `topic_work` WHERE `id`='$topic_get' and `id_user`='$id_user' and `piid`='$piid_user'")))["topic"];
                                    $status_get = $row_work["status"];
                                    $_status = (mysqli_fetch_assoc(mysqli_query($conn, "SELECT `color`  FROM `status_work` WHERE `id`='$status_get' and `id_user`='$id_user' and `piid`='$piid_user'")))["color"];
                                    $_date = thai_date(date("d-m-Y",$row_work["deadline"]));
                                    $hw_hr = max(round(((intval($row_work["deadline"]))-intval(time()))/3600),0);
                                    $id_hw_list = $row_work["id"];
                                    echo"<div class='normal-box hover' onclick='mode($id_hw_list,$status_get,this)'>";
                                    echo"<a class='topic-box' style='font-size:32px;color:$_status;'>$_topic </br><a style='font-size:14px;color:$_status;'>$_date ($hw_hr"." hr".")</a></a>";
                                    if($hw_hr <= 72 && $hw_hr > 24){
                                        echo"<div style='color:#FFB600;position:absolute;top:-15;right:-5;'><i class='fa fa-warning' style='font-size:32px'></i></div>";
                                    }elseif($hw_hr <= 24){
                                        echo"<div style='color:red;position:absolute;top:-15;right:-5;'><i class='fa fa-warning' style='font-size:32px'></i></div>";
                                    }
                                    echo"<hr align='left'>";
                                    $_status_name = (mysqli_fetch_assoc(mysqli_query($conn, "SELECT `status`  FROM `status_work` WHERE `id`='$status_get' and `id_user`='$id_user' and `piid`='$piid_user'")))["status"];
                                    echo"<h3 style='color:#878787;'>Status: <a style='color:$_status;'>$_status_name</a></h3>";
                                    $_workname = $row_work["workname"];
                                    echo"<h3 style='color:#878787;'>Work: <a style='color:#ADC1FF;'>$_workname</a></h3>";
                                    $_infomation = $row_work["infomation"];
                                    echo"<h3 style='color:#878787;'>Info: <a style='color:#ADC1FF;'>$_infomation</a></h3>";
                                    echo"</div>";
                                }
                            }
                        }else{
                            echo"ไม่มีข้อมูล";
                        }
                        }else{
                        $fil_topic = cleanMe($_GET["topic_filter"]);
                        $querywork = mysqli_query($conn, "SELECT * FROM `list_work` WHERE `id_user`='$id_user' and `piid`='$piid_user' and `topic_id`='$fil_topic' ORDER By deadline");
                        if(mysqli_num_rows($querywork) > 0){
                            while($row_work = mysqli_fetch_assoc($querywork)){
                                $status_checker = $row_work["status"];
                                if((mysqli_fetch_assoc(mysqli_query($conn, "SELECT hidden FROM `status_work` WHERE `id`='$status_checker'")))["hidden"] == "false"){
                                    $topic_get = $row_work["topic_id"];
                                    $_topic = (mysqli_fetch_assoc(mysqli_query($conn, "SELECT topic FROM `topic_work` WHERE `id`='$topic_get' and `id_user`='$id_user' and `piid`='$piid_user'")))["topic"];
                                    $status_get = $row_work["status"];
                                    $_status = (mysqli_fetch_assoc(mysqli_query($conn, "SELECT `color`  FROM `status_work` WHERE `id`='$status_get' and `id_user`='$id_user' and `piid`='$piid_user'")))["color"];
                                    $_date = thai_date(date("d-m-Y",$row_work["deadline"]));
                                    $hw_hr = max(round(((intval($row_work["deadline"]))-intval(time()))/3600),0);
                                    $id_hw_list = $row_work["id"];
                                    echo"<div class='normal-box hover' onclick='mode($id_hw_list,$status_get,this)'>";
                                    echo"<a class='topic-box' style='font-size:32px;color:$_status;'>$_topic </br><a style='font-size:14px;color:$_status;'>$_date ($hw_hr"." hr".")</a></a>";
                                    if($hw_hr <= 72 && $hw_hr > 24){
                                        echo"<div style='color:#FFB600;position:absolute;top:-15;right:-5;'><i class='fa fa-warning' style='font-size:32px'></i></div>";
                                    }elseif($hw_hr <= 24){
                                        echo"<div style='color:red;position:absolute;top:-15;right:-5;'><i class='fa fa-warning' style='font-size:32px'></i></div>";
                                    }
                                    echo"<hr align='left'>";
                                    $_status_name = (mysqli_fetch_assoc(mysqli_query($conn, "SELECT `status`  FROM `status_work` WHERE `id`='$status_get' and `id_user`='$id_user' and `piid`='$piid_user'")))["status"];
                                    echo"<h3 style='color:#878787;'>Status: <a style='color:$_status;'>$_status_name</a></h3>";
                                    $_workname = $row_work["workname"];
                                    echo"<h3 style='color:#878787;'>Work: <a style='color:#ADC1FF;'>$_workname</a></h3>";
                                    $_infomation = $row_work["infomation"];
                                    echo"<h3 style='color:#878787;'>Info: <a style='color:#ADC1FF;'>$_infomation</a></h3>";
                                    echo"</div>";
                                }
                            }
                        }else{
                            echo"ไม่มีข้อมูล";
                        }
                        }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="mode_status" class='notification-loading' align='center' style='display:none;' obj_id="" status_id="">
        <div class='normal-box' style='width:40%;'>
            <button class='normal-btn' style='padding:0;height:30px;width:30px;position:absolute;left:10px;'
                onclick="getelembyid('mode_status').style.display='none';"><i class="fa fa-arrow-left"
                    aria-hidden="true"></i></button></br></br>
            <div class="flex-respone list">
            <?php
                $query_status = mysqli_query($conn, "SELECT `id`,`status`,`color` FROM `status_work` WHERE `id_user`='$id_user' and `piid`='$piid_user'");
                while($query_get = mysqli_fetch_assoc($query_status)){
                    $id_status = $query_get["id"];
                    $name_status = $query_get["status"];
                    $color_status = $query_get["color"];
                    echo("<div class='status_radio'>");
                    echo("<input type='radio' id='$id_status' name='Status_select' value='$id_status'>");
                    echo("<label style='color:$color_status;font-size:16px;' for='$id_status'>$name_status</label><br>");
                    echo("</div>");
                }
            ?>
            </div>
            <hr align="center"></br>
            <div class="flex-respone list">
                <button onclick='edit()' class='normal-btn editbtn' style="width:25%;padding:0;margin:5px;">Edit</button>
                <button onclick='restatus()' class='normal-btn' style="width:45%;padding:0;margin:5px;">Set Status</button>
            </div>
        </div>
    </div>
    <script src="myscript2.js"></script>
    <script>
    function getSelectedRadioValue() {
        // เลือก radio button ที่ถูกเลือก
        var selectedRadio = document.querySelector('input[name="Status_select"]:checked');

        // ดึงค่า value จาก radio button ที่ถูกเลือก
        if (selectedRadio) {
            var selectedValue = selectedRadio.value;
            console.log('Selected value:', selectedValue);
            return selectedValue; // ให้ฟังก์ชัน return ค่า value ที่ถูกเลือก
        } else {
            console.log('No radio button selected.');
            return null; // หรือ return ค่า null หรือค่าที่คุณต้องการให้แสดงถ้าไม่มี radio button ถูกเลือก
        }
    }

    function mode(obj_id, status_id, homework) {
        (document.querySelector('input[name="Status_select"][value="' + status_id + '"]')).checked = true;
        (document.getElementById("mode_status")).setAttribute('obj_id', obj_id);
        (document.getElementById("mode_status")).setAttribute('status_id', status_id);
        getelembyid("mode_status").style.display = "block";
    }

    function restatus() {
        var id_hw = document.getElementById("mode_status").getAttribute('obj_id');
        var status_hw = getSelectedRadioValue();
        var form_data = new FormData();
        form_data.append("cmm", "work_restatus");
        form_data.append("id_hw", id_hw);
        form_data.append("status_hw", status_hw);
        $.ajax({
            url: 'edit',
            data: form_data,
            datatype: 'json',
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data) {
                console.log(data);
                let result = data.indexOf("9001");
                if (result != "-1") {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Successful!',
                        showConfirmButton: true,
                        timer: 1500
                    }).then((msg) => {
                        //Successful
                        window.location.href = "work_list";
                    })
                } else {
                    let result_info = data.indexOf("9002");
                    if (result_info != "-1") {
                        Swal.fire({
                            position: 'center',
                            icon: 'info',
                            title: 'Have Problem!',
                            showConfirmButton: true,
                            timer: 1500
                        }).then((msg) => {
                            //Info
                        })
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Error!!',
                            showConfirmButton: true,
                            timer: 1500
                        }).then((msg) => {
                            //error
                            window.location.href = "work_list";
                        })
                    }
                }
            },
            error: function(data) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Server Down!!',
                    showConfirmButton: true,
                    timer: 1500
                }).then((msg) => {
                    window.location.href = "logout";
                })
            }
        });
    }

    function edit(){
        var id_hw = document.getElementById("mode_status").getAttribute('obj_id');
        window.location.href = "edit_page?cmm=list_work&objid="+id_hw;
    }
    </script>
</body>

</html>