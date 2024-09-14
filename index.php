<?php
session_start();
include "cnn";
date_default_timezone_set('Asia/Bangkok');
$id_user = $_SESSION["id"];
$piid_user = $_SESSION["piid"];

if($id_user != "" && $piid_user != ""){
    header("location: home");
}
?>
<html>

<head>
    <title>Login</title>
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

    @media screen and (max-width: 800px) {
        .normal-box {
            max-width: 90%;
        }
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
            <div class="warp-item"><a class="active" href=""><i class="fa fa-user"
                        style="font-size:24px"></i>&nbsp;&nbsp;&nbsp;Login</a></div>
        </div>
        <div class="item">
            <div class="showpage">
                <div class="pagename"><a><i class="fa fa-user" style="font-size:24px"></i> Daily</a></div>
                <div class="menu" onclick="menu(this)"><i class="fa fa-reorder" style="font-size:34px"></i></div>
            </div>
            <div class="flex-respone">
                <div class="normal-box" style="width:50%;">
                    <a class="topic-box">Login <a style="font-size:12px;color:#a4a6ad;" id="currenttime"></a></a>
                    <hr align="left"></br>
                    <input autocomplete="off" style="padding-left:10px;height:45px;width:100%;" id="username"
                        name="username" class="my-input" type="text" placeholder="Username" required>
                    <input autocomplete="off" style="padding-left:10px;height:45px;width:100%;" id="pass" name="pass"
                        class="my-input" type="password" placeholder="Password" required>
                    <button onclick="send_status(this)" id="login-btn" style="width:100%;height:45px;"
                        class="normal-btn">Login</button>
                </div>
            </div>
        </div>
    </div>
    <script src="myscript2.js"></script>
    <script>
    function send_status(form) {
        document.getElementById("login-btn").style.display = "none";
        var form_data = new FormData();
        form_data.append("username", document.getElementById('username').value);
        form_data.append("password", document.getElementById('pass').value);
        $.ajax({
            url: 'login',
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
                        window.location.href = "home";
                    })
                } else {
                    let result_info = data.indexOf("9002");
                    if (result_info != "-1") {
                        Swal.fire({
                            position: 'center',
                            icon: 'info',
                            title: 'Incorrect!',
                            showConfirmButton: true,
                            timer: 1500
                        }).then((msg) => {
                            //Info
                            document.getElementById("login-btn").style.display = "block";
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
                            window.location.href = "logout";
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
    </script>
</body>

</html>