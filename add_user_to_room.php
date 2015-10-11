<?php 
include_once 'header.php';

if (isset($_POST['room_name']))
{
	$room_name = $_POST['room_name'];
	$room_name = $mysqli->real_escape_string($room_name);
}
if (isset($_POST['user_id']))
{
	$user_id = intval($_POST['user_id']);
}

if ((isset($room_name)) and ($_SESSION['is_admin']==1))
{	
	$res = $mysqli->query('SELECT * FROM private_rooms WHERE room_name = "'.$room_name.'"');
	$data = $res->fetch_assoc();
	$room_id = intval($data['room_id']);

	$result = $mysqli->query('SELECT * FROM user_rooms WHERE user_id = "'.$user_id.'" AND room_id = "'.$room_id.'"');
	$res_user = $result->fetch_assoc();

	if ((empty($res_user)) and (isset($user_id)) and (isset($room_id)))
	{
		$mysqli->query('INSERT INTO user_rooms(user_id,room_id) VALUES("'.$user_id.'", "'.$room_id.'")');
	}
	
	if (isset($room_id))
	{
		select_room_users($mysqli, $room_id);
	}
	
}

