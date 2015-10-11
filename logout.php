<?php
include_once 'header.php';
unset($_SESSION['login']);
session_destroy();
header('Location:'.$_SERVER["HTTP_REFERER"]);
die;

?>