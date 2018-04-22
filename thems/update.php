<?php
include(FILE . "/thems/common/header.html");
include(FILE . "/thems/common/header-menu.html");
?>

<div id="frame">
    <h1>信息管理平台(Beta)</h1>

    <form method="post" style="text-align: center">
        姓名：<input type="text" class="text" style="text-align:center;width:150px;margin: 10px 0px" name="user_name"
                  value="<?= $user_name ? $user_name : ' ' ?>" required><br>
        密码：<input type="text" class="text" style="text-align:center;width:150px;margin: 10px 0px " name="password"
                  value="<?= $password ? $password : ' ' ?>" required><br>
        电话：<input type="text" class="text" style="text-align:center;width:150px;margin: 10px 0px " name="phone"
                  value="<?= $phone ? $phone : ' ' ?>" required><br><br>

        <input type="submit" class="btn" style="width: 80px" value="保存">
        <input type="button" class="btn" style="width:80px;"
               onclick="location.href='<?= URL ?>controllers/main.controller.php'" value="返回"/>

    </form>

</div>
</body>

</html>