<?php
require_once('connect_to_server.php');
function get_user_profile($user){
    global $db;
    $sql_cmd = "SELECT * from user_profile where username = '$user'";
    $sql = mysqli_query($db, $sql_cmd);

    $row = mysqli_num_rows($sql);
    if($row)
        return mysqli_fetch_array($sql);
    mysqli_close($db);
    return 0;
}
function update_profile($user, $name, $addr, $pnumber, $avatar, $gender){
    global $db;
    $sql_cmd = "UPDATE user_profile set name = '$name', address = '$addr', phonenumber = '$pnumber', avatar = '$avatar', gender = '$gender' where username = '$user'";
    $sql = mysqli_query($db, $sql_cmd);
    
    return 0;
}
function password_checker($user, $password){
    global $db;
    $md5_pswd = md5($password);
    $sql_cmd = "SELECT * from user where username = '$user' and password = '$md5_pswd'";
    $sql = mysqli_query($db, $sql_cmd);
    
    $row = mysqli_num_rows($sql);
    if($row)
        return 1;
    mysqli_close($db);
    return 0;
}
function update_password($user, $password){
    global $db;
    $md5_pswd = md5($password);
    $sql_cmd = "UPDATE user set password = '$md5_pswd' where username = '$user'";
    $sql = mysqli_query($db, $sql_cmd);
    
    return 0;
}
?>