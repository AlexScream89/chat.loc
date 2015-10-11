<?php
include_once 'header.php';

if (isset($_POST['enter_login']))
{
	if ((!empty($_POST['login'])) and (!empty($_POST['password'])))
	{
		$login = $_POST['login'];
		$password = $_POST['password'];
		$res = $mysqli->query('SELECT * FROM users');
		while($data = $res->fetch_assoc())
		{
			if (($login == $data['login']) and ($password == $data['password']))
			{
				$_SESSION['login'] = $login;
				$_SESSION['user_id'] = $data['user_id'];
				$_SESSION['is_admin'] = $data['is_admin'];
				header('Location:'.$_SERVER["HTTP_REFERER"]);
			}
			else header('Location:'.$_SERVER["HTTP_REFERER"]);
		}
	}
}







