<?php
session_start();
echo $_SESSION['error'];
echo "<a href=\"./index.php\">返回重试</a>";