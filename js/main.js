$(document).ready(function(){

	$("#public-room").niceScroll();
	$('#create-room').hide();
	$('#create-room-user').hide();
	$('#add_room').click(function(){
		$('#add_room').fadeOut('fast');
		$('#create-room').fadeIn("fast");
		$('#private-room').fadeOut("fast");
		$('#add_room_name').fadeIn('fast');
		$('#cancel_room_name').fadeIn('fast');
		$('#room').val('');
	});
	$('#save_room').click(function(){
		$('#create-room').fadeOut("fast");
		$('#create-room-user').fadeOut("fast");
		$('#private-room').fadeIn("fast");
		$('#add_room').fadeIn('fast');
		get_private_rooms();
	});
	$('#add_room_name').click(function(){
		var room_name = $('#room').val();
		if (room_name!=''){
			$('#add_room_name').fadeOut("fast");
			$('#cancel_room_name').fadeOut("fast");
			$('#create-room-user').fadeIn("fast");
			$.post('save_private_room.php',{room_name:room_name},function(){
				$('#room-users').html('');
			});
		}
	});
	$('#add_user').click(function(){
		var user_id = $('#select_users').val();
		var room_name = $('#room').val();
		$.ajax({
			type: 'POST',
			url: 'add_user_to_room.php',
			dataType: 'JSON',
			data: {user_id:user_id, room_name:room_name},
			success: function(data){
				$('#room-users').html('');
				$.each(data, function(key,row){
					$('#room-users').append("<div id='"+row.user_id+"'>"+row.login+"<a id='delete_user' class='navbar-right glyphicon glyphicon-remove'></a></div><br>");
				});
			}
		});
	});
	$(document).on('click','#delete_user',function(){
		var user_id = $(this).parent().attr("id");
		var room_name = $('#room').val();
		$.ajax({
			type: 'POST',
			url: 'delete_user_from_room.php',
			dataType: 'JSON',
			data: {user_id:user_id, room_name:room_name},
			success: function(data){
				$('#room-users').html('');
				$.each(data, function(key,row){
					$('#room-users').append("<div id='"+row.user_id+"'>"+row.login+"<a id='delete_user' class='navbar-right glyphicon glyphicon-remove'></a></div><br>");
				});
			}
		});
	});
	$(document).on('click','#delete_room',function(){
		var room_id = $(this).parent().attr("id");
		$.post('delete_room.php',{room_id:room_id},function(){
			get_private_rooms();
		});
	});
	function get_private_rooms(){
		$.ajax({
			type: 'GET',
			url: 'get_private_rooms.php',
			dataType: 'JSON',
			data: {},
			success: function(data){
				$('#private-room').html('');
				$.each(data, function(key,row){
					if (is_admin==1){
						$('#private-room').append("<div id='"+row.room_id+"'><a class='select_room'>"+row.room_name+"</a><a id='edit_room' class='navbar-right glyphicon glyphicon-pencil'></a><a id='delete_room' class='navbar-right glyphicon glyphicon-remove'></a></div><hr>");
					}
					if (is_admin!=1){
						$('#private-room').append("<div id='"+row.room_id+"'><a class='select_room'>"+row.room_name+"</a></div><hr>");
					}
				});
			}
		});
	};
	get_private_rooms();
	function save_message(){
		var id = $('#user_id').val();
		var message = $('#message').val();
		var room_id = $('.room_for_save').attr('id');
		$.ajax({
			type: 'POST',
			url: 'save_message.php',
			dataType: 'JSON',
			data: {id:id, message:message, room_id:room_id},
			success: function(data){
				$('#public-room').html('');
				$.each(data, function(key,row){
					if (is_admin==1){
						$('#public-room').append("<div id='"+row.message_id+"'><b>"+row.login+"</b><br>"+row.message+"<a id='delete_message' class='navbar-right glyphicon glyphicon-remove'></a><hr></div>");
					}
					if (is_admin!=1){
						$('#public-room').append("<div id='"+row.message_id+"'><b>"+row.login+"</b><br>"+row.message+"<hr></div>");
					}
				});
			}
		});
	};
	function load_public_messages(){
		$.ajax({
			type: 'GET',
			url: 'get_public_messages.php',
			dataType: 'JSON',
			data: {},
			success: function(data){
				$('#public-room').html('');
				$.each(data, function(key,row){
					if (is_admin==1){
						$('#public-room').append("<div id='"+row.message_id+"'><b>"+row.login+"</b><br>"+row.message+"<a id='delete_message' class='navbar-right glyphicon glyphicon-remove'></a><hr></div>");
					}
					if (is_admin!=1){
						$('#public-room').append("<div id='"+row.message_id+"'><b>"+row.login+"</b><br>"+row.message+"<hr></div>");
					}
				});
			}
		});
	};
	load_public_messages();
	$('#submit_message').click(function(e){
		e.preventDefault();
		save_message();
		$('#message').val('');
	});
	$(document).on('click','#delete_message',function(){
		var message_id = $(this).parent().attr('id');
		var room_id = $('.room_for_save').attr('id');
		$.ajax({
			type: 'POST',
			url: 'delete_message.php',
			dataType: 'JSON',
			data: {message_id:message_id,room_id:room_id},
			success: function(data){
				$('#public-room').html('');
				$.each(data, function(key,row){
					if (is_admin==1){
						$('#public-room').append("<div id='"+row.message_id+"'><b>"+row.login+"</b><br>"+row.message+"<a id='delete_message' class='navbar-right glyphicon glyphicon-remove'></a><hr></div>");
					}
					if (is_admin!=1){
						$('#public-room').append("<div id='"+row.message_id+"'><b>"+row.login+"</b><br>"+row.message+"<hr></div>");
					}
				});
			}
		});
	});
	$(document).on('click','.select_room',function(){
		var room_id = $(this).parent().attr('id');
		var room_name = $(this).text();
		$('#room_id').html('');
		$('#room_id').append("<input type='hidden' id='"+room_id+"' class='room_for_save'>");
		$('#room_name').text('');
		$('#room_name').text(room_name);
		$.ajax({
			type: 'POST',
			url: 'get_messages.php',
			dataType: 'JSON',
			data: {room_id:room_id},
			success: function(data){
				$('#public-room').html('');
				$.each(data, function(key,row){
					if (is_admin==1){
						$('#public-room').append("<div id='"+row.message_id+"'><b>"+row.login+"</b><br>"+row.message+"<a id='delete_message' class='navbar-right glyphicon glyphicon-remove'></a><hr></div>");
					}
					if (is_admin!=1){
						$('#public-room').append("<div id='"+row.message_id+"'><b>"+row.login+"</b><br>"+row.message+"<hr></div>");
					}
				});
			}
		});
	});
	$(document).on('click','#edit_room',function(){
		var room_id = $(this).parent().attr('id');
		var room_name = $(this).prev().text();
		$('#room').val(room_name);
		$('#add_room').fadeOut('fast');
		$('#private-room').fadeOut('fast');
		$('#create-room').fadeIn('fast');
		$('#add_room_name').fadeOut('fast');
		$('#cancel_room_name').fadeOut('fast');
		$('#create-room-user').fadeIn('fast');
		$('#room').text(room_name);
		$.ajax({
			type: 'POST',
			url: 'edit_room.php',
			dataType: 'JSON',
			data: {room_id:room_id},
			success: function(data){
				$('#room-users').html('');
				$.each(data, function(key,row){
					$('#room-users').append("<div id='"+row.user_id+"'>"+row.login+"<a id='delete_user' class='navbar-right glyphicon glyphicon-remove'></a></div><br>");
				});
			}
		});
	});
	$('#all_users_room').click(function(){
		$('#room_id').html('');
		$('#room_name').text('');
		$('#room_name').text('Общий чат');
		load_public_messages();
	});
	$('#cancel_room_name').click(function(){
		$('#create-room').fadeOut("fast");
		$('#create-room-user').fadeOut("fast");
		$('#private-room').fadeIn("fast");
		$('#add_room').fadeIn('fast');
		get_private_rooms();
	});
});