<?php

include(dirname(dirname(__FILE__)) . "/config/config.inc.php");


class conn
{


    public function connect()
    {

        $conn = @new mysqli(HOST, USER, PASS, DB);

//        $conn->set_charset("utf8");
        if (mysqli_connect_errno()) {
            $error = mysqli_connect_error();

            session_start();
            if (isset($_SESSION['error'])) {
                unset($_SESSION['error']);
            }
//            $_SESSION['error'] = $error;
            $_SESSION['error'] = "数据库连接失败！";

            header("Location:" . URL . "error.php");

        }

        return $conn;
    }

    public function login($name, $password)
    {
        $name = addslashes(trim($name));
        $password = addslashes(trim($password));
        $sql = "select * from admin where user='{$name}' and password='{$password}'";
        $conn = $this->connect();
        return $conn->query($sql);


    }

    public function selectAdmin($user)
    {
        $user = addslashes(trim($user));
        $sql = "select * from admin where user='{$user}'";
        $conn = $this->connect();
        return $conn->query($sql);
    }

    public function updateAdminLogin($user, $lasttime, $ip)
    {
        $user = addslashes(trim($user));
        $lasttime = addslashes(trim($lasttime));
        $ip = addslashes(trim($ip));
        $sql = "update admin set lasttime='{$lasttime}' , ip='{$ip}' where user='{$user}'";
        $conn = $this->connect();
        return $conn->query($sql);
    }

    public function updateAdminPass($user, $pass)
    {
        $user = addslashes(trim($user));
        $pass = addslashes(trim($pass));
        $sql = "update admin set password='{$pass}' where user='{$user}'";
        $conn = $this->connect();
        return $conn->query($sql);
    }


    public function selectAll($offset, $length)
    {
        $sql = "select * from users limit $offset,$length";
        $conn = $this->connect();
        return $conn->query($sql);
    }

    public function selectCount()
    {
        $sql = "select count(*) from users";
        $conn = $this->connect();
        return $conn->query($sql);
    }

    public function selectid($id)
    {
        $id = addslashes(trim($id));
        $sql = "select * from users where id=" . $id;
        $conn = $this->connect();
        return $conn->query($sql);


    }


    public function selectName($name)
    {
        $name = addslashes(trim($name));
        $sql = "select * from users where user_name='" . $name . "'";
        $conn = $this->connect();
        return $conn->query($sql);


    }

    public function selectPhone($phone)
    {
        $phone = addslashes(trim($phone));
        $sql = "select * from users where phone='" . $phone . "'";
        $conn = $this->connect();
        return $conn->query($sql);

    }

    public function update($id, $user_name, $password, $phone)
    {
        $user_name = addslashes(trim($user_name));
        $password = addslashes(trim($password));
        $phone = addslashes(trim($phone));

        $sql = "update users set user_name='{$user_name}',password='{$password}',phone='{$phone}' where id=$id";
        $conn = $this->connect();
        return $conn->query($sql);

    }

    public function add($user_name, $password, $phone)
    {
        $user_name = addslashes(trim($user_name));
        $password = addslashes(trim($password));
        $phone = addslashes(trim($phone));
        $sql = "insert into users (user_name,password,phone) values ('{$user_name}','{$password}','{$phone}')";
        $conn = $this->connect();
        return $conn->query($sql);

    }

    public function del($id)
    {
        $id = addslashes(trim($id));
        $sql = "delete from users where id =$id";
        $conn = $this->connect();
        return $conn->query($sql);

    }


}