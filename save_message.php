<?php 
include_once 'header.php';

if ((isset($_POST['id'])) and (isset($_POST['message'])) and ($_POST['id']==$_SESSION['user_id']))
{
	$user_id = intval($_POST['id']);
	$message = $_POST['message'];
	$message = $mysqli->real_escape_string($message);	
}
if (isset($_POST['room_id']))
{
	$room_id = intval($_POST['room_id']);
}

if ((!empty($user_id)) and (!empty($message)) and (!empty($room_id)))
{
	$mysqli->query('INSERT INTO messages(user_id,message,room_id) VALUES("'.$user_id.'", "'.$message.'", "'.$room_id.'")');
}
if ((!empty($user_id)) and (!empty($message)) and (empty($room_id)))
{
	$mysqli->query('INSERT INTO messages(user_id,message) VALUES("'.$user_id.'", "'.$message.'")');
}

if (!empty($room_id))
{
	select_room_messages($mysqli, $room_id);
}

if (empty($room_id))
{
	select_all_messages($mysqli);
}

