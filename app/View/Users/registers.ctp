<html>
	<head>
		<title>Login</title>
	</head>
	<body style="background:none;">
<?php 
	echo $this->Form->create('User', array('id' => 'register', 'action' => 'add_user'));
	echo $this->Form->input('name', array('formnovalidate' => true));
	echo $this->Form->input('email');
	echo $this->Form->input('password');
	echo $this->Form->input('phone');
	echo $this->Form->input('address');
	echo $this->Form->end('submit');
?>
		
	</body>
</html>