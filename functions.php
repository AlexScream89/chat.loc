<?php

function select_all_messages(mysqli $mysqli){
    $res = $mysqli->query('SELECT t1.login,t2.message,t2.message_id FROM users t1 INNER JOIN messages t2 ON t1.user_id=t2.user_id WHERE t2.room_id is NULL');
    $result = array();
    while($data = $res->fetch_assoc())
    {
        $result[] = $data;
    }
    echo json_encode($result);
}
function select_room_messages(mysqli $mysqli, $room_id){
    $res = $mysqli->query('SELECT t1.login,t2.message,t2.message_id FROM users t1 INNER JOIN messages t2 ON t1.user_id=t2.user_id WHERE t2.room_id = "'.$room_id.'"');
    $result = array();
    while($data = $res->fetch_assoc())
    {
        $result[] = $data;
    }
    echo json_encode($result);
}
function select_room_users(mysqli $mysqli, $room_id){
    $select_users = $mysqli->query('SELECT t1.user_id,t1.login FROM users t1 INNER JOIN user_rooms t2 ON t1.user_id=t2.user_id WHERE room_id = "'.$room_id.'"');
    $users = array();
    while($data_user = $select_users->fetch_assoc())
    {
        $users[] = $data_user;
    }

    echo json_encode($users);
}
