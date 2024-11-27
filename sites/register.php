<?php 
	print '
	<div class="row">
	<div class="offset-3 col-6">
	<h1>Registration</h1>
	<div id="register">';
	
	if ($_POST['_action_'] == FALSE) {
		print '
		<form action="" id="reg_signin_addrec_form" name="registration_form" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">

			<label for="email">E-mail:</label><br>
			<input type="email" id="email" name="email" required><br>
			
			<label for="username">Username: <small>(Username must have min 5 char)</small></label><br>
			<input type="text" id="username" name="username" pattern=".{5,}" required><br>
									
			<label for="password">Password: <small>(Password must have min 4 char)</small></label><br>
			<input type="password" id="password" name="password" pattern=".{4,}" required><br>

			<input type="submit" class="submit" value="Register">
		</form>';
	}
	else if ($_POST['_action_'] == TRUE) {
		
		$query  = "SELECT * FROM users";
		$query .= " WHERE email='" .  $_POST['email'] . "'";
		$query .= " OR username='" .  $_POST['username'] . "'";
		$result = @mysqli_query($con, $query);
		$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		if (!isset($row['email']) && !isset($row['username'])) {
			# password_hash https://secure.php.net/manual/en/function.password-hash.php
			# password_hash() creates a new password hash using a strong one-way hashing algorithm
			$pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
			
			$query  = "INSERT INTO users (username, email, password, role)";
			$query .= " VALUES ('" . $_POST['username'] . "', '" . $_POST['email'] . "', '" . $pass_hash . "', 2)";
			$result = @mysqli_query($con, $query);
			
			echo '<p>' . $_POST['username'] . ', thank you for registration </p>
			<hr>';
		}
		else {
			echo '<p>User with this email or username already exist!</p>';
		}
	}
	print '
	</div></div></div>';
?>