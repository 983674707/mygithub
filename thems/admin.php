<?php
include(FILE . "/thems/common/header.html");
include(FILE . "/thems/common/header-menu.html");
?>

<div id="loginForm">
    <h1 id="h1"><?=strtoupper($user)?></h1>
    用户名：<?=$user?><br><br>
    创建时间：<?=date("Y-m-d H:i:s",$createtime)?><br><br>
    上次登录时间：<?=date("Y-m-d H:i:s",$lasttime)?><br><br>
    上次登录IP：<?=$lastIP?><br><br>
    <hr/><br>
    <form method="post" >
       密码： <input class="text" style="width: 200px" type="password" name="pass" required><br><br>
        <div style="text-align: center">
        <input class="btn"  type="submit" value="修改密码">
        </div>
    </form>
</div>
</body>

</html>