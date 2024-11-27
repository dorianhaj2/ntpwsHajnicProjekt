<?php 
	print '
    <div class="row">
	<div class="offset-3 col-6">
	<h1>Sign In form</h1>
	<div id="signin">';
	
	if ($_POST['_action_'] == FALSE) {
		print '
		<form action="" name="signin_form" id="reg_signin_addrec_form" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">

			<label for="username">Username:*</label>
			<input type="text" id="username" name="username" value="" pattern=".{5,}" required>
									
			<label for="password">Password:*</label>
			<input type="password" id="password" name="password" value="" pattern=".{4,}" required>
									
			<input type="submit" class="submit" value="Submit">
		</form>';
	}
	else if ($_POST['_action_'] == TRUE) {
		
		$query  = "SELECT * FROM users";
		$query .= " WHERE username='" .  $_POST['username'] . "'";
		$result = @mysqli_query($con, $query);
		$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
		
        if(isset($row['username']) && isset($row['password'])){
            if (password_verify($_POST['password'], $row['password'])) {
                #password_verify https://secure.php.net/manual/en/function.password-verify.php
                $_SESSION['user']['valid'] = 'true';
                $_SESSION['user']['id'] = $row['id'];
                # 1 - administrator; 2 - user
                $_SESSION['user']['role'] = $row['role'];
                # Redirect to home
                header("Location: index.php?menu=1");
            }
            
            # Bad username or password
            else {
                unset($_SESSION['user']);
                echo "Wrong username or password.";
            }
        }
		# Bad username or password
		else {
			unset($_SESSION['user']);
			echo "Wrong username or password.";
		}
	}
	print '
	</div></div></div>';
?>