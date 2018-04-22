<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:login.controller.php");
}
include(dirname(dirname(__FILE__)) . "/model/conn.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location:" . URL);
}

$conn = new conn();
$query = $conn->selectid($id);
$info = $query->fetch_assoc();
if ($info) {
    $user_name = htmlspecialchars($info['user_name']);
    $password = htmlspecialchars($info['password']);
    $phone = htmlspecialchars($info['phone']);
} else {
    echo "<script>";
    echo "alert('信息不存在');";
    echo "location.href='" . URL . "'";
    echo "</script>";
}
//echo "<pre>";
//var_dump($info);
//echo "</pre>";


include(FILE . "/thems/update.php");

if (@!empty(trim($_POST['user_name'])) && !empty(trim($_POST['password'])) && !empty(trim($_POST['phone']))) {

    $result = $conn->update($id, $_POST['user_name'], $_POST['password'], $_POST['phone']);
    if ($result) {

        echo "<script>";
        echo "layer.msg('保存成功',{icon: 1 });";
        echo "setTimeout(function(){location.href='" . URL . "controllers/update.controller.php?id={$id}';},500);";
        echo "</script>";


    } else {
        echo "<script>";
        echo "layer.msg('操作失败，请刷新后重新操作',{icon: 2 });";
        echo "setTimeout(function(){location.href='" . URL . "controllers/update.controller.php?id={$id}';},500);";
        echo "</script>";

    }

}