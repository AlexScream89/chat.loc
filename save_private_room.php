<?php 
include_once 'header.php';

if ((isset($_POST['room_name'])) and ($_SESSION['is_admin']==1))
{
	$room_name = $_POST['room_name'];
	$room_name = $mysqli->real_escape_string($room_name);	
	$mysqli->query('INSERT INTO private_rooms(room_name) VALUES("'.$room_name.'")');	
}