<!--Login form-->
<form method='POST' action='/users/p_login'>

	<h2>Log-in:</h2>
	
    Email<br>
    <input type='text' id="validate" name='email'>
    <span id="validEmail"></span>

    <br><br>

    Password<br>
    <input type='password' name='password'>

    <br><br>
    
    <!--If errors - display message-->
    <?php if(isset($error)): ?>
		<div class='error'>
			<p>Login failed. Please double check your email and password.</p>
		</div>
    <?php endif; ?>

    <input type='submit' value='Log in'>

</form>