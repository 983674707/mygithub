<?php

include(dirname(dirname(__FILE__)) . "/model/conn.php");
include(FILE . "/thems/login.php");
session_start();
if (isset($_SESSION['username'])) {
    header("Location:" . URL);
}
$conn = new conn();

if (@!empty(trim($_POST['user_name'])) && !empty(trim($_POST['password']))) {
    $user_name = trim($_POST['user_name']);
    $password = sha1(trim($_POST['password']));
    $select = $conn->login($user_name, $password);
    $result = $select->fetch_assoc();
    if ($result) {
        $_SESSION['lasttime'] = time();
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['username'] = $user_name;
//        $_SESSION['status']=true;
        echo "<script>";
        echo "layer.msg('登陆成功',{icon: 1 });";
        echo "setTimeout(function(){location.href='" . URL . "controllers/main.controller.php';},500);";
        echo "</script>";

    } else {
        echo "<script>";
        echo "layer.msg('登陆失败',{icon: 2 });";
        echo "setTimeout(function(){location.href='" . URL . "controllers/login.controller.php';},500);";
        echo "</script>";


    }

}