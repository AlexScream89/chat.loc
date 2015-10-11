<?php 
include_once 'header.php';

if((isset($_POST['room_name'])) and (isset($_POST['user_id'])) and ($_SESSION['is_admin']==1))
{
	$room_name = $_POST['room_name'];
	$user_id = intval($_POST['user_id']);
	$room_name = $mysqli->real_escape_string($room_name);

	$res = $mysqli->query('SELECT * FROM private_rooms WHERE room_name = "'.$room_name.'"');
	$data = $res->fetch_assoc();
	$room_id = intval($data['room_id']);

	$mysqli->query('DELETE FROM user_rooms WHERE user_id = "'.$user_id.'" AND room_id = "'.$room_id.'"');

	select_room_users($mysqli, $room_id);
}