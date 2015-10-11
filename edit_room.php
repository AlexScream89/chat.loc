<?php 
include_once 'header.php';

if ((isset($_POST['room_id'])) and ($_SESSION['is_admin']==1))
{
	$room_id = intval($_POST['room_id']);

	if (!empty($room_id)) {
		select_room_users($mysqli, $room_id);
	}
}