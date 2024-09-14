<?php
session_start();
$_SESSION["id"] = "";
$_SESSION["piid"] = "";
session_destroy();

header("location: index.php");