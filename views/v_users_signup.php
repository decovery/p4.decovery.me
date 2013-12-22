<!--Signup form for new users-->
<form method='POST' action='/users/p_signup'>

	<h2>Sign-up:</h2>

    First Name<br>
    <input type='text' name='first_name'>
    <br><br>

    Last Name<br>
    <input type='text' name='last_name'>
    <br><br>

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
    		<p>All fields are required. Sign up failed.</p>
    	</div>
    	<br>
    <?php endif; ?>
    
    <input type='submit' value='Sign up'>

</form>