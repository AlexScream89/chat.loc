<?php 
include_once 'header.php';

if (($_SESSION['is_admin'] == 1) and (isset($_SESSION['is_admin'])))
{
	$res = $mysqli->query('SELECT * FROM private_rooms ORDER BY room_id');
	$result = array();
	while($data = $res->fetch_assoc())
	{
		$result[] = $data;
	}

	echo json_encode($result);
}

if (($_SESSION['is_admin'] != 1) and (isset($_SESSION['is_admin'])))
{
	$user_id = intval($_SESSION['user_id']);
	$res = $mysqli->query('SELECT t1.room_name,t1.room_id FROM private_rooms t1 INNER JOIN user_rooms t2 ON t1.room_id=t2.room_id WHERE t2.user_id = "'.$user_id.'"');
	$result = array();
	while($data = $res->fetch_assoc())
	{
		$result[] = $data;
	}

	echo json_encode($result);
}

