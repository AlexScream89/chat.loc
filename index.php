<?php
include_once 'header.php';
$res = $mysqli->query('SELECT * FROM users ORDER BY user_id');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Тестовое задание</title>
    
    <link href="/css/bootstrap.css" rel="stylesheet">
    
    <link href="/css/jumbotron.css" rel="stylesheet">	
</head>

<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" id="all_users_room">Вернуться в общий чат</a>
        </div>
        <?php if (empty($_SESSION['login'])){?>
        <div class="navbar-collapse collapse">
            <form class="navbar-form navbar-right" role="form" method="POST" action="enter_chat.php">
                <div class="form-group">
                    <input type="text" name="login" placeholder="Login" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" class="form-control">
                </div>
                <button type="submit" id="enter_login" name="enter_login" class="btn btn-success">Войти</button>				
            </form>
        </div><!--/.navbar-collapse -->
        <?php } if (!empty($_SESSION['login'])){ ?>
        <div class="navbar-form navbar-right login">
            <?php echo 'Вы вошли как, '.$_SESSION['login']; ?>
            <a href="/logout.php" class="btn btn-danger">Выйти</a>			
			<?php } ?>
        </div>
    </div>
</div>

<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-md-3">
			<?php if (isset($_SESSION['login'])){ ?>
            <h2>Каналы</h2>
			<?php } ?>
			<?php if (isset($_SESSION['login']) and ($_SESSION['is_admin']==1)){ ?>
            <p><button id="add_room" class="btn btn-primary">Создать канал</button></p>
			<?php } ?>
			<div id="create-room">
				<div class="form-group">
					<input type="text" id="room" class="form-control" placeholder="Имя канала">
				</div>
				<div id="room-name">
					<button id="add_room_name" class="btn btn-primary">Готово</button>
					<button id="cancel_room_name" class="btn btn-danger">Отмена</button>
				</div>
			</div>
			<div id="create-room-user">	
				<div class="form-group">
					<select id="select_users" class="form-control">
						<?php while($data = $res->fetch_assoc()){ if ($data['login'] != 'admin'){?>
						<option value="<?=$data['user_id']?>"><?=$data['login']?></option>
						<?php } } ?>
					</select>
				</div>				
				<div id="room-users">
				</div>
				<div class="form-group">
					<button id="add_user" class="btn btn-primary">Добавить пользователя</button>
				</div>
				<div class="form-group">
					<button id="save_room" class="btn btn-primary">Сохранить изменения</button>
				</div>
			</div>
			<div id="private-room">			
			</div>
        </div>
        <div class="col-md-9">			
			<h2 id="room_name">Общий чат</h2>			
            <div id="public-room">			
			</div>
			<div id="enter-message">
				<form role="form">	
					<div class="form-group">
						<input type="hidden" id="user_id" class="form-control" value='<?php if (isset($_SESSION['user_id'])){echo $_SESSION['user_id'];}?>'>
					</div>
					<div class="form-group">
						<input type="hidden" id="login" class="form-control" value='<?php if (isset($_SESSION['login'])){echo $_SESSION['login'];}?>'>
					</div>
					<div class="form-group">
						<textarea id="message" class="form-control"></textarea>
					</div>
					<div id="room_id">						
					</div>
					<button type="submit" id="submit_message" class="btn btn-primary">Отправить сообщение</button>
				</form>
			</div>            
        </div>
    </div>    
</div> <!-- /container -->

<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/jquery.nicescroll.min.js"></script>
<script>
	var is_admin = '<?php if(isset($_SESSION['is_admin'])){ echo $_SESSION['is_admin'];}?>';
</script>
<script src="/js/main.js"></script>
</body>
</html>