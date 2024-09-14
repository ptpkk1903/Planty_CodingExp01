<?php
$servername = "xxxxxxxxxxxxxxxx";
$username = "xxxxxxxxxxxxxxxx";
$password = "xxxxxxxxxxxxxxxx";
$db = "xxxxxxxxxxxxxxxx";
$conn = mysqli_connect($servername, $username, $password , $db);
if (!$conn) {
    die('Could not connect: ' . mysqli_error());
}
function mysql_escape_mimic($inp) {
    if(is_array($inp))
        return array_map(__METHOD__, $inp);
    if(!empty($inp) && is_string($inp)) {
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
    }
    return $inp;
}
function cleanMe($input) {
    $input = mysql_escape_mimic($input);
    $input = htmlspecialchars($input, ENT_IGNORE, 'utf-8');
    $input = strip_tags($input);
    $input = stripslashes($input);
    return $input;
 }
?>