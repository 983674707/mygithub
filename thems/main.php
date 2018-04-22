<?php
include(FILE . "/thems/common/header.html");
include(FILE . "/thems/common/header-menu.html");
?>
<!--    <script>-->
<!--        window.onload = function() {-->
<!--            var oTab = document.getElementById('tab1');-->
<!--            var oText = document.getElementById('name');-->
<!--            var oBtn = document.getElementById('btn1');-->
<!--            oBtn.onclick = function() {-->
<!--                for (var i = 0; i < oTab.tBodies[0].rows.length; i++) {-->
<!--                    if (oTab.tBodies[0].rows[i].cells[3].innerHTML == oText.value) {-->
<!--                        oTab.tBodies[0].rows[i].style.background = 'yellow';-->
<!--                        oTab.tBodies[0].rows[i].style.color = '#FF00FF';-->
<!--                    } else {-->
<!--                        oTab.tBodies[0].rows[i].style.background = '';-->
<!--                        oTab.tBodies[0].rows[i].style.color = '';-->
<!--                    }-->
<!--                }-->
<!--            }-->
<!--        }-->
<!---->
<!--    </script>-->

<div id="frame">
    <h1>信息管理平台(Beta)</h1>
    <div style="float: left;margin-left:110px;color: red;font-size: 13px">*添加时请填写全部属性！</div>
    <br>
    <div class="inp">
        <form method="post" style="float: left" action="<?= URL ?>controllers/add.controller.php">
            <input placeholder="用户名" class="text" type="text" name="user_name" required>
            <input placeholder="密码" class="text" type="text" name="password" required>
            <input placeholder="电话" class="text" type="text" name="phone" required>
            <input class="btn" type="submit" value='添加'>
        </form>
        <form action="<?= URL ?>controllers/main.controller.php" method="get">
            <input placeholder="电话" id="name" name="phone" class="text" type="text" required>
            <input id="btn1" class="btn" type="submit" value='搜索'>
        </form>

        <?= select(); ?>

    </div>


    <table id="tab1" border="1" width="800px">
        <thead>

        <td>用户名</td>
        <td>密码</td>
        <td>电话</td>
        <td>操作</td>
        </thead>

        <tbody>
        <?= selectAll(); ?>

        </tbody>

    </table>
    <div style="text-align: center;margin-top: 10px">
    <a  href="<?=    URL ?>controllers/main.controller.php?page=<?= $prePage ?>">上一页</a>|
    <a  href="<?= URL ?>controllers/main.controller.php?page=<?= $nextPage ?>">下一页</a>
    </div>
</div>
<script>
    $(".del").click(function() {
        f=confirm("是否删除该数据？");
        if(!f){
            return false;
        }

    })

</script>
</body>

</html>