<?php 
include_once 'header.php';

if ((isset($_POST['room_id'])) and ($_SESSION['is_admin']==1))
{
	$room_id = intval($_POST['room_id']);
	$mysqli->query('DELETE FROM private_rooms WHERE room_id = "'.$room_id.'"');
}
