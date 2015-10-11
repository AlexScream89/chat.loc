<?php 
include_once 'header.php';

$res_user = mysql_query('SELECT t1.login FROM users t1 INNER JOIN user_rooms t2 ON t1.user_id=t2.user_id WHERE t2.room_id = "'.$room_id.'"');
$result_user = array();
	while($data_user = mysql_fetch_assoc($res_user))
	{
		$result_user[] = $data_user;
	}

	echo json_encode($result_user);