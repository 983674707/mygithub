<?php
session_start();

include(dirname(dirname(__FILE__)) . "/model/conn.php");
if ($_GET['r'] == "logout") {
    $conn = new conn();
    $conn->updateAdminLogin($_SESSION['username'], $_SESSION['lasttime'], $_SESSION['ip']);
    $_SESSION = array();        //清空session[]
    setcookie('PHPSESSID', ' ', time() - 1, '/'); //删除本地cookie
    session_destroy();      //删除服务器session文件
}

if (!isset($_SESSION['username'])) {
    header("Location:login.controller.php");
}
function selectAll()
{
    $length = 10;
    $conn = new conn();
    $query = $conn->selectCount();
    $count = $query->fetch_row();
    $pages = ceil($count[0] / $length);
    $page = $_GET['page'] ? $_GET['page'] : 1;
    global $nextPage;
    global $prePage;
    $prePage = $page - 1;
    if ($prePage <= 1) {
        $prePage = 1;
    }
    $nextPage = $page + 1;
    if ($nextPage >= $pages) {
        $nextPage = $pages;
    }
    $offset = ($page - 1) * $length;
    $query = $conn->selectAll($offset, $length);

    while ($result = $query->fetch_assoc()) {
        $id = intval($result['id']);
        $user_name = htmlspecialchars($result['user_name']);
        $password = htmlspecialchars($result['password']);
        $phone = htmlspecialchars($result['phone']);
        echo "
        <tr>
            <td>$user_name</td>
            <td>$password</td>
            <td>$phone</td>
            <td>
                <a href=" . URL . "controllers/update.controller.php?id=$id>更新</a>
                <a class='del' href=" . URL . "controllers/main.controller.php?del=$id>删除</a>
            </td>
        </tr>";
    }
}

include(FILE . "/thems/main.php");
function select()
{
    $conn = new conn();

    if (isset($_GET['phone']) && !empty($_GET['phone'])) {
        echo "<div style='color: red'><br><h5>结果：</h5>";
        $select = $conn->selectPhone($_GET['phone']);
        $i = 0;
        while ($result = $select->fetch_assoc()) {
            $id = intval($result['id']);
            $user_name = htmlspecialchars($result['user_name']);
            $password = htmlspecialchars($result['password']);
            $phone = htmlspecialchars($result['phone']);

            echo "<div id='fra'><a id='sel' href='" . URL . "controllers/update.controller.php?id=$id'><span>ID:</span>" . $id . " <span>姓名：</span>" . $user_name . " <span>密码：</span>" . $password . " <span>电话：</span>" . $phone . "</a><a id='sel' class='del' style='float:right' href=" . URL . "controllers/main.controller.php?del=$id>删除</a></div>" . "<br><br>";
            $i++;
        }

        if ($i == 0) {
            echo "NULL";
        }

        echo "</div>";


    }

}


if (isset($_GET['del'])) {
    $conn = new conn();


    if ($conn->del($_GET['del'])) {


        echo "<script>";
        echo "layer.msg('删除成功',{icon: 1 });";
        echo "setTimeout(function(){location.href='" . URL . "';},1000);";
        echo "</script>";

    } else {
        echo "<script>";
        echo "layer.msg('删除失败',{icon: 2 });";
        echo "setTimeout(function(){location.href='" . URL . "';},1000);";
        echo "</script>";

    }


}