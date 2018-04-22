<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:login.controller.php");
}
include(dirname(dirname(__FILE__)) . "/model/conn.php");
include(FILE . "/thems/add.php");
$conn = new conn();

if (!empty(trim($_POST['user_name'])) && !empty(trim($_POST['password'])) && !empty(trim($_POST['phone']))) {
    $isset = $conn->selectName($_POST['user_name']);
    $isset = $isset->fetch_assoc();
    if ($isset) {
        echo "<script>";
        echo "layer.msg('用户已存在',{icon: 0 });";
        echo "setTimeout(function(){location.href='" . URL . "';},1000);";
        echo "</script>";
    } else {
        $result = $conn->add($_POST['user_name'], $_POST['password'], $_POST['phone']);
        if ($result) {

            echo "<script>";
            echo "layer.msg('添加成功',{icon: 1 });";
            echo "setTimeout(function(){location.href='" . URL . "';},1000);";
            echo "</script>";

        } else {
            echo "<script>";
            echo "layer.msg('添加失败',{icon:2 });";
            echo "setTimeout(function(){location.href='" . URL . "';},1000);";
            echo "</script>";
        }
    }
} else {
    header("Location:" . URL);
}

