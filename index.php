<?php
include(dirname(__FILE__) . "/config/config.inc.php");
if (is_file("db.sql")) {

    header("Location:install.php");
} else {

    header("Location:" . URL . "controllers/main.controller.php");
}