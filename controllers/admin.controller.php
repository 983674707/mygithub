<?php
include(dirname(dirname(__FILE__)) . "/model/conn.php");
session_start();
if(!isset($_SESSION['username'])){
    header("Location:".URL);
}
$user=$_SESSION['username'];
$conn = new conn();
$select=$conn->selectAdmin($user);

while($result=$select->fetch_assoc()){
    $user=$result['user'];
    $pass=$result['password'];
    $createtime=$result['createtime'];
    $lasttime=$result['lasttime'];
    $lastIP=$result['ip'];
}
include(FILE . "/thems/admin.php");
if(!empty(trim($_POST['pass']))){
    $pass=sha1(trim($_POST['pass']));

    $result=$conn->updateAdminPass($user,$pass);
    if($result){
        echo "<script>";
        echo "layer.msg('修改成功',{icon: 1 });";
        echo "setTimeout(function(){location.href='" . URL . "controllers/admin.controller.php';},500);";
        echo "</script>";
    }else{
        echo "<script>";
        echo "layer.msg('修改失败',{icon: 2 });";
        echo "setTimeout(function(){location.href='" . URL . "controllers/admin.controller.php';},500);";
        echo "</script>";
    }

}

