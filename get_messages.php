<?php 
include_once 'header.php';

if (isset($_POST['room_id']))
{
	$room_id = intval($_POST['room_id']);
	select_room_messages($mysqli, $room_id);
}