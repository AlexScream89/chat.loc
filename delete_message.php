<?php 
include_once 'header.php';

if (isset($_POST['message_id']))
{
	$message_id = intval($_POST['message_id']);
}
if (isset($_POST['room_id']))
{
	$room_id = intval($_POST['room_id']);
}
if ((!empty($message_id)) and ($_SESSION['is_admin']==1))
{
	$mysqli->query('DELETE FROM messages WHERE message_id = "'.$message_id.'"');
}
if (!empty($room_id))
{
	select_room_messages($mysqli, $room_id);
}

if (empty($room_id))
{
	select_all_messages($mysqli);
}


