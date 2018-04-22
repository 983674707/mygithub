<?php
include("./config/config.inc.php");
include("./thems/common/header.html");
?>
<script src="./public/js/jquery.min.js"></script>
<script>
    function validate() {
        var pwd1 = document.getElementById("pwd1").value;
        var pwd2 = document.getElementById("pwd2").value;
        <!-- 对比两次输入的密码 -->
        if(pwd1 == pwd2) {
            document.getElementById("tishi").innerHTML="<font color='green'>两次密码相同</font>";
            document.getElementById("install").disabled = false;
        }
        else {
            document.getElementById("tishi").innerHTML="<font color='red'>两次密码不相同</font>";
            document.getElementById("install").disabled = true;
        }
    }
</script>
<div id="frame" style="margin-top:30px ">
    <h1>安装系统</h1>
    <form action="" method="post" style="text-align: center">
        PHP版本：<span id="ver"><?= PHP_VERSION ?></span><br><br>
        数据库地址：<input type="text" class="text" style="text-align:center;width:280px;margin: 10px 0px" name="server"
                     required  value="127.0.0.1"><br><br>
        数据库用户：<input type="text" class="text" style="text-align:center;width:280px;margin: 10px 0px" name="user"
                     required autofocus><br><br>
        数据库密码：<input type="text" class="text" style="text-align:center;width:280px;margin: 10px 0px" name="pass"
                     required><br><br>
        数据库名称：<input type="text" class="text" style="text-align:center;width:280px;margin: 10px 0px" name="db" required><br><br>
        <hr/>
        管理员账号：<input type="text" class="text" style="width:280px;margin: 10px 0px" name="username" required placeholder="确认后不可修改"><br><br>
        管理员密码：<input type="password" id="pwd1"class="text" style="width:280px;margin: 10px 0px" name="password" required><br><br>
        重复密码 ： <input type="password" id="pwd2" onkeyup="validate()" class="text" style="width:280px;margin: 10px 0px" name="password" required> <br><br>
        <div id="tishi"></div>
        <input type="submit" id="install" class="btn" style="width:80px;margin-left: 30%"  value="安装">
        <input type="button" id="installing" class="btn" style="display: none;margin-left: 30%;" value="安装中……">
        <input type="button" id="error" class="btn" style="display: none;margin-left: 30%;" value="请更改配置">
        <span id="error_info" style="color: red"></span>
    </form>
</div>
</div>

</body>

</html>
<?php
if (isset($_POST['server'])) {

    if (@!empty(trim($_POST['server'])) && !empty(trim($_POST['user'])) && !empty(trim($_POST['pass'])) && !empty(trim($_POST['db']) && !empty(trim($_POST['username'])) && !empty(trim($_POST['password'])))) {
        $server = trim($_POST['server']);
        $user = trim($_POST['user']);
        $pass = trim($_POST['pass']);
        $db = addslashes(trim($_POST['db']));
        $username = addslashes(trim($_POST['username']));
        $password = sha1(trim($_POST['password']));
//        var_dump($server." ".$user." ".$pass." ".$db);die;
        $conn = @new mysqli($server, $user, $pass);

//        var_dump(mysqli_connect_error());die;
        if (mysqli_connect_errno() != NULL) {
            echo "<script>alert('连接数据库出错！可能数据库信息不正确。');location.href='index.php';</script>";
            die;
        }

        if (!($conn->query("create database " . $db . ";"))) {
            echo "<script>alert('创建数据库失败！可能是数据库已存在！');location.href='index.php';</script>";
            die;
        }

        if (!($conn->query("use " . $db . ";"))) {
            echo "<script>alert('创建数据库失败！');location.href='index.php';</script>";
            die;
        }

        $_sql = file_get_contents('db.sql');        //获取sql内容
        $_arr = explode(';', $_sql);                //用; 分组 ，存入数组中
        $count = count($_arr);   //获取sql文件中sql语句的条数

        $i = 0;             //初始化$i ,
        foreach ($_arr as $_value) {
            if ($conn->query($_value . ';')) {
                $i++;           //执行一句，$i就加1
            } else {
                if ($i + 1 == $count) {       //结束后，对比是否全部执行完毕
                    $lasttime = time();
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $createtime = time();
                    $sql = "insert into admin (user,password,lasttime,ip,createtime) values('{$username}','{$password}','{$lasttime}','{$ip}','{$createtime}')";
                    if ($conn->query($sql)) {
                        echo "<script>alert('安装成功');location.href='index.php';</script>";
                        unlink("db.sql");
                    } else {
                        echo "<script>alert('插入数据失败');location.href='index.php';</script>";
                    }
                } else {
                    if (!($conn->query("drop database " . $db . ";"))) {
                        echo "<script>alert('创建数据表出现问题，初始化失败，请手动删除创建的数据库…');location.href='index.php';</script>";
                        die;
                    }
                    echo "<script>alert('创建数据表出现问题，正在初始化，请重新安装！db.sql可能存在问题 ');location.href='index.php';</script>";
                    die;
                }
            }
        }
        $conn->close();
        $rs = file_put_contents(
            "./config/config.inc.php",
            "define(\"HOST\",\"$server\");
define(\"USER\",\"$user\");
define(\"PASS\",\"$pass\");
define(\"DB\", \"$db\");",
            FILE_APPEND);
//    var_dump($rs);
        if ($rs == false) {
            exit("写入文件失败，请修改文件权限");
        }
    }
} else {

    if (!version_compare(PHP_VERSION, '5.4.9', 'ge')) {
        $error = '您的PHP版本过低,请升级到5.5以上 7.0以下';

        echo "<script>
            $(\"#error_info\").text(\"$error\");
            $(\"#install\").attr({style:\"display:none;\"});
            $(\"#error\").attr({style:\"display:;\"});        
            </script>";
    }
    if (version_compare(PHP_VERSION, '7.0.0', 'ge')) {
        $error = "您的PHP版本大于7.0.0,可能出现问题，请更换php版本（5.5~7.0）";

        echo "<script>
            $(\"#error_info\").text(\"$error\");
            $(\"#install\").attr({style:\"display:none;\"});
            $(\"#error\").attr({style:\"display:;\"});        
            </script>";
    }
    $config_file = __DIR__ . "/config/config.inc.php";
    $db_file = __DIR__ . "/db.sql";
    if (!is_readable($db_file) || !is_writable($config_file)) {
        $error = "请将" . __DIR__ . "开启777权限 ";
        echo "<script>
            $(\"#error_info\").text(\"$error\");
            $(\"#install\").attr({style:\"display:none;\"});
            $(\"#error\").attr({style:\"display:;\"});        
            </script>";

    }
}

?>
<script>
    $(document).ready(function () {
        $("form").submit(function (e) {
            $("#install").attr({style: "display:none"});
            $("#installing").attr({style: "display:"});
        })
    })
</script>
