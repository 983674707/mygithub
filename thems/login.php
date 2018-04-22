<?php
include(FILE . "/thems/common/header.html");
?>

<div id="loginForm">
    <h1 id="h1">Login</h1>
    <hr>
    <form method="post" style="text-align: center">
        <input type="text" class="text" style="width:100%;margin: 20px 0px 10px 0px" name="user_name" required placeholder="账号"><br>
        <input type="password" class="text" style="width:100%;margin: 10px 0px " name="password" required placeholder="密码"><br><br>
        <input type="submit" class="btn" style="width: 100%" value="登陆">
    </form>
    <div style="font-size:14px;margin-top: 50px;text-align: center">&copy;2017-<?=date("Y")?></div>

</div>
</body>

</html>