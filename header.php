<?php
session_start();
error_reporting(E_ALL);
$mysqli = new mysqli('localhost', 'root', '12345','chat-loc');
$mysqli->set_charset("utf8");
include_once 'functions.php';




