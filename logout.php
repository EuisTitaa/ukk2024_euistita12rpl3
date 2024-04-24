<?php

session_start();
$_SESSION = [];
session_unset();
session_destroy();
$user_id = $_GET["user_id"];
header("Location: login.php?$user_id");
exit;

?>